@extends('welcome')
@section('Home_Content')

<div class="container">
    <div class="about-section">
        <h2>Who We Are</h2>
        <p>S&S Sell is a leading vehicle sales company dedicated to providing our customers with the best vehicles at competitive prices. We specialize in a wide range of vehicles and offer exceptional customer service to ensure you find the perfect vehicle to meet your needs.</p>
    </div>

    <div class="services-section">
        <h2>What We Offer</h2>
        <ul class="services-list">
            <li>Comprehensive vehicle details management including price, chassis number, engine number, and vehicle type.</li>
            <li>Detailed customer information management for both buyers and sellers, including contact details and transaction dates.</li>
            <li>Leasing details management to keep track of leasing companies, dates, down payments, and prices.</li>
            <li>Search functionality to easily find vehicle details and customer information using the vehicle number.</li>
            <li>Monthly profit reports and individual profit analysis for each vehicle.</li>
            <li>Image management for storing vehicle book images, seller IDs, and buyer IDs.</li>
            <li>Automated messaging system to notify customers when new vehicles arrive.</li>
            <li>Notification system for important activities such as adding vehicles, profit changes, and payment reminders.</li>
        </ul>
    </div>

    <div class="contact-section">
        <h2>Contact Us</h2>
        <ul class="contact-details">
            <li>Address: 123 Sales St, Business City, BC 12345</li>
            <li>Phone: (123) 456-7890</li>
            <li>Email: info@sandsell.com</li>
        </ul>
    </div>
</div>

@endsection
