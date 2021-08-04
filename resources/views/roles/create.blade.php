<x-admin-master>

    <x-slot name="links">
        <style media="screen">
            .border-primary{
                border : 1px solid rgb(0, 110, 190);
            }
        </style>
    </x-slot>

    <h2> Create Role </h2>
    <hr>

    @include('partials.error')

    <form class="form-row" action="{{url(route('roles.store'))}}" method="post">
        @csrf
        <div class="form-group col-md-4">
            <label for="name"class="h4">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Name of Role"  name="name" value="{{old('name')}}">
        </div>
        <div class="col-md-12">
            <h4>Permissions for this Role:</h4>
            <div class="d-flex flex-wrap">
                @foreach ($permissions as $permission)

                    <div class="border-primary rounded m-2 p-2">
                      <div class="custom-control custom-checkbox my-1 mr-sm-2">
                        <input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="custom-control-input" id="permission{{$loop->iteration}}">
                        <label class="custom-control-label" for="permission{{$loop->iteration}}">{{$permission->name}}</label>
                      </div>

                    </div>

                @endforeach
            </div>
        </div>
        <div class="col-md-12 my-3">
            <input type="submit" name="" value="Create" class="btn-block mx-auto col-md-4 btn btn-primary">
        </div>

    </form>

</x-admin-master>
