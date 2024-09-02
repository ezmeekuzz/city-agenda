$(document).ready(function() {
    $('#addblog').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();
    
        // Get form data
        var title = $('#title').val().trim();
        var description = $('#description').val().trim();
        var content = $('#content').val().trim();
        var tags = $('#tags').val().trim();
        var blogimage = $('#blogimage').val().trim();
        var blogimageExt = blogimage.split('.').pop().toLowerCase();
        var validImageExtensions = ['jpg', 'jpeg', 'png'];
    
        // Perform client-side validation
        if (!title || !description || !content || !tags || !blogimage || $('input[name="category_id[]"]:checked').length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all the required fields!',
            });
            return;
        }
    
        // Validate image extension
        if (!validImageExtensions.includes(blogimageExt)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid image format. Only JPG, JPEG, and PNG are allowed.',
            });
            return;
        }
    
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '/admin/addblog/insert',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
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
                    // Reset form fields
                    $('#addblog')[0].reset();
                    $('#content').summernote('reset');
    
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    }).then(() => {
                        // Redirect after successful submission
                        window.location.href = "/admin/add-blog";
                    });
                } else {
                    let errorMsg = response.message === 'Exist' 
                        ? 'Blog title already exists!' 
                        : 'Failed to add blog post. Please try again.';
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning',
                        text: errorMsg,
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

    $('#content').summernote({
        toolbar: [
            ['style', ['style']],
            ['fontsize', ['fontsize']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['picture', 'hr']],
            ['table', ['table']]
        ],
        tabsize: 2,
        height: 250,
        fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
        followingToolbar: false
    });
});
function filter() {
    var search = $('#searchcategory').val().toUpperCase();
    var ul = document.getElementById('categorylist');
    var li = ul.getElementsByTagName('li');
    for(var i = 0; i < li.length; i++) {
        var label = li[i].getElementsByTagName('label')[0];
        if(label.innerHTML.toUpperCase().indexOf(search) > -1) {
            li[i].style.display = "";
        }
        else {
            li[i].style.display = "none";
        }
    }
}
