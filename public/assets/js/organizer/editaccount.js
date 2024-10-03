$(document).ready(function () {
    // Handle the change picture button click to trigger the hidden file input
    $('#changePictureButton').on('click', function () {
        $('#profilePicture').click();
    });

    // Preview the uploaded image
    $('#profilePicture').on('change', function () {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#profilePicturePreview').attr('src', e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });

    // Submit the form via AJAX
    $('#editaccount').on('submit', function (e) {
        e.preventDefault();

        // Create a FormData object to include image and form data
        var formData = new FormData(this);

        // Append profile picture if it's selected
        var fileInput = $('#profilePicture')[0];
        var coverPhotoInput = $('#coverPhotoInput')[0];
        if (fileInput.files.length > 0) {
            formData.append('profilePicture', fileInput.files[0]);  // Append the image to the formData
        }

        if (coverPhotoInput.files.length > 0) {
            formData.append('coverPhoto', coverPhotoInput.files[0]);  // Append the image to the formData
        }

        $.ajax({
            url: '/organizer/editaccount/update',  // Controller method to handle form submission
            type: 'POST',
            data: formData,
            contentType: false,  // Required for file uploads
            processData: false,  // Required for file uploads
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Account updated successfully!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // Optionally, reload the page or redirect to another page
                    window.location.reload();
                });
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error updating account!',
                    text: xhr.responseText,
                    showConfirmButton: true
                });
            }
        });
    });
});
document.getElementById('changeCoverPhotoButton').addEventListener('click', function() {
    document.getElementById('coverPhotoInput').click();
});

document.getElementById('coverPhotoInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('coverPhotoPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

document.getElementById('changePictureButton').addEventListener('click', function() {
    document.getElementById('profilePicture').click();
});

document.getElementById('profilePicture').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePicturePreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
