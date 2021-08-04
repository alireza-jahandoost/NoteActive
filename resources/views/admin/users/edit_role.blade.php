<x-admin-master>
    <h2>Change Role For User: <a href="{{url(route('users.show',$user->id))}}">&commat;{{$user->username}}</a> </h2>
    @include('partials.error')
    @if (session()->has('message'))
        <x-message :class="session('class')" :title="session('title')" >
            {{session('message')}}
        </x-message>
    @endif

    <form class="form-row" action="{{url(route('users.update_role',$user->id))}}" method="post">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <label for="role" class="h4">Role</label>
            <select id="role" name="role" class="custom-select">
                @foreach ($roles as $role)
                    <option @if($user->role->id === $role->id) selected @endif value="{{$role->id}}">{{$role->name}}</option>

                @endforeach
            </select>
            <div class="my-3">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </div>

    </form>

</x-admin-master>
