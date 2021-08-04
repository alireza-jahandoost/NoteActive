<x-admin-master>
    <h2>Create New Category</h2>

    @include('partials.error')
    @if (session()->has('message'))
        <x-message :class="session('class')" :title="session('title')" >
            {{session('message')}}
        </x-message>
    @endif

    <form class="form-row" action="{{url(route('categories.store'))}}" method="post">
        @csrf
        <div class="form-group col-md-4">
            <label for="name" class="h5">Category Name</label>
            <input autofocus type="text" name="name" class="form-control" value="{{old('name')}}" id="name">
        </div>
        <div class="form-group col-md-12">
            <input type="submit" class="btn btn-primary col-md-2" value="Create">
        </div>

    </form>

</x-admin-master>
