@extends('Admin.adminHome')

@section('Admin_Content')
<div class="ordercontainer">
    <h2>All Orders</h2>
    <!-- Display success message -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @foreach($orders as $userId => $userOrders)
    <div class="user-orders">
        <h3>{{ $userOrders->first()->user->name }}'s Orders</h3>
        <h4>{{ $userOrders->first()->user->customer_phone }}</h4>
        <ul>
            @foreach($userOrders as $order)
            <li>
                {{ $order->vehicle->vehicle_name }} - {{ $order->status }}
                @if($order->status == 'pending')
                <form action="{{ route('Admin.pages.Orders.confirm', $order) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">Confirm</button>
                </form>
                <form action="{{ route('Admin.pages.Orders.cancel', $order) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </form>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
    @endforeach
</div>
@endsection
