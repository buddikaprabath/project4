@extends('Admin.adminHome')

@section('Admin_Content')
<div class="container">
    <h2>Payment Details</h2>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>User Name</th>
                <th>User National ID</th>
                <th>Vehicle Name</th>
                <th>Vehicle Number</th>
                <th>Payment Slip</th>
                <th>Advances Payments</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->user->name }}</td>
                <td>{{ $payment->user->national_id }}</td>
                <td>{{ $payment->vehicle->vehicle_name }}</td>
                <td>{{ $payment->vehicle->vehicle_no }}</td>
                <td>
                    <a href="#" class="view-payment-slip" data-bs-toggle="modal" data-bs-target="#paymentSlipModal" data-image-url="{{ asset('storage/' . $payment->bankslip_path) }}">
                        View Payment Slip
                    </a>
                </td>
                <td>{{ $payment->vehicle->advancepayment }}</td>
                <td>
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addAmountModal" data-vehicle-no="{{ $payment->vehicle->vehicle_no }}">ADD Amount</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Payment Slip Modal -->
<div class="modal fade" id="paymentSlipModal" tabindex="-1" aria-labelledby="paymentSlipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentSlipModalLabel">Payment Slip</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="paymentSlipImage" src="" alt="Payment Slip" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- Add Amount Modal -->
<div class="modal fade" id="addAmountModal" tabindex="-1" aria-labelledby="addAmountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAmountModalLabel">Add Advance Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAmountForm" method="POST" action="{{ route('Admin.pages.payment.addAdvancePayment') }}">
                    @csrf
                    <input type="hidden" name="vehicle_no" id="vehicleNo">
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var paymentSlipModal = document.getElementById('paymentSlipModal');
        paymentSlipModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var imageUrl = button.getAttribute('data-image-url');
            var modalImage = paymentSlipModal.querySelector('#paymentSlipImage');
            modalImage.src = imageUrl;
        });

        var addAmountModal = document.getElementById('addAmountModal');
        addAmountModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var vehicleNo = button.getAttribute('data-vehicle-no');
            var modalVehicleNoInput = addAmountModal.querySelector('#vehicleNo');
            modalVehicleNoInput.value = vehicleNo;
        });
    });

</script>
@endsection
