@extends('Admin.adminHome')

@section('Header')
<h1>Invoice #{{ $invoice->id }}</h1>
@endsection

@section('Admin_Content')
<div class="container">
    <div class="print-section">
        <div class="row">
            <div class="col-md-6">
                <h3>S&S SALE</h3>
                <p>123 Galle Street</p>
                <p>Imaduwa, Galle</p>
                <p>Phone: (071) 698-6731</p>
            </div>
            <div class="col-md-6 text-end">
                <h3>Invoice To:</h3>
                <p>{{ $invoice->customer->name }}</p>
                <p>{{ $invoice->customer->customer_address }}</p>
                <p>Phone: {{ $invoice->customer->customer_phone }}</p>
            </div>
        </div>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Vehicle No</th>
                    <th>Vehicle Name</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>Advance Payment</th>
                    <th>Selling Price</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $invoice->vehicle->vehicle_no }}</td>
                    <td>{{ $invoice->vehicle->vehicle_name }}</td>
                    <td>{{ $invoice->vehicle->model }}</td>
                    <td>{{ $invoice->vehicle->type }}</td>
                    <td>{{ $invoice->vehicle->advancepayment}}</td>
                    <td>{{ $invoice->vehicle->selling }}</td>
                    <td>{{ $invoice->total_bill_amount}}</td>
                </tr>
            </tbody>
        </table>
        <div class="text-end mt-4">
            <h3>Total Amount: ${{ $invoice->total_bill_amount }}</h3>
        </div>
    </div>
    <div class="text-end mt-4">
        <a href="{{ route('Admin.pages.Invoice.invoiceIndex') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
        <button onclick="printInvoice()" class="btn btn-primary"><i class="bi bi-printer"></i> Print Invoice</button>
    </div>

</div>
@endsection
@section('scripts')
<script>
    function printInvoice() {
        var printContents = document.querySelector('.print-section').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }

</script>
@endsection
