<x-guest-layout>
    <x-slot name="links">
        <link rel="stylesheet" href="{{asset('css/forms-styles.css')}}"/>
    </x-slot>
    <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card justify-content-center align-items-center">
                <form method="POST" action="{{ route('register') }}" class="box">
                    @csrf
                    <h1 class="h1"> Note Active </h1>
                    <h2 class="h2 text-white">Register</h2>
                    <p class="text-muted">
                        Create a new Account
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
                        type="text"
                        name="name"
                        value="{{old('name')}}"
                        placeholder="Name"
                    />

                    <input
                        required
                        type="text"
                        name="username"
                        value="{{old('username')}}"
                        placeholder="User Name"
                    />

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

                    <input
                        required
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm Password"
                    />

                    <div class="text-muted">
                        have an account?
                        <a
                        class="forgot text-muted"
                        href="{{route('login')}}">
                            Login
                        </a>
                    </div>

                    <input
                    type="submit"
                    name=""
                    value="Register"
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
