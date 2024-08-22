<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        /* Add your PDF specific styles here */

    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>S&S SALE</h3>
                <p>123 Main Street</p>
                <p>City, State, ZIP</p>
                <p>Phone: (555) 555-5555</p>
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
                    <th>Selling Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $invoice->vehicle->vehicle_no }}</td>
                    <td>{{ $invoice->vehicle->vehicle_name }}</td>
                    <td>{{ $invoice->vehicle->model }}</td>
                    <td>{{ $invoice->vehicle->type }}</td>
                    <td>{{ $invoice->vehicle->selling }}</td>
                </tr>
            </tbody>
        </table>
        <div class="text-end mt-4">
            <h3>Total Amount: ${{ $invoice->total_amount }}</h3>
        </div>
    </div>
</body>
</html>
