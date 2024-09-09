$('#publishEvent').on('submit', function(event) {
    event.preventDefault(); // Prevent form from submitting the default way

    // Show loading effect using SweetAlert2
    Swal.fire({
        title: 'Publishing Event...',
        text: 'Please wait while we process your request.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading(); // Show loading spinner
        }
    });

    // Prepare form data for submission
    var formData = $(this).serialize();

    // AJAX call to submit the form data
    $.ajax({
        url: '/admin/publishevent/update', // Your server-side form handler
        method: 'POST',
        data: formData,
        success: function(response) {
            Swal.close(); // Close the loading effect

            // Check if the response indicates success
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Event Published!',
                    text: 'Your event has been successfully published.',
                    confirmButtonText: 'OK'
                }).then(function() {
                    // Optionally, redirect after success
                    window.location.href = '/admin/event-masterlist'; // Redirect to the events page
                });
            } else {
                // Handle case where the server responds with an error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Something went wrong while publishing the event. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.close(); // Close the loading effect

            // Show error alert if AJAX fails
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while processing your request. Please try again later.',
                confirmButtonText: 'OK'
            });
        }
    });
});