<x-admin-master>
    <x-slot name="scripts">
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        {{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> --}}
        <script src="{{asset('js/users-index.js')}}" charset="utf-8"></script>
        {{$scripts ?? ''}}
    </x-slot>
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">View All Users</h1>
        @if (session()->has('message'))
            <x-message :class="session('class')" :title="session('title')" >
                {{session('message')}}
            </x-message>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="text-center table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>email</th>
                                @if (auth()->user()->hasPermission('view-roles'))
                                    <th>role</th>
                                @endif
                                <th>profile_image</th>
                                <th>operations</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>email</th>
                                @if (auth()->user()->hasPermission('view-roles'))
                                    <th>role</th>
                                @endif
                                <th>profile_image</th>
                                <th>operations</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td> <a href="{{url(route('users.show',$user->id))}}">{{$user->username}}</a> </td>
                                    <td>{{$user->email}}</td>
                                    @if (auth()->user()->hasPermission('view-roles'))
                                        <td>{{$user->role->name}}</td>
                                    @endif
                                    <td>
                                        @isset($user->profile_image)
                                            <img src="{{url($user->profile_image)}}" width="50" height="50" alt="">
                                        @else
                                            <p> - </p>
                                        @endisset
                                    </td>
                                    <td class="">
                                        <div class="d-flex flex-nowrap">
                                            @can ('delete', $user)
                                                <form title="delete user" class="d-inline mr-2 delete-users-form" action="{{url(route('users.destroy',$user->id))}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                            @can ('update', $user)
                                                <a title="edit user" class="btn btn-warning mr-2" href="{{url(route('users.edit',$user->id))}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can ('changePassword', $user)
                                                <a title="change password" class="btn btn-success mr-2" href="{{url(route('users.edit_password',$user->id))}}">
                                                    <i class="fa fa-key"></i>
                                                </a>
                                            @endcan
                                            @can ('updateRole', $user)
                                                <a title="change user role" class="btn btn-secondary" href="{{url(route('users.edit_role',$user->id))}}">
                                                    <i class="fa fa-user-tag"></i>
                                                </a>
                                            @endcan

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</x-admin-master>
