$(document).ready(function () {
    var table = $('#categorymasterlist').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/admin/categorymasterlist/getData",
            "type": "GET"
        },
        "columns": [
            { "data": "categoryname" },
            {
                "data" : "categoryimage",
                "render" : function(data, type, row) {
                    return `<img src="/${row.categoryimage}" style="width: 30%;" />`;
                }
            },
            {
                "data": "is_top_category",
                "render": function(data, type, row) {
                    let checked = row.is_top_category === 'Yes' ? 'checked' : '';
                    return `
                        <label class="switch">
                            <input type="checkbox" class="top-category-checkbox" data-id="${row.category_id}" ${checked}>
                            <span class="slider round"></span>
                        </label>`;
                }
            },
            {
                "data": null,
                "render": function (data, type, row) {
                    return `<a href="/admin/edit-category/${row.category_id}" title="Edit" class="edit-btn" data-id="${row.category_id}" style="color: blue;"><i class="fa fa-edit" style="font-size: 18px;"></i></a>
                            <a href="#" title="Delete" class="delete-btn" data-id="${row.category_id}" style="color: red;"><i class="fa fa-trash" style="font-size: 18px;"></i></a>`;
                }
            }
        ]
    });

    // Toggle switch logic for top category update
    $(document).on('change', '.top-category-checkbox', function () {
        var id = $(this).data('id');
        var isChecked = $(this).is(':checked');
        var status = isChecked ? 'Yes' : 'No';

        $.ajax({
            url: '/admin/categorymasterlist/updateTopCategory/' + id,
            method: 'POST',
            data: { is_top_category: status },
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Top category status updated successfully!',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to update the category status!',
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong with the request!',
                });
            }
        });
    });

    $(document).on('click', '.delete-btn', function () {
        var id = $(this).data('id');
        var row = $(this).closest('tr');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/categorymasterlist/delete/' + id,
                    method: 'DELETE',
                    success: function (response) {
                        if (response.status === 'success') {
                            table.row(row).remove().draw(false);
                        } else {
                            // Handle unsuccessful deletion
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            });
                        }
                    },
                    error: function () {
                        // Handle AJAX request error
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong with the request!',
                        });
                    }
                });
            }
        });
    });
});
