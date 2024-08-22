@extends('Admin.adminHome')

@section('Header')
<h1>Create Invoice</h1>
@endsection

@section('Admin_Content')
<div class="container">
    <form action="{{ route('Admin.pages.Invoice.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="national_id" class="form-label">Customer</label>
            <select class="form-select" id="national_id" name="national_id" required>
                @foreach($customers as $customer)
                <option value="{{ $customer->national_id }}">{{ $customer->name }} - {{ $customer->national_id }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="vehicle_id" class="form-label">Vehicle</label>
            <select class="form-select" id="vehicle_id" name="vehicle_no" required>
                @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->vehicle_no }}" data-selling="{{ $vehicle->selling }}" data-advancepayment="{{ $vehicle->advancepayment ?? 0 }}">{{ $vehicle->vehicle_no }} - {{ $vehicle->model }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="advance_payment" class="form-label">Advance Payment</label>
            <input type="number" class="form-control" id="advance_payment" name="advance_payment" readonly>
        </div>
        <div class="mb-3">
            <label for="total_amount" class="form-label">Vehicle Price</label>
            <input type="number" class="form-control" id="total_amount" name="total_amount" readonly>
        </div>
        <div class="mb-3">
            <label for="total_bill_amount" class="form-label">Total Bill Amount</label>
            <input type="number" class="form-control" id="total_bill_amount" name="total_bill_amount" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#national_id').select2({
            placeholder: "Search for a customer"
            , allowClear: true
        });

        $('#vehicle_id').select2({
            placeholder: "Search for a vehicle"
            , allowClear: true
        }).on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var sellingPrice = selectedOption.data('selling');
            var advancePayment = selectedOption.data('advancepayment') || 0;

            $('#advance_payment').val(advancePayment);
            $('#total_amount').val(sellingPrice);

            var totalBillAmount = sellingPrice - advancePayment;
            $('#total_bill_amount').val(totalBillAmount);
        });
    });

</script>
@endsection
