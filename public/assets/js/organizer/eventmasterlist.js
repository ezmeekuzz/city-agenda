$(document).ready(function () {
    var table = $('#eventmasterlist').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/organizer/eventmasterlist/getData",
            "type": "GET"
        },
        "columns": [
            { 
                data: null,
                render: function (data, type, row) {
                    return `${row.firstname} ${row.lastname}`;
                }
            },
            { "data": "emailaddress" },
            { "data": "eventname" },
            { "data": "eventtype" },
            { "data": "eventdate" },
            { "data": "eventstartingtime" },
            { "data": "eventendingtime" },
            { "data": "recurrence" },
            { "data": "locationname" },
            { "data": "state_name" },
            { "data": "cityname" },
            { "data": "publishstatus" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return `<a href="/organizer/edit-event/${row.event_id}" title="Edit" class="edit-btn" data-id="${row.event_id}" style="color: blue;"><i class="fa fa-edit" style="font-size: 18px;"></i></a>
                            <a href="/organizer/add-ticketing/${row.event_id}" title="Add Ticketing" class="ticketing-btn" data-id="${row.event_id}" style="color: green;"><i class="fa fa-ticket" style="font-size: 18px;"></i></a>
                            <a href="#" title="Delete" class="delete-btn" data-id="${row.event_id}" style="color: red;"><i class="fa fa-trash" style="font-size: 18px;"></i></a>`;
                }
            }
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data.event_id);
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
                    url: '/organizer/eventmasterlist/delete/' + id,
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
