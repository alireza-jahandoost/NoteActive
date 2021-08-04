<x-admin-master>
    <x-slot name="scripts">
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        {{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> --}}
        <script type="text/javascript">
            let btn = $('.delete-role-button');
            btn.click(function () {
                if (confirm('Are You sure to delete this role?')) {
                    this.closest('form').submit();
                }
            });
        </script>
        {{$scripts ?? ''}}
    </x-slot>
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">View All Roles</h1>

        @include('partials.error')
        @if (session()->has('message'))
            <x-message :class="session('class')" :title="session('title')" >
                {{session('message')}}
            </x-message>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="text-center table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Operations</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->created_at->diffForHumans()}}</td>
                                    <td>{{$role->updated_at->diffForHumans()}}</td>
                                    <td>
                                        @can ('viewAny', App\Models\User::class)
                                            <a title="view users with this role" href="{{url(route('users.index_by_role',$role->id))}}" class="btn btn-primary">
                                                <i class="fa fa-users"></i>
                                            </a>
                                        @endcan
                                        @can ('update', $role)
                                            <a title="edit role" href="{{url(route('roles.edit',$role->id))}}" class="btn btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can ('delete', $role)
                                            <form class="d-inline" action="{{url(route('roles.destroy',$role->id))}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger delete-role-button" type="button">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$roles->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</x-admin-master>
