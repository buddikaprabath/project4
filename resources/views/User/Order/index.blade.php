@extends('User.home')

@section('User_Content')
<div class="ordercontainer">
    <h2>{{ Auth::user()->name }} Orders</h2>

    <!-- Search Form -->
    <form action="{{ route('User.Order.search') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search by Order ID, Vehicle Name, Vehicle No, Order Date">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    <div class="card">
        <!-- Order Cards with Scrollbar -->
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
        <div class="card-group overflow-auto" style="max-height: 400px;">
            @foreach($orders as $order)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $order->status }}
                </div>
                <div class="card-body">
                    <ul>
                        <li>Vehicle Name: {{ $order->vehicle->vehicle_name }}</li>
                        <li>Vehicle Model: {{ $order->vehicle->model }}</li>
                        <li>Vehicle No: {{ $order->vehicle->vehicle_no }}</li>
                        @if($order->status == 'confirmed')
                        <li>Payment:
                            <a href="{{ route('User.Payment.payment', $order->id) }}" class="btn btn-sm btn-success">Pay Now</a>
                        </li>
                        @endif
                        <li>
                            <form action="{{ route('User.Order.delete', $order->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete Order</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
