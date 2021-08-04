<x-admin-master>

    <x-slot name="links">
        <link rel="stylesheet" href="{{asset('owl-carousel/assets/owl.theme.default.css')}}">
        <link rel="stylesheet" href="{{asset('owl-carousel/assets/owl.carousel.min.css')}}">
        <style media="screen">
            .item > .post-link{
                color: inherit;
                text-decoration: none;
                transition: 0.5s;
            }
            .owl-item,.hover-div{
                transition: 0.5s;
            }
            .post-link:hover .hover-div{
                background-color: rgba(0,0,0,0.2);
                box-shadow: 0 0 5px 1px inset;
                z-index:1;
            }

            /* fix size of elements in owl carousel */
            .owl-item,.owl-stage{
                display: flex;
            }

        </style>
    </x-slot>

    <x-slot name="scripts">
        <script src="{{asset('owl-carousel/owl.carousel.min.js')}}" charset="utf-8"></script>
        <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop:true,
            stagePadding:50,
            margin:10,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:4
                }
            }
        })

        </script>

    </x-slot>
    <h1 class="text-center text-gray-900 display-3">Blog</h1>
    <hr>

    <div class=" text-gray-800">


        <div class="container p-3 text-center">

            <div class="m-3 bg-gray-100">

                @foreach ($categories->random(5) as $category)
                    <div class="p-3">

                        <div class="border-bottom-primary pb-2 mb-3 d-flex">

                            <h3 class="">{{$category->name}}</h3>

                            <a class="ml-auto btn btn-outline-primary" href="{{url(route('category_posts',$category->id))}}">View More</a>

                        </div>

                        <div class="">

                            <div class="owl-carousel">
                                @foreach ($category->posts->random(10) as $post)
                                    <div class="item">
                                        <a class="post-link" href="{{url(route('home.posts',$post->id))}}">
                                        <div class="card h-100 border-primary mb-3">
                                            <div class="hover-div w-100 h-100 position-absolute"></div>
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

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</x-admin-master>
