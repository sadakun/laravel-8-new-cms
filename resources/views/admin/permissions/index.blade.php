<x-admin-master>
    @section('content')
        
        <h1 class="h3 mb-4 text-gray-800">Permissions</h1>

        @if(session()->has('permission-deleted'))
        <div class="alert alert-danger">{{session('permission-deleted')}}</div>
        @elseif(session()->has('permission-updated'))
        <div class="alert alert-success">{{session('permission-updated')}}</div>
        @endif
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('permissions.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <span>{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>

            <div class="col-sm-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permission</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td><a href="{{route('permissions.edit', $permission->id)}}">{{$permission->name}}</a></td>
                                    <td>{{$permission->slug}}</td>
                                    <td>
                                        <form method="post" action="{{route('permissions.delete',$permission->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
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