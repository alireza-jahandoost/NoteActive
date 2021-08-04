<x-admin-master>
    @if ($user->id !== auth()->id())
        <h2> Change Password for User: <a href="{{url(route('users.show',$user->id))}}">&commat;{{$user->username}}</a> </h2>
    @else
        <h2>Change Password</h2>
    @endif
    @include('partials.error')
    @if (session()->has('message'))
        <x-message>
            {{session('message')}}
        </x-message>
    @endif
    <div class="d-none">
        <x-message :class="'danger'">
        </x-message>
    </div>
    <form class="" action="{{url(route('users.update_password',$user->id))}}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="password">Password</label>
            <input autofocus name="password" type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="confirm">Confirm Password</label>
            <input autofocus name="confirm" type="password" class="form-control" id="confirm" placeholder="Confirm Password">
        </div>

        <input type="submit" class="btn btn-primary"  value="submit">
    </form>


</x-admin-master>
