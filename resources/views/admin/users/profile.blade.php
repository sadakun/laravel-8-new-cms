<x-admin-master>
    @section('content')
    <h1 class="h3 mb-4 text-gray-800">User Profile for {{$user->name}}</h1>

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
    @endsection
</x-admin-master>