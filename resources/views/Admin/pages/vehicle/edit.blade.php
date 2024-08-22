@extends('Admin.adminHome')
@section('Header')
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Admin.pages.main')}}"><i class="bi bi-house-fill text-black">Home</i></a></li>
                        <li class="breadcrumb-item text-black"><a href="{{route('Admin.pages.vehicle.vehicleHome')}}">
                                <span>
                                    Vehicles
                                </span>
                            </a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
</div>
@endsection
@section('Admin_Content')
<div class="vrhicle_create">
    <div class="container_create">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('Admin.pages.vehicle.update',$vehicle->vehicle_no)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Form fields here -->
                            <div class="mb-3">
                                <label for="vehicle_name" class="form-label">Vehicle Name</label>
                                <input type="text" class="form-control" name="vehicle_name" value="{{ $vehicle->vehicle_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control" name="model" value="{{ $vehicle->model }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Vehicle Type</label>
                                <input type="text" class="form-control" name="type" value="{{ $vehicle->type }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="chassis_no" class="form-label">Chassis Number</label>
                                <input type="text" class="form-control" name="chassis_no" value="{{ $vehicle->chassis_no }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="engine_no" class="form-label">Engine Number</label>
                                <input type="text" class="form-control" name="engine_no" value="{{ $vehicle->engine_no }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="yom" class="form-label">Year of Manufacture</label>
                                <input type="date" class="form-control" name="yom" value="{{ $vehicle->yom }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="v_status" class="form-label">Vehicle Status</label>
                                <input type="text" class="form-control" name="v_status" value="{{ $vehicle->v_status }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Buying Price</label>
                                <input type="text" class="form-control" name="buying" value="{{ $vehicle->buying }}">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Selling Price</label>
                                <input type="text" class="form-control" name="selling" value="{{ $vehicle->selling }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="images" class="form-label">Upload Images</label>
                                <input type="file" class="form-control" name="images[]" multiple>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
