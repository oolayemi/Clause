<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{


    public function index(){
        //$posts = Post::all();
        $posts = auth()->user()->posts()->paginate(2);


        return view('admin.posts.index', ['posts'=>$posts]);
    }


    public function show(Post $post){
        return view('blog-post', ['post'=>$post]);
    }


    public function create(){
        return view('admin.posts.create');
    }


    public function store(){
        $inputs = request()->validate([
            'title'=>'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        $this->authorize('create', Post::class);

        auth()->user()->posts()->create($inputs);

        session()->flash('post-was-created', 'Post was created');

        return redirect()->route('post.index');
    }


    public function edit(Post $post){
        $this->authorize('view', $post);

        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function destroy(Post $post, Request $request){

        $this->authorize('delete', $post);

        $post->delete();
        $request->session()->flash('message', 'Post was deleted');
        return back();
    }


    public function update(Post $post){

        $inputs = request()->validate([
            'title'=>'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if (request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = request('title');
        $post->body = request('body');

        $this->authorize('update', $post);


        $post->save();

        session()->flash('updated', 'Post has been updated');

        return redirect()->route('post.index');
    }


}

