<x-admin-master>
    <x-slot name="scripts">
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        {{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> --}}
        <script src="{{asset('js/posts-index.js')}}" charset="utf-8"></script>
        {{$scripts ?? ''}}
    </x-slot>
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{$title}}</h1>
        @if (session()->has('message'))
            <x-message :class="session('class')" :title="session('title')" >
                {{session('message')}}
            </x-message>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="text-center table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                {{-- because unless all the posts is for himself/herself --}}
                                @can ('viewAny', App\Models\Post::class)
                                    <th>Owner</th>
                                @endcan
                                <th>Title</th>
                                <th>Category</th>
                                <th>Body</th>
                                <th>Image</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                {{-- because unless all the posts is for himself/herself --}}
                                @can ('viewAny', App\Models\Post::class)
                                    <th>Owner</th>
                                @endcan
                                <th>Title</th>
                                <th>Category</th>
                                <th>Body</th>
                                <th>Image</th>
                                <th>Operations</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    {{-- because unless all the posts is for himself/herself --}}
                                    @can ('viewAny', App\Models\Post::class)
                                        <td>{{$post->user->name}}</td>
                                    @endcan
                                    <td> <a href="{{url(route('home.posts',$post->id))}}">{{$post->title}}</a> </td>
                                    <td>{{$post->category->name}}</td>
                                    <td>{{Str::limit($post->body,50,'...')}}</td>
                                    @isset($post->post_image)
                                        <td> <img src="{{url($post->post_image)}}" width="50" height="50" alt=""> </td>
                                    @else
                                        <td>no image</td>
                                    @endisset
                                    <td>
                                        <div class="d-flex flex-nowrap">
                                            @can ('delete', $post)
                                                {{-- for delete --}}
                                                <form title="delete this post" class="d-inline mr-2 delete-post-form" action="{{url("admin/posts/$post->id")}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger"> <i class="fa fa-trash"></i> </button>
                                                </form>
                                            @endcan
                                            @can ('update', $post)
                                                {{-- for edit --}}
                                                <a title="edit this post" href="{{url("admin/posts/$post->id/edit")}}" class="btn btn-warning"> <i class="fa fa-edit"></i> </a>

                                            @endcan

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$posts->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</x-admin-master>
