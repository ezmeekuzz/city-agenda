$(document).ready(function() {
    $('#adduser').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Perform client-side validation
        let firstname = $('#firstname').val();
        let lastname = $('#lastname').val();
        let username = $('#username').val();
        let emailaddress = $('#emailaddress').val();
        let password = $('#password').val();
        let usertype = $('#usertype').val();
        let profileImage = $('#image')[0].files[0]; // Get the file

        if (firstname.trim() === '' || lastname.trim() === '' || username.trim() === '' || 
            emailaddress.trim() === '' || password.trim() === '' || usertype.trim() === '' || 
            !profileImage) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in the required fields, including the profile image!',
            });
            return;
        }

        // Create FormData object to handle file upload
        let formData = new FormData();
        formData.append('firstname', firstname);
        formData.append('lastname', lastname);
        formData.append('username', username);
        formData.append('emailaddress', emailaddress);
        formData.append('password', password);
        formData.append('usertype', usertype);
        formData.append('image', profileImage); // Append file to formData

        $.ajax({
            type: 'POST',
            url: '/admin/adduser/insert',
            data: formData, // Send FormData object
            contentType: false, // Important for sending files
            processData: false, // Prevent jQuery from processing data
            dataType: 'json',
            beforeSend: function() {
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
                    $('#adduser')[0].reset();
                    $('#usertype').trigger('chosen:updated');
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Saved',
                        text: response.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred while saving. Please try again later.',
                });
                console.error(xhr.responseText);
            }
        });
    });
});
