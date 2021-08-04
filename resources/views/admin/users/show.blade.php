<x-admin-master>
    <x-slot name="links">
        <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    </x-slot>
    <!-- Profile widget -->
    <div class="bg-white shadow rounded overflow-hidden text-gray-800">
        <div class="px-4 pt-0 pb-4 cover">
            <div class="media align-items-end profile-head">
                <div class="profile mr-3"><img src="{{$user->profile_image ? url($user->profile_image) : url("images/unknown-user.jpg") }}" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                    @if (auth()->id() === $user->id)
                        <a href="{{url(route('users.edit',$user->id))}}" class="btn btn-outline-dark btn-sm btn-block">Edit profile</a>
                    @endif
                </div>
                <div class="media-body mb-5 text-white">
                    <h4 class="mt-0">{{$user->name}}</h4>
                    <h4 class="mt-0 mb-3">&commat;{{$user->username}}</h4>
                </div>
            </div>
        </div>
        <div class="bg-light p-4 d-flex justify-content-end text-center">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <h5 class="font-weight-bold mb-0 d-block">{{count($user->posts)}}</h5><small class="text-muted"> <i class="fas fa-image mr-1"></i>Posts</small>
                </li>
            </ul>
        </div>
        <div class="px-4 py-3">
            <h5 class="">About</h5>
            <div class="">
                @foreach (explode("\n" , $user->about) as $paragraph)
                    <p>{{$paragraph}}</p>
                @endforeach
            </div>
        </div>
        <div class="py-4 px-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="mb-0">Recent Posts</h5><a href="{{url(route('user_posts',$user->id))}}" class="btn btn-outline-secondary">Show all</a>
            </div>
            <div class="row">
                @for ($i=count($user->posts)-1; $i >= 0; $i--)
                    {{-- break if its 5th post. because we just want last 4 posts --}}
                    @break($i<count($user->posts)-4)
                    @php
                        $post = $user->posts[$i];
                    @endphp
                    <div class="col-lg-6 mb-2 pr-lg-1">
                        <div class="card">
                            <img class="card-img-top" height="200" src="{{$post->post_image ? url($post->post_image) : url('images/no-image.jpg')}}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{$post->title}}</h5>
                                <p class="card-text">{{Str::limit(preg_replace('/\<.*?\>/','',$post->body),100,"...")}}</p>
                                <a href="{{url("posts/$post->id")}}" class="btn btn-primary">view post</a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</x-admin-master>
