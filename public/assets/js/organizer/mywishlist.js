$(document).ready(function () {
    function formatEventId(eventId) {
        // Ensure eventId is a number or a string that can be converted to a number
        eventId = parseInt(eventId, 10);
        
        // Format the ID with a "CA" prefix and zero-padded to 5 digits
        return `CA${eventId.toString().padStart(5, '0')}`;
    }
    var table = $('#mywishlist').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/organizer/mywishlist/getData",
            "type": "GET"
        },
        "columns": [
            {
                "data": "wishlist_id",
                "render": function (data, type, row) {
                    // Format wishlist_id using formatEventId function
                    return formatEventId(data);
                }
            },
            { "data": "eventname" },
            { "data": "eventtype" },
            { "data": "eventdate" },
            { "data": "eventstartingtime" },
            { "data": "eventendingtime" },
            { "data": "recurrence" },
            { "data": "locationname" },
            { "data": "state_name" },
            { "data": "cityname" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return `<a href="#" title="Delete" class="delete-btn" data-id="${row.wishlist_id}" style="color: red;"><i class="fa fa-trash" style="font-size: 18px;"></i></a>`;
                }
            }
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data.wishlist_id);
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
                    url: '/organizer/mywishlist/delete/' + id,
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
