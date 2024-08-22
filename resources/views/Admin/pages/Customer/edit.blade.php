@extends('Admin.adminHome')

@section('Header')
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.pages.main') }}"><i class="bi bi-house-fill text-white"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.pages.Customer.customerHome') }}">Customers</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('Admin_Content')
<div class="customers">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('Admin.pages.Customer.update', ['id' => $Customer->national_id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Method spoofing for PUT request -->


                            <div class="mb-3">
                                <label for="name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" name="Customer_Name" value="{{ $Customer->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Customer Address</label>
                                <input type="text" class="form-control" name="Customer_Address" value="{{ $Customer->customer_address }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="Customer_phone" value="{{ $Customer->customer_phone }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Status</label>
                                <select name="ctype" id="type" class="form-control" required>
                                    <option value="buyer" {{ $Customer->ctype === 'buyer' ? 'selected' : '' }}>Buyer</option>
                                    <option value="seller" {{ $Customer->ctype === 'seller' ? 'selected' : '' }}>Seller</option>
                                </select>
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
