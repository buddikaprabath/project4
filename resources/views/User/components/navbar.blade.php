<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <div class="logo">S&S Sales</div>
        <div class="username"><span class="nav-link">Proofile : {{ Auth::user()->name }}</span></div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('User.Vehicle.vehicles') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('User.Message.SendMessage') }}">Message</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('User.Order.index') }}">Order</a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
