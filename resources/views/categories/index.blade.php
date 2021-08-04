<x-admin-master>
    <x-slot name="scripts">
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        {{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> --}}
        <script type="text/javascript">
            let btn = $('.delete-category-button');
            btn.click(function () {
                if (confirm('Are You Sure to delete this Category?')) {
                    this.closest('form').submit();
                }
            });
        </script>

        {{$scripts ?? ''}}
    </x-slot>
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">View All Categories</h1>
        @include('partials.error')
        @if (session()->has('message'))
            <x-message :class="session('class')" :title="session('title')" >
                {{session('message')}}
            </x-message>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="text-center table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>number of posts</th>
                                <th>operations</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>number of posts</th>
                                <th>operations</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{count($category->posts)}}</td>
                                    <td>
                                        <div class="d-flex justify-content-around flex-nowrap">
                                            @can ('update', $category)

                                                <a title="edit category" class="btn btn-warning " href="{{url(route('categories.edit',$category->id))}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can ('viewCategoryPosts', $category)

                                                <a class="btn btn-success" title="show posts of this category" href="{{url(route('categories.posts',$category->id))}}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can ('delete', $category)

                                                <form class="d-inline" action="{{url(route('categories.destroy',$category->id))}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="delete-category-button btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</x-admin-master>
