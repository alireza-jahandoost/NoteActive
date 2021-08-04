<x-admin-master>
    <x-slot name="scripts">
        <script type="text/javascript">
        let btn = $('#delete-profile-image-button');
        btn.click(function () {
            let form = btn.closest('form');
            let element = $(`<input type="hidden" name="delete_profile_image" value="true"/>`);
            form.append(element);
            form.find('.current-image').hide();
            form.find('.image-part').append(`<h6 class="mt-3">there is no image for user profile</h6>`);
        });
        </script>
    </x-slot>
    @if ($user->id !== auth()->id())
        <h2>Update Profile For User: <a href="{{url(route('users.show',$user->id))}}">&commat;{{$user->username}}</a> </h2>
    @else
        <h2>Update Profile</h2>
    @endif
    @include('partials.error')
    @if (session()->has('message'))
        <x-message>
            {{session('message')}}
        </x-message>
    @endif
    <form class="form-row" method="post" enctype="multipart/form-data" action="{{url(route('users.update',$user->id))}}">
        @csrf
        @method('PUT')
        <div class="form-group mb-4 col-md-4">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{$user->email}}">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group mb-4 col-md-4">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Name"  value="{{$user->name}}">
        </div>
        <div class="form-group mb-4 col-md-4">
            <label for="username">Username</label>
            <input type="username" name="username" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Enter username" value="{{$user->username}}">
            <small id="usernameHelp" class="form-text text-muted">It will be your unique username</small>
        </div>
        <div class="form-group mb-4 col-md-8">
            <label for="about">Tell us about yourself</label>
            <textarea class="form-control" name="about" id="about" rows="3">{{$user->about}}</textarea>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-4 image-part">
                <label for="file">Upload profile image</label>
                <input type="file" name="profile_image" class="form-control-file" id="file">
                @isset($user->profile_image)
                    <div class="current-image">
                        <h6 class="mt-3">current profile image: </h6>
                        <img src="{{url($user->profile_image)}}" class="img-fluid" alt="">
                        <div class="mt-2 text-center">
                            <button type="button" id="delete-profile-image-button" class="btn btn-danger">delete profile image</button>
                        </div>

                    </div>
                @else
                    <div class="">
                        <h6 class="mt-3">there is no image for user profile</h6>
                    </div>
                @endisset
            </div>


        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Submit</button>

        </div>
    </form>
</x-admin-master>
