$(document).ready(function() {
    $('#edituser').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Get form data
        let user_id = $('#user_id').val();
        let firstname = $('#firstname').val();
        let lastname = $('#lastname').val();
        let username = $('#username').val();
        let emailaddress = $('#emailaddress').val();
        let password = $('#password').val();
        let usertype = $('#usertype').val();
        let profileImage = $('#image')[0].files[0]; // Get the file

        // Perform client-side validation
        if (firstname.trim() === '' || lastname.trim() === '' || username.trim() === '' || emailaddress.trim() === '' || password.trim() === '' || usertype.trim() === '') {
            // Show error using SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in the required fields!',
            });
            return;
        }

        let formData = new FormData();
        formData.append('user_id', user_id);
        formData.append('firstname', firstname);
        formData.append('lastname', lastname);
        formData.append('username', username);
        formData.append('emailaddress', emailaddress);
        formData.append('password', password);
        formData.append('usertype', usertype);
        formData.append('image', profileImage); // Append file to formData

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '/admin/edituser/update',
            data: formData, // Serialize form data
            contentType: false, // Important for sending files
            processData: false, // Prevent jQuery from processing data
            dataType: 'json',
            beforeSend: function() {
                // Show loading effect
                Swal.fire({
                    title: 'Updating...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response) {
                if (response.success) {
                    // Redirect upon successful login
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Updated',
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
                    text: 'An error occurred while logging in. Please try again later.',
                });
                console.error(xhr.responseText);
            }
        });
    });
});