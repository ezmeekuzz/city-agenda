$(document).ready(function() {
    $('#editblog').on('submit', function(e) {
        e.preventDefault();
        
        // Validation checks
        var title = $('#title').val().trim();
        var description = $('#description').val().trim();
        var content = $('#content').val().trim();
        var blogImage = $('#blogimage').val();
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        
        if (title === '') {
            Swal.fire('Error', 'Please enter a title', 'error');
            return;
        }
        
        if (description === '') {
            Swal.fire('Error', 'Please enter a description', 'error');
            return;
        }
        
        if (content === '') {
            Swal.fire('Error', 'Please enter content', 'error');
            return;
        }
        
        if (blogImage && !allowedExtensions.exec(blogImage)) {
            Swal.fire('Error', 'Please upload a valid image file', 'error');
            return;
        }
        
        var formData = new FormData(this);
        var blogId = $('input[name="blogId"]').val();
        
        $.ajax({
            url: '/admin/editblog/update/' + blogId,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire('Success', response.message, 'success').then(() => {
                        window.location.href = '/admin/blog-masterlist';
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                Swal.fire('Error', 'An error occurred while updating the blog post. Please try again.', 'error');
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
