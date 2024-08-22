<nav class="navbar navbar-expand-md">
    <div class="container">
        <h1 class="logo">S&S SALE</h1>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto"></ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link btn-link">Home</a></li>
                <li class="nav-item">
                    <a class="nav-link btn-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link btn-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>
