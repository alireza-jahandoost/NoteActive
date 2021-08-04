<x-admin-master>
    <x-slot name="scripts">
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    </x-slot>
    <h2>Edit Role: {{$role->name}}</h2>
    <hr>
    @if (session()->has('message'))
        <x-message :class="session('class')" :title="session('title')" >
            {{session('message')}}
        </x-message>
    @endif
    @include('partials.error')

    <form class="mb-5 form-row" action="{{url(route('roles.update',$role->id))}}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group col-md-4">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{$role->name}}" class="form-control" id="name" placeholder="Name of Role">
            <input type="submit" name="" value="edit" class="mt-3 btn-block btn btn-primary">
        </div>
        <div class="col-md-8">
            <h3 class="text-center">Current Permissions of this Role:</h3>

            <div class="d-flex flex-wrap">
                @foreach ($role->permissions as $permission)
                    <div class="bg-warning p-2 text-white m-2 rounded">
                        {{$permission->name}}
                    </div>
                @endforeach
            </div>

        </div>
    </form>



    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Permissions</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="text-center table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Add / Remove</th>
                            <th></th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Add / Remove</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Add / Remove</th>
                            <th></th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Add / Remove</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($permissions as $permission)
                            @if ($loop->iteration % 2 == 1)
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>
                                        @if ($role->permissions()->whereId($permission->id)->doesntExist())
                                            <form class="" action="{{url(route('roles.add_permission',$role->id))}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="permission" value="{{$permission->id}}">
                                                <button class="btn btn-success" type="submit">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form class="" action="{{url(route('roles.remove_permission',$role->id))}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="permission" value="{{$permission->id}}">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td></td>
                            @else
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>
                                        @if ($role->permissions()->whereId($permission->id)->doesntExist())
                                            <form class="" action="{{url(route('roles.add_permission',$role->id))}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="permission" value="{{$permission->id}}">
                                                <button class="btn btn-success" type="submit">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form class="" action="{{url(route('roles.remove_permission',$role->id))}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="permission" value="{{$permission->id}}">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




</x-admin-master>
