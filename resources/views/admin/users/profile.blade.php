<x-admin-master>
    @section('content')

        <h1>User profile for : {{$user->name}}</h1>


        <div class="row">

            <div class="col-sm-6">
                <form enctype="multipart/form-data" action="{{route('user.profile.update', $user)}}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <img class="img-profile rounded-circle"
                             height="105"
                             width="110"
                             src="{{$user->avatar}}"
                             alt="{{$user->username}}'s profile image">
                    </div>

                    <div class="form-group">
                        <input type="file" name="avatar" id="">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control
                                      @error('username')
                                              is-invalid @enderror"
                               value="{{$user->username}}"
                               id="username">

                        @error('username')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text"
                               name="name"
                               class="form-control
                                       @error('name')
                                   is-invalid @enderror"
                               value="{{$user->name}}"
                               id="name">

                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control
                                       @error('email')
                                   is-invalid @enderror"
                               value="{{$user->email}}"
                               id="email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               id="password">
                    </div>

                    <div class="form-group">
                        <label for="password-confirmation">Confirm Password</label>
                        <input type="password"
                               name="password-confirmation"
                               class="form-control"
                               id="password-confirmation">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>

        @endsection
</x-admin-master>
