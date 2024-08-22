// Custom JavaScript for home page (if any)

// Initialize all carousels
document.addEventListener('DOMContentLoaded', function() {
    var carousels = document.querySelectorAll('.carousel');
    carousels.forEach(function(carousel) {
        var carouselInstance = new bootstrap.Carousel(carousel, {
            interval: 5000, // Set the interval between slides in milliseconds
            ride: 'carousel' // Autostart the carousel
        });
    });
});
