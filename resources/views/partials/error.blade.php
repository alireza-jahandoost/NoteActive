@if ($errors->any())

    @foreach ($errors->all() as $error)

        <x-message :class="'danger'" :title="'Error'">
            {{$error}}
        </x-message>

    @endforeach

@endif
