<x-guest-layout>
    <x-slot name="links">
        <link rel="stylesheet" href="{{asset('css/forms-styles.css')}}"/>
    </x-slot>
    <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card justify-content-center align-items-center">
                <form method="POST" action="{{ route('login') }}" class="box">
                    @csrf
                    <h1 class="h1"> Note Active </h1>
                    <h2 class="h2 text-white">Login</h2>
                    <p class="text-muted">
                        Please enter your login and password!
                    </p>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">
                                * {{$error}}
                            </p>
                        @endforeach
                    @endif
                    <input
                        required
                        type="email"
                        name="email"
                        value="{{old('email')}}"
                        placeholder="Email"
                    />

                    <input
                        required
                        type="password"
                        name="password"
                        placeholder="Password"
                    />

                    <div class="">
                        <a
                        class="forgot text-muted"
                        href="{{route('password.request')}}">
                            Forgot password?
                        </a>
                    </div>
                    <div class="">
                        <a
                        class="forgot text-muted"
                        href="{{route('register')}}">
                            Register
                        </a>
                    </div>

                    <input
                    type="submit"
                    name=""
                    value="Login"
                    href="#">

                    <div class="col-md-12">
                        <ul class="social-network social-circle">
                            <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-guest-layout>
