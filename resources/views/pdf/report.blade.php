<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
</head>
<body>
    <h1>Report</h1>
    <p>Title: {{ $reportData['title'] }}</p>
    <p>Description: {{ $reportData['description'] }}</p>

    <h2>Invoices</h2>
    <ul>
        @foreach ($reportData['invoices'] as $invoice)
        <li>{{ $invoice->id }} - {{ $invoice->total_amount}}</li>
        @endforeach
    </ul>

    <h2>Orders</h2>
    <ul>
        @foreach ($reportData['orders'] as $order)
        <li>{{ $order->id }} - {{ $order->vehicle->vehicle_name}}</li>
        @endforeach
    </ul>

    <h2>Vehicles</h2>
    <ul>
        @foreach ($reportData['vehicles'] as $vehicle)
        <li>{{ $vehicle-> vehicle_no}} - {{ $vehicle->vehicle_name }}</li>
        @endforeach
    </ul>
</body>
</html>
