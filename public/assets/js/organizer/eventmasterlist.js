$(document).ready(function () {
    function formatEventId(eventId) {
        // Ensure eventId is a number or a string that can be converted to a number
        eventId = parseInt(eventId, 10);
        
        // Format the ID with a "CA" prefix and zero-padded to 5 digits
        return `<a href="#" class="event-id-link" data-id="${eventId}">CA${eventId.toString().padStart(5, '0')}</a>`;
    }
    var table = $('#eventmasterlist').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/organizer/eventmasterlist/getData",
            "type": "GET"
        },
        "columns": [
            {
                "data": "eid",
                "render": function (data, type, row) {
                    // Format event_id using formatEventId function
                    return formatEventId(data);
                }
            },
            {
                "data": "eventname",
                "render": function (data, type, row) {
                    // Format event_id using formatEventId function
                    return `<a href="/${row.sl}" target="_blank">${row.eventname}</a>`;
                }
            },
            { "data": "locationname" },
            {
                "data": null, // Use null since you're combining two fields (eventdate and eventstartingtime)
                "render": function (data, type, row) {
                    // Format the date
                    var eventDate = new Date(row.eventdate);
                    var options = { month: 'short', day: 'numeric', year: 'numeric' };
                    var formattedDate = eventDate.toLocaleDateString('en-US', options); // Jul 19, 2024
                    var weekday = eventDate.toLocaleDateString('en-US', { weekday: 'long' }); // Saturday
                    
                    // Format the time (eventstartingtime is already in time format "HH:MM:SS")
                    var timeString = row.eventstartingtime;
                    var [hours, minutes] = timeString.split(':');
                    
                    // Convert to 12-hour format with AM/PM
                    var period = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12 || 12; // Convert 0 to 12 for midnight
                    var formattedTime = `${hours}:${minutes} ${period}`; // 05:05 AM
    
                    return `${formattedDate} · ${formattedTime} ${weekday}`;
                }
            },
            { "data": "soldticket" },
            { "data": "price" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return `<a href="/organizer/edit-event/${row.eid}" title="Edit" class="edit-btn" data-id="${row.eid}" style="color: blue;"><i class="fa fa-edit" style="font-size: 18px;"></i></a>
                            <a href="/organizer/add-ticketing/${row.eid}" title="Add Ticketing" class="ticketing-btn" data-id="${row.eid}" style="color: green;"><i class="fa fa-ticket" style="font-size: 18px;"></i></a>
                            <a href="#" title="Delete" class="delete-btn" data-id="${row.eid}" style="color: red;"><i class="fa fa-trash" style="font-size: 18px;"></i></a>`;
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
