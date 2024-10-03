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
            "url": "/admin/eventmasterlist/getData",
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
                    return `<a href="/admin/edit-event/${row.eid}" title="Edit" class="edit-btn" data-id="${row.eid}" style="color: blue;"><i class="fa fa-edit" style="font-size: 18px;"></i></a>
                            <a href="/admin/add-ticketing/${row.eid}" title="Add Ticketing" class="ticketing-btn" data-id="${row.eid}" style="color: green;"><i class="fa fa-ticket" style="font-size: 18px;"></i></a>
                            <a href="#" title="Delete" class="delete-btn" data-id="${row.eid}" style="color: red;"><i class="fa fa-trash" style="font-size: 18px;"></i></a>`;
                }
            }
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data.eid);
        },
        "initComplete": function (settings, json) {
            $(this).trigger('dt-init-complete');
        }
    });

    $(document).on('click', '.event-id-link', function (e) {
        e.preventDefault();
        var eventId = $(this).data('id');
        
        // Clear the modal content before the new data loads
        $('#eventModal #attendees').html('Loading attendees...');
        $.fn.modal.Constructor.prototype._enforceFocus = function() {};
        // Make an AJAX request to fetch the attendees list
        $.ajax({
            url: '/admin/eventmasterlist/getAttendees/' + eventId, // Your endpoint to fetch attendees
            type: 'GET',
            success: function (response) {
                // Assuming `response` contains the list of attendees
                if (response.status === 'success' && response.data) {
                    var attendeesList = response.data;
                    
                    // Build the table structure for attendees
                    var html = `<h5>Event ID: CA${eventId.toString().padStart(5, '0')}</h5>`;
                    html += '<table class="table table-striped">';
                    html += '<thead><tr><th>Name</th><th>Email</th><th>Phone Number</th><th>Quantity</th><th>Amount Paid</th><th>Ticket ID</th></tr></thead>';
                    html += '<tbody>';
                    
                    // Loop through the list of attendees and populate the table rows
                    if (attendeesList.length > 0) {
                        // Loop through the list of attendees and populate the table rows
                        attendeesList.forEach(function (attendee) {
                            var formattedTicketId = 'TD' + attendee.payment_id.toString().padStart(6, '0');
                            html += `<tr>
                                        <td>${attendee.firstname} ${attendee.lastname}</td>
                                        <td>${attendee.emailaddress}</td>
                                        <td>${attendee.phonenumber}</td>
                                        <td>${attendee.quantity}</td>
                                        <td>${attendee.total_amount}</td>
                                        <td>${formattedTicketId}</td>
                                     </tr>`;
                        });
                    } else {
                        // If no attendees found, show a message in a single table cell
                        html += '<tr><td colspan="6" class="text-center">No attendees found for this event.</td></tr>';
                    }
                    
                    html += '</tbody></table>';
                    html += `
                        <div class="modal-footer">
                            <button id="downloadBtn" class="btn btn-primary" data-event-id="${eventId}">Download</button>
                            <button id="shareBtn" class="btn btn-secondary" data-event-id="${eventId}">Share via Email</button>
                        </div>
                    `;
                    // Insert the HTML into the modal
                    $('#eventModal #attendees').html(html);
                } else {
                    // If no attendees found or an error occurred
                    $('#eventModal #attendees').html('No attendees found for this event.');
                }
            },
            error: function () {
                // Handle the AJAX request error
                $('#eventModal #attendees').html('Error loading attendees. Please try again later.');
            }
        });
        
        // Show the modal
        $('#eventModal').modal('show');
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
                    url: '/admin/eventmasterlist/delete/' + id,
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
    $(document).on('click', '#downloadBtn', function() {
        var eventId = $(this).data('event-id'); // Ensure you pass the event ID if needed
        window.location.href = '/admin/eventmasterlist/downloadAttendees/' + eventId;
    });
    $(document).ready(function () {
        // Other event handling logic for your DataTable
    
        // Handling the "Share via Email" action
        $(document).on('click', '#shareBtn', function() {
            var eventId = $(this).data('event-id');
    
            // Show a SweetAlert2 prompt to ask for the email address
            Swal.fire({
                title: 'Enter Email Address',
                input: 'email',  // Input type set to 'email'
                inputLabel: 'Email Address',
                inputPlaceholder: 'Enter recipient\'s email address',
                showCancelButton: true,
                confirmButtonText: 'Send Email',
                cancelButtonText: 'Cancel',
                inputAttributes: {
                    autocapitalize: 'off',  // Ensure autocapitalize is off
                },
                didOpen: () => {
                    // Force focus on the email input field
                    const input = Swal.getInput();
                    if (input) {
                        input.focus();
                    }
                },
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to enter an email address!';
                    }
                    if (!validateEmail(value)) {
                        return 'Please enter a valid email address!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    var email = result.value;
    
                    // Show SweetAlert2 loading indicator
                    Swal.fire({
                        title: 'Sending Email...',
                        html: 'Please wait while we send the email.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
    
                    // Send email with the entered address using AJAX
                    $.ajax({
                        url: '/admin/eventmasterlist/shareAttendees/' + eventId,
                        type: 'POST',
                        data: { email: email }, // Sending email as data
                        success: function(response) {
                            Swal.close(); // Close the loading indicator
                            if (response.status === 'success') {
                                Swal.fire('Success!', response.message, 'success');
                            } else {
                                Swal.fire('Error!', 'Error: ' + response.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.close(); // Close the loading indicator
                            Swal.fire('Failed!', 'Failed to send the email. Please try again.', 'error');
                        }
                    });
                }
            });
        });
    
        // Helper function to validate email format
        function validateEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(String(email).toLowerCase());
        }
    });
});
