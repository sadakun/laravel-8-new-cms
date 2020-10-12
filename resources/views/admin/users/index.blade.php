<x-admin-master>
@section('content')
        <h1 class="h3 mb-4 text-gray-800">All Users</h1>
        <!-- option 1 -->
        <!-- @if(Session::has('message'))
        <div class="alert alert-danger">{{Session::get('message')}}</div>
        @endif -->

        <!-- option 2 -->
        @if(session('user-deleted'))
        <div class="alert alert-danger">{{session('user-deleted')}}</div>
        @elseif(session('user-updated'))
        <div class="alert alert-success">{{session('user-updated')}}</div>
        @endif
    
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Avatar</th>
                      <th>Created date</th>
                      <th>Updated date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Avatar</th>
                      <th>Created date</th>
                      <th>Updated date</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>{{$user->id}}</td>
                      <td>{{$user->username}}</td>
                      <td>{{$user->email}}</td>
                      <td><img height="100px" src="{{$user->avatar}}" alt=""></td>
                      <td>{{$user->created_at->diffForHumans()}}</td>
                      <td>{{$user->updated_at->diffForHumans()}}</td>
                      <td>
                        <form method="post" action="{{route('user.delete', $user->id)}}" ectype="multipart/form-data">
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
        {{$users->links()}}
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <!-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> -->
    @endsection
</x-admin-master>