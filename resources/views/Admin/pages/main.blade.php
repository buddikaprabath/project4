@extends('Admin.adminHome')

@section('Admin_Content')
<div class="container">
    <h1>Dashboard</h1>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Summary Report
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sales Vehicle</td>
                                <td>{{ $soldVehiclesCount }}</td>
                            </tr>
                            <tr>
                                <td>Orders</td>
                                <td>{{ $ordersCount }}</td>
                            </tr>
                            <tr>
                                <td>Customers</td>
                                <td>{{ $customersCount }}</td>
                            </tr>
                            <tr>
                                <td>Total Profit</td>
                                <td>{{ $totalProfit }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
