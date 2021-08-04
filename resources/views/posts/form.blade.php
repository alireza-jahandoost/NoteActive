<x-admin-master>
    <x-slot name="scripts">
        <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/balloon/ckeditor.js"></script>
        <script src="{{asset('js/posts-form.js')}}" charset="utf-8"></script>
        {{$scripts ?? ''}}
</x-slot>
<h3 class="mb-4">{{$pageTitle}}</h3>
@if (session()->has('message'))
    <x-message :title="'Successfull'" :class="'success'">
        {{session('message')}}
    </x-message>
@endif
@include('partials.error')
<form class="form-row" id="create-new-post-form" action="{{url("admin/posts/".$post->id??"")}}" enctype="multipart/form-data" method="post">
    @csrf
    @isset($post->id)
        @method('PUT')
    @endisset
    <div class="col-md-5">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" required id="title" name="title" aria-describedby="emailHelp" value="{{$post->title ?? old('title')}}" placeholder="Enter Title">
        </div>

    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="post_image">Post Image</label>
            <input type="file" class="form-control-file" name="post_image" id="post_image">
        </div>
    </div>
    <div class="col-md-4">
        <label for="category">Category</label>
        <select id="category" name="category_id" class="custom-select">
            @foreach ($categories as $category)
                <option @if($post->category_id === $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-@isset($post->id)8 @elseif(true)12 @endisset border bg-white">
        <div id="editor">{!!$post->body?? ""!!}</div>
    </div>
    @isset($post->id)
        <div class="col-md-4">
            <h5>current post image:</h5>
            @isset($post->post_image)
                <div class="image-div">
                    <img class="img-fluid" src="{{url($post->post_image)}}" alt="">
                    <div class="text-center m-2">
                        <button type="button" id="delete-image" class="btn btn-danger">delete image</button>
                    </div>
                </div>
            @else
                <p>there is no image for this post</p>
            @endisset

        </div>
    @endisset
    <div class="col-12 m-3">
        <button id="submit-form" type="button" class="btn btn-primary">Submit</button>
    </div>
</form>
</x-admin-master>
