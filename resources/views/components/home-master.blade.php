<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>My Website</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <link rel="stylesheet" href="{{asset('owl-carousel/assets/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('owl-carousel/assets/owl.carousel.default.min.css')}}">
  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
  <!-- slick slider -->
  <link rel="stylesheet" href="{{asset('slick/slick.css')}}">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="{{asset('css/themify-icons/themify-icons.css')}}">

  <!-- Main Stylesheet -->
  <link href="{{asset('css/home/style.css')}}" rel="stylesheet">

  <!--Favicon-->
  <link rel="shortcut icon" href="{{url('images/home/home/favicon.ico')}}" type="image/x-icon">
  <link rel="icon" href="{{url('images/home/home/favicon.ico')}}" type="image/x-icon">

</head>

<body>


<header class="navigation fixed-top">
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand font-tertiary h3" href="index.html"><img src="{{url('images/home/logo.png')}}" alt="Myself"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
      aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse text-center" id="navigation">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item @if(Route::currentRouteName() === 'home') active @endif">
          <a class="nav-link" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">about</a>
        </li>
        <li class="nav-item @if(Route::currentRouteName() === 'blog') active @endif">
          <a class="nav-link " href="{{url('/posts')}}">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Portfolio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        @if (Auth::check())
            <x-user-information-topbar/>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{url(route('register'))}}">register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url(route('login'))}}">login</a>
            </li>
        @endif
      </ul>
    </div>
  </nav>
</header>

{{$slot}}

@include('partials.logout_modal')

<!-- jQuery -->
<script src="{{asset('vendor/jquery/jquery.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- slick slider -->
<script src="{{asset('slick/slick.min.js')}}"></script>
<!-- filter -->
<script src="{{asset('shuffle/shuffle.min.js')}}"></script>

<!-- Main Script -->
<script src="{{asset('js/home/script.js')}}"></script>
{{-- plugins --}}
<script src="{{asset('owl-carousel/owl.carousel.min.js')}}" charset="utf-8"></script>
{{$scripts ?? ''}}

</body>
</html>
