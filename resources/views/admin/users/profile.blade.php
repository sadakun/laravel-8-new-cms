<x-admin-master>
    @section('content')
    <h1 class="h3 mb-4 text-gray-800">User Profile for {{$user->name}}</h1>
    <div class="row">
        <div class="col-sm-6">
            <form action="{{route('user.profile.update', $user)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <img class="img-profile rounded-circle" src="{{$user->avatar}}">
                </div>
                
                <div class="form-group">
                    <input type="file" name="avatar">
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                    id="username" aria-describedby="" placeholder="Enter your username here" value="{{$user->username}}">
                    @error('username')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" 
                    id="name" aria-describedby="" placeholder="Enter your name here" value="{{$user->name}}">
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" 
                    id="email" aria-describedby="" placeholder="example@example.com" value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" 
                    id="password">
                </div>
                
                <div class="form-group">
                    <label for="password-confirmation">Confirm Password</label>
                    <input type="password" name="password-confirmation" class="form-control" 
                    id="password-confirmation">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="mt-4 col-sm-12">
            <h1 class="h3 mb-4 text-gray-800">Role</h1>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Check</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Attach</th>
                            <th>Detach</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Check</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Attach</th>
                            <th>Detach</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td><input type="checkbox"
                            @foreach($user->roles as $user_role)
                                @if($user_role->slug == $role->slug)
                                    checked
                                @endif
                            @endforeach
                            ></td>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->slug}}</td>
                            <td>
                                <form method="post" action="{{route('user.role.attach', $user)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="role" value="{{$role->id}}">
                                    <button class="btn btn-primary"
                                    @if($user->roles->contains($role))
                                    disabled
                                    @endif>Attach</button>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="{{route('user.role.detach', $user)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="role" value="{{$role->id}}">
                                    <button class="btn btn-danger"
                                    @if(!$user->roles->contains($role))
                                    disabled
                                    @endif>Detach</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-admin-master>