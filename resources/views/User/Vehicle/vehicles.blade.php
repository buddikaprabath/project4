@extends('User.home')

@section('User_Content')

<div class="body_container">
    <div class="body_content">
        <div class="vehicle-search-container">
            <form action="{{ route('User.Vehicle.search') }}" method="GET">
                <input type="text" name="query" placeholder="Search..." class="search-input" value="{{ request('query') }}">
                <button type="submit" class="search-button">Search Vehicles</button>
            </form>
        </div>

        <div class="main-card">
            @if(isset($searchResults))
            <div class="search-results mt-4">
                @if($searchResults->isEmpty())
                <p>No vehicles found matching your query.</p>
                @else
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($searchResults as $vehicle)
                    <div class="col">
                        <div class="card">
                            <div id="carousel{{ $vehicle->vehicle_no }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($vehicle->images as $image)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img src="{{ Storage::url($image->image_path) }}" class="d-block w-100" alt="Vehicle Image">
                                    </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $vehicle->vehicle_no }}" data-bs-slide="prev">

                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $vehicle->vehicle_no }}" data-bs-slide="next">

                                </button>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $vehicle->vehicle_name }}</h5>
                                <ul>
                                    <li>Vehicle Type: {{ $vehicle->type }}</li>
                                    <li>Brand of Manufacture: {{ $vehicle->model }}</li>
                                    <li>Year of Manufacture: {{ $vehicle->yom }}</li>
                                    <li>Status: {{ $vehicle->v_status }}</li>
                                    <li>Selling Price: {{ $vehicle->selling }}</li>
                                    <li>Vehicle No: {{ $vehicle->vehicle_no }}</li>
                                    <li><button><a href="{{route('User.Order.create', $vehicle) }}">Reserve</a></button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="main-card">
                @else
                <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
                    @foreach($vehicles as $vehicle)
                    <div class="col">
                        <div class="card">
                            <div id="carousel{{ $vehicle->vehicle_no }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($vehicle->images as $image)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img src="{{ Storage::url($image->image_path) }}" class="d-block w-100" alt="Vehicle Image">
                                    </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $vehicle->vehicle_no }}" data-bs-slide="prev">

                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $vehicle->vehicle_no }}" data-bs-slide="next">

                                </button>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $vehicle->vehicle_name }}</h5>
                                <ul>
                                    <li>Vehicle Type: {{ $vehicle->type }}</li>
                                    <li>Brand of Manufacture: {{ $vehicle->model }}</li>
                                    <li>Year of Manufacture: {{ $vehicle->yom }}</li>
                                    <li>Status: {{ $vehicle->v_status }}</li>
                                    <li>Selling Price: {{ $vehicle->selling }}</li>
                                    <li>Vehicle No: {{ $vehicle->vehicle_no }}</li>
                                    <li><button class="btn btn-info"><a href="{{route('User.Order.create', $vehicle) }}">Reserve</a></button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
