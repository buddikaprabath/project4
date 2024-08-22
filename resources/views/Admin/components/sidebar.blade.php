<div class="sidebar-item">
    <ul class="nav">
        <li class="nav-link"><i class="bi bi-house-fill"></i><a href="{{route('Admin.pages.main')}}">HOME</a></li>
        <li class="nav-link"><i class="bi bi-car-front-fill"></i><a href="{{route('Admin.pages.vehicle.vehicleHome')}}">VEHICLE</a></li>
        <li class="nav-link"><i class="bi bi-people-fill"></i><a href="{{route('Admin.pages.Customer.customerHome')}}">CUSTOMER</a></li>
        <li class="nav-link"><i class="bi bi-cart-plus"></i><a href="{{ route('Admin.pages.Orders.index') }}">ORDERS</a></li>
        <li class="nav-link"><i class="bi bi-cash-stack"></i><a href="{{ route('Admin.pages.Invoice.invoiceIndex') }}">INVOICE</a></li>
        <li class="nav-link"><i class="bi bi-cash-stack"></i><a href="{{ route('Admin.pages.payment.paymentdetail') }}">PAYMENTS</a></li>
        <li class="nav-link"><i class="bi bi-envelope-at"></i><a href="{{ route('Admin.pages.message.inbox') }}">MESSAGES</a></li>
        <li class="nav-link"><i class="bi bi-receipt-cutoff"></i><a href="{{ route('Admin.pages.Report.reportdetails') }}">REPORT</a></li>
    </ul>
</div>
