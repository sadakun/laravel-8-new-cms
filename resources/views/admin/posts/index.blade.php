<x-admin-master>
    @section('content')
        <h1 class="h3 mb-4 text-gray-800">All Posts</h1>
        <!-- option 1 -->
        <!-- @if(Session::has('message'))
        <div class="alert alert-danger">{{Session::get('message')}}</div>
        @endif -->

        <!-- option 2 -->
        @if(session('post-deleted'))
        <div class="alert alert-danger">{{session('post-deleted')}}</div>
        @elseif(session('post-created'))
        <div class="alert alert-success">{{session('post-created')}}</div>
        @elseif(session('post-updated'))
        <div class="alert alert-success">{{session('post-updated')}}</div>
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
                      <th>Author</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Created date</th>
                      <th>Updated date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Author</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Created date</th>
                      <th>Updated date</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($posts as $post)
                    <tr>
                      <td>{{$post->id}}</td>
                      <td>{{$post->user->name}}</td>
                      <td><a href="{{route('post.edit', $post->id)}}">{{$post->title}}</a></td>
                      <td><img height="100px" src="{{$post->post_image}}" alt=""></td>
                      <td>{{$post->created_at->diffForHumans()}}</td>
                      <td>{{$post->updated_at->diffForHumans()}}</td>
                      <td>
                        <form method="post" action="{{route('post.delete', $post->id)}}" ectype="multipart/form-data">
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
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
</x-admin-master>