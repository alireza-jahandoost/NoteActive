<x-admin-master>
    <x-slot name="links">

        <style media="screen">
            .item > .post-link{
                color: inherit;
                text-decoration: none;
                transition: 0.5s;
            }
            .item > .post-link:hover{
                z-index: 1000;
                position: relative;
                transform: scale(1.2,1.2);
                box-shadow: 0,0,5px;
            }
        </style>

    </x-slot>
    <div class="">
        <a href="{{url(route('blog'))}}" class="btn btn-outline-secondary">Back to blog</a>
        <h1 class="display-3 text-gray-900 text-center">{{$category->name}}</h1>
    </div>
    <hr>
    <div class="row">
        @foreach ($posts as $post)
            <div class="text-gray-700 item col-sm-6 col-md-4 col-lg-3">
                <a class="post-link d-block" href="{{url(route('home.posts',$post->id))}}">
                <div class="card border-primary mb-3">
                    <div style="background-color:inherit" class="card-header">
                        @if ($post->post_image)
                            <img height="150" class="card-img-top" src="{{url($post->post_image)}}" alt="image of {{$post->title}}">
                        @else
                            <img height="150" class="card-img-top" src="{{url('images/no-image.jpg')}}" alt="this post doesnt have any image">
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{Str::limit($post->title,30)}}</h5>
                        <p class="card-text">{{Str::limit($post->body,50)}}</p>
                    </div>
                </div>
                </a>
            </div>

        @endforeach

    </div>

    {{$posts->links()}}

</x-admin-master>
