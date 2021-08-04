<x-admin-master>
    <x-slot name="links">
  {{-- <link href="{{asset('css/blog-post.css')}}" rel="stylesheet"> --}}

    </x-slot>
    <div class="container-fluid text-gray-800 bg-white">
        <!-- Title -->
        <h1 class="mt-4">{{$post->title}}</h1>

        <!-- Author -->
        <p class="lead">
          by
          <a href="{{url(route('users.show',$post->user->id))}}">&commat;{{$post->user->username}}</a>
        </p>

        @canany (['update','delete'], $post)
            <div class="d-flex flex-nowrap">
                @can ('delete', $post)
                    {{-- for delete --}}
                    <form title="delete this post" class="d-inline mr-2 delete-post-form" action="{{url("admin/posts/$post->id")}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger"> <i class="fa fa-trash"></i> </button>
                    </form>
                @endcan
                @can ('update', $post)
                    {{-- for edit --}}
                    <a title="edit this post" href="{{url("admin/posts/$post->id/edit")}}" class="btn btn-warning"> <i class="fa fa-edit"></i> </a>

                @endcan

                    </div>

        @endcanany

        <hr>

        <!-- Date/Time -->
        <p>Posted {{$post->created_at->diffForHumans()}}</p>

        <hr>

        <!-- Preview Image -->
        <div class="text-center">
        @if ($post->post_image)
            <img src="{{url($post->post_image)}}" alt="" class="img-fluid rounded">
        @else
            <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">
        @endif

        </div>

        <hr>

        <!-- Post Content -->
        {!!$post->body!!}

        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form>
              <div class="form-group">
                <textarea class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

        <!-- Single Comment -->
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
          </div>
        </div>

        <!-- Comment with nested comments -->
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

          </div>
        </div>

    </div>

</x-admin-master>
