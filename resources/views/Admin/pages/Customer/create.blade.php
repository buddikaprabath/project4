@extends('Admin.adminHome')

@section('Header')
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Admin.pages.main')}}"><i class="bi bi-house-fill text-black">Home</i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('Admin.pages.Customer.customerHome')}}">
                                <span>
                                    Customers
                                </span>
                            </a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('Admin_Content')
<div class="customers_create">
    <div class="container_create">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('Admin.pages.Customer.store') }}" method="POST" onsubmit="return validateForm()">
                            @csrf
                            <div class="mb-3">
                                <label for="National_id" class="form-label">National ID</label>
                                <input type="text" class="form-control" id="national_id" name="national_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" name="Customer_Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Customer Address</label>
                                <input type="text" class="form-control" name="Customer_Address" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="Customer_Phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type:</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        const nationalId = document.getElementById('national_id').value;
        const regex = /^(?:\d{9}[vV]|[0-9]{12})$/;

        if (!regex.test(nationalId)) {
            alert('Invalid National ID format. Please enter a valid National ID.');
            return false;
        }
        return true;
    }
</script>

@endsection
