@extends('Admin.adminHome')

@section('Header')
<h1>Vehicles</h1>
<div class="vehicle-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.pages.main') }}"><i class="bi bi-house-fill text-black">Home</i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('Admin.pages.vehicle.vehicleHome')}}">Vehicles</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-8 text-end">
                <a href="{{ route('Admin.pages.vehicle.create') }}" class="btn btn-info">
                    Add New
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('Admin_Content')
<div class="vehicle">
    <div class="card border-0 shadow">
        <div class="table-responsive py-5">
            <!-- Search Box -->
            <div class="mb-3">
                <form action="{{ route('Admin.pages.vehicle.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" placeholder="Search by vehicle name, model, or type">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>

            <table class="table datatables" id="vehicle-table">
                <thead class="thead-light">
                    <tr>
                        <th>Vehicle NO</th>
                        <th>Vehicle Name</th>
                        <th>Model</th>
                        <th>Vehicle Type</th>
                        <th>Chassis NO</th>
                        <th>Engine NO</th>
                        <th>YOM</th>
                        <th>Vehicle Status</th>
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($searchResults ?? [] as $vehicle)
                    <tr>
                        <td>{{ $vehicle->vehicle_no }}</td>
                        <td>{{ $vehicle->vehicle_name }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->type }}</td>
                        <td>{{ $vehicle->chassis_no }}</td>
                        <td>{{ $vehicle->engine_no }}</td>
                        <td>{{ $vehicle->yom }}</td>
                        <td>{{ $vehicle->v_status }}</td>
                        <td>{{ $vehicle->buying }}</td>
                        <td>{{ $vehicle->selling }}</td>
                        <td>
                            <a href="{{ route('Admin.pages.vehicle.edit', ['vehicle_no' => urlencode($vehicle->vehicle_no)]) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('Admin.pages.vehicle.delete', ['vehicle_no' => urlencode($vehicle->vehicle_no)]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    @foreach ($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->vehicle_no }}</td>
                        <td>{{ $vehicle->vehicle_name }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->type }}</td>
                        <td>{{ $vehicle->chassis_no }}</td>
                        <td>{{ $vehicle->engine_no }}</td>
                        <td>{{ $vehicle->yom }}</td>
                        <td>{{ $vehicle->v_status }}</td>
                        <td>{{ $vehicle->buying }}</td>
                        <td>{{ $vehicle->selling }}</td>
                        <td>
                            <a href="{{ route('Admin.pages.vehicle.edit', ['vehicle_no' => urlencode($vehicle->vehicle_no)]) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('Admin.pages.vehicle.delete', ['vehicle_no' => urlencode($vehicle->vehicle_no)]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
