<div class="navbar">
    <div class="logo">
        <h1>S & S SALE</h1>
    </div>
    <div class="logout-container">
        <a href="{{route('logout')}}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            LOGOUT
            <i class="bi bi-box-arrow-right"></i>
        </a>
        <form id="logout-form" action="{{route('logout')}}" method="post" style="display:none">
            @csrf
        </form>
    </div>
</div>
