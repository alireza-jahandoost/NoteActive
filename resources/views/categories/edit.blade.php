<x-admin-master>
    <h2>Edit Category: {{$category->name}}</h2>

    @include('partials.error')
    @if (session()->has('message'))
        <x-message :class="session('class')" :title="session('title')" >
            {{session('message')}}
        </x-message>
    @endif

    <form class="form-row" action="{{url(route('categories.update',$category->id))}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group col-md-4">
            <label for="name" class="h5">Category Name</label>
            <input autofocus type="text" name="name" class="form-control" value="{{$category->name}}" id="name">
        </div>
        <div class="form-group col-md-12">
            <input type="submit" class="btn btn-primary col-md-2" value="Create">
        </div>

    </form>

</x-admin-master>
