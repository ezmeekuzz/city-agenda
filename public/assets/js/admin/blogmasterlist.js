$(document).ready(function () {
    var table = $('#blogmasterlist').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/admin/blogmasterlist/getData",
            "type": "GET"
        },
        "columns": [
            { "data": "title" },
            {
                "data": "description",
                "render": function (data, type, row) {
                    var maxLength = 50; // Set your preferred maximum length here
                    if (data.length > maxLength) {
                        return `<span title="${data}">${data.substring(0, maxLength)}&hellip;</span>`;
                    } else {
                        return data;
                    }
                }
            },
            { "data": "tags" },
            { "data": "dateadded" },
            { "data": "publishstatus" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return `<a href="/admin/edit-blog/${row.blog_id}" title="Edit" class="edit-btn" data-id="${row.blog_id}" style="color: blue;"><i class="fa fa-edit" style="font-size: 18px;"></i></a>
                            <a href="#" title="Delete" class="delete-btn" data-id="${row.blog_id}" style="color: red;"><i class="fa fa-trash" style="font-size: 18px;"></i></a>`;
                }
            }
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data.blog_id);
        },
        "initComplete": function (settings, json) {
            $(this).trigger('dt-init-complete');
        }
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
                    url: '/admin/blogmasterlist/delete/' + id,
                    method: 'DELETE',
                    success: function (response) {
                        if (response.status === 'success') {
                            table.row(row).remove().draw(false);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
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
            }
        });
    });
});
