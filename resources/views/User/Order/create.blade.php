@extends('User.home')

@section('User_Content')
<div class="ordercreatecontainer">
    <h2>Reserve Vehicle: {{ $vehicle->vehicle_name }}</h2>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="card-body">
        <div class="carousel-inner">
            @foreach($vehicle->images as $image)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="{{ Storage::url($image->image_path) }}" class="d-block w-100" alt="Vehicle Image">
            </div>
            @endforeach
        </div>
        <ul>
            <li>Vehicle Type: {{ $vehicle->type }}</li>
            <li>Brand of Manufacture: {{ $vehicle->model }}</li>
            <li>Year of Manufacture: {{ $vehicle->yom }}</li>
            <li>Status: {{ $vehicle->v_status }}</li>
            <li>Selling Price: {{ $vehicle->selling }}</li>
            <li>Vehicle No: {{ $vehicle->vehicle_no }}</li>
        </ul>
    </div>
    <form action="{{ route('User.Order.store', $vehicle) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Reserve</button>
    </form>
</div>
@endsection
