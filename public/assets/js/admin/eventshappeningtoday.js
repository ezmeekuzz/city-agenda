$(document).ready(function () {
    function formatEventId(eventId) {
        // Ensure eventId is a number or a string that can be converted to a number
        eventId = parseInt(eventId, 10);
        
        // Format the ID with a "CA" prefix and zero-padded to 5 digits
        return `<a href="#" class="event-id-link" data-id="${eventId}">CA${eventId.toString().padStart(5, '0')}</a>`;
    }
    var table = $('#eventshappeningtoday').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/admin/eventshappeningtoday/getData",
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
                "data": "event_id",
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
            { "data": "eventtype" },
            { "data": "eventdate" },
            { "data": "eventstartingtime" },
            { "data": "eventendingtime" },
            { "data": "recurrence" },
            { "data": "locationname" },
            { "data": "state_name" },
            { "data": "cityname" },
            { "data": "publishstatus" },
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data.event_id);
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
