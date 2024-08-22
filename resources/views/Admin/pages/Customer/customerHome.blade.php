@extends('Admin.adminHome')
@section('Header')
<h1>Customers</h1>
<div class="customerheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.pages.main') }}"><i class="bi bi-house-fill text-black">Home</i></a></li>
                        <li class="breadcrumb-item"><a href="#">Customers</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-4 text-end">

                <a href="{{ route('Admin.pages.Customer.create') }}" class="btn btn-light ms-2">
                    Add New
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('Admin_Content')
<div class="customers">
    <div class="card border-0 shadow">
        <div class="table-responsive py-5">
            <form action="{{ route('Admin.pages.Customer.search') }}" method="GET" class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
            <table class="table datatables" id="customers-table">
                <!-- Table header -->
                <thead class="thead-light">
                    <tr>
                        <th>National ID</th>
                        <th>Customer Name</th>
                        <th>Customer Address</th>
                        <th>Customer Phone</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->national_id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->customer_address }}</td>
                        <td>{{ $customer->customer_phone }}</td>
                        <td>
                            @if ($customer->ctype === 'buyer')
                            Buyer
                            @elseif ($customer->ctype === 'seller')
                            Seller
                            @else
                            Unknown
                            @endif
                        </td>
                        <td>{{ $customer-> email}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('Admin.pages.Customer.edit', $customer->national_id) }}" class="btn btn-primary me-2">Edit</a>
                                <form action="{{ route('Admin.pages.Customer.delete', $customer->national_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
