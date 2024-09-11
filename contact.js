document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const confirmationMessage = document.getElementById('confirmationMessage');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting

        // Show the confirmation message
        confirmationMessage.classList.remove('hidden');

        // Hide the message after 5 seconds
        setTimeout(function() {
            confirmationMessage.classList.add('hidden');
        }, 1500); // Hide after 5 seconds (5000 milliseconds)

        // Clear the form fields
        form.reset();
    });
});
