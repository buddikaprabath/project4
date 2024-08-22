@extends('Admin.adminHome')

@section('Header')
<h1>Invoice</h1>
<div class="invoiceheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><i>Invoice</i></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.pages.Invoice.invoiceIndex') }}">Invoice Details</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-4 text-end">
                <form action="{{ route('Admin.pages.Invoice.invoiceIndex') }}" method="GET" class="d-flex">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-dark" type="submit">Search</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('Admin_Content')
<div class="invoicecontainer">
    <h2>Invoices</h2>
    <a href="{{ route('Admin.pages.Invoice.create') }}" class="btn btn-info">
        Make Invoice
    </a>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Customer</th>
                <th>Vehicle</th>
                <th>Advance payment</th>
                <th>Selling Price</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->customer->name }}</td>
                <td>{{ $invoice->vehicle->vehicle_name }}</td>
                <td>{{ $invoice->vehicle->advancepayment}}</td>
                <td>{{ $invoice->vehicle->selling }}</td>
                <td>{{ $invoice->total_bill_amount}}</td>
                <td>
                    <a href="{{ route('Admin.pages.Invoice.show', $invoice->id) }}" class="btn btn-info">Print</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
