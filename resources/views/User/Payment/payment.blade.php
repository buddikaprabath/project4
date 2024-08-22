@extends('User.home')

@section('User_Content')
<div class="paymentcontainer">
    <h2>Payment for Order #{{ $order->id }}</h2>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('User.Payment.process', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="payment_method">Choose Payment Method:</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="card">Card Payment</option>
                <option value="bankslip">Bank Slip</option>
            </select>
        </div>

        <div id="bankslip_section" style="display: none;">
            <div class="mb-3">
                <label for="bankslip_path">Upload Bank Slip:</label>
                <input type="file" name="bankslip_path" class="form-control">
            </div>


        </div>

        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
    <h1>OR</h1>
    <div class="mb-3">
        <label for="whatsapp_qr">Scan WhatsApp QR Code to Send Bank Slip:</label>
        <img src="{{ asset('images/whatsapp-qr-code.jpg') }}" alt="WhatsApp QR Code" class="img-fluid">
    </div>
</div>

<script>
    document.getElementById('payment_method').addEventListener('change', function() {
        var paymentMethod = this.value;
        document.getElementById('bankslip_section').style.display = paymentMethod === 'bankslip' ? 'block' : 'none';
    });

</script>
@endsection
