$(document).ready(function() {
    $('#addcategory').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Create a FormData object to hold the form data and file
        var formData = new FormData(this);

        // Perform client-side validation
        var categoryname = $('#categoryname').val();
        let categoryimage = $('#categoryimage')[0].files[0]; // Get the file

        if (categoryname.trim() === '' || !categoryimage) {
            // Show error using SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all the required fields!',
            });
            return;
        }

        // Send AJAX request with FormData (includes the file)
        $.ajax({
            type: 'POST',
            url: '/admin/addcategory/insert',
            data: formData,
            contentType: false,  // Prevent jQuery from processing the data
            processData: false,  // Prevent jQuery from converting it to a string
            dataType: 'json',
            beforeSend: function() {
                // Show loading effect
                Swal.fire({
                    title: 'Saving...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response) {
                if (response.success) {
                    // Reset form and show success message
                    $('#addcategory')[0].reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    });
                } else {
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX errors
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred. Please try again later.',
                });
                console.error(xhr.responseText);
            }
        });
    });
});
