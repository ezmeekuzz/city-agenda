$(document).ready(function () {
    var table = $('#ticketmasterlist').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/admin/ticketmasterlist/getData",
            "type": "GET"
        },
        "columns": [
            { "data": "eventname" },
            { "data": "ticketname" },
            { "data": "tickettype" },
            { "data": "ticketdescription" },
            { "data": "availablequantity" },
            { "data": "soldticket" },
            { "data": "price" },
            { "data": "salesstart" },
            { "data": "salesend" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return `<a href="#" title="Edit" class="open-modal-btn" data-ticket-type="${row.tickettype}" data-event-id="${row.event_id}" data-id="${row.ticket_id}" style="color: blue;"><i class="fa fa-edit" style="font-size: 18px;"></i></a>
                            <a href="#" title="Delete" class="delete-btn" data-id="${row.ticket_id}" style="color: red;"><i class="fa fa-trash" style="font-size: 18px;"></i></a>`;
                }
            }
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data.ticket_id);
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
                    url: '/admin/ticketmasterlist/delete/' + id,
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

    $(document).on('click', '.open-modal-btn', function () {
        const ticketType = $(this).data('ticket-type');
        const row = table.row($(this).closest('tr')).data(); // Get the data for the clicked row
        const event_id = row.event_id;
        const ticket_id = row.ticket_id;

        const modalBody = document.querySelector('.modal-body');
        modalBody.innerHTML = '';

        // Populate form based on ticket type
        switch (ticketType) {
            case 'Paid':
                createPaidFields(modalBody, event_id, ticket_id);
                break;
            case 'Free':
                createFreeFields(modalBody, event_id, ticket_id);
                break;
            case 'Donations':
                createDonationsFields(modalBody, event_id, ticket_id);
                break;
            case 'No Ticket':
                createNoTicketsMessage(modalBody, event_id);
                break;
        }

        // Populate the form fields with row data
        $('#ticketname').val(row.ticketname);
        $('#ticketDescription').val(row.ticketdescription);
        $('#availablequantity').val(row.availablequantity);
        $('#price').val(row.price);
        $('#salesstart').val(row.salesstart);
        $('#salesend').val(row.salesend);

        const ticketModal = new bootstrap.Modal(document.getElementById('ticketModal'));
        ticketModal.show();
    });

    function createPaidFields(modalBody, event_id, ticket_id) {
        const paidFields = `
            <form id="ticketForm">
                <div class="mb-3" hidden>
                    <label for="ticket_id" class="form-label">Ticket ID</label>
                    <input type="text" class="form-control" id="ticket_id" name="ticket_id" value="${ticket_id}" placeholder="Enter Ticket ID">
                </div>
                <div class="mb-3" hidden>
                    <label for="event_id" class="form-label">Event ID</label>
                    <input type="text" class="form-control" id="event_id" name="event_id" value="${event_id}" placeholder="Enter Event ID">
                </div>
                <div class="mb-3" hidden>
                    <label for="tickettype" class="form-label">Ticket Type</label>
                    <input type="text" class="form-control" id="tickettype" name="tickettype" value="Paid" placeholder="Enter Ticket Type">
                </div>
                <div class="mb-3">
                    <label for="ticketname" class="form-label">Ticket Name</label>
                    <input type="text" class="form-control" id="ticketname" name="ticketname" placeholder="Enter Ticket Name">
                </div>
                <div class="mb-3">
                    <label for="ticketDescription" class="form-label">Ticket Description</label>
                    <textarea class="form-control" id="ticketDescription" name="ticketdescription" rows="3" placeholder="Enter Ticket Description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="availablequantity" class="form-label">Available Quantity</label>
                    <input type="number" class="form-control" id="availablequantity" name="availablequantity" min="1" placeholder="Enter Quantity">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="0.00">
                </div>
                <div class="mb-3">
                    <label for="salesstart" class="form-label">Sales Start</label>
                    <input type="datetime-local" class="form-control" id="salesstart" name="salesstart">
                </div>
                <div class="mb-3">
                    <label for="salesend" class="form-label">Sales End</label>
                    <input type="datetime-local" class="form-control" id="salesend" name="salesend">
                </div>
            </form>
        `;
        modalBody.innerHTML = paidFields;
    }

    function createFreeFields(modalBody, event_id, ticket_id) {
        const freeFields = `
            <form id="ticketForm">
                <div class="mb-3" hidden>
                    <label for="ticket_id" class="form-label">Ticket ID</label>
                    <input type="text" class="form-control" id="ticket_id" name="ticket_id" value="${ticket_id}" placeholder="Enter Ticket ID">
                </div>
                <div class="mb-3" hidden>
                    <label for="event_id" class="form-label">Event ID</label>
                    <input type="text" class="form-control" id="event_id" name="event_id" value="${event_id}" placeholder="Enter Event ID">
                </div>
                <div class="mb-3" hidden>
                    <label for="tickettype" class="form-label">Ticket Type</label>
                    <input type="text" class="form-control" id="tickettype" name="tickettype" value="Free" placeholder="Enter Ticket Type">
                </div>
                <div class="mb-3">
                    <label for="ticketname" class="form-label">Ticket Name</label>
                    <input type="text" class="form-control" id="ticketname" name="ticketname" placeholder="Enter Ticket Name">
                </div>
                <div class="mb-3">
                    <label for="ticketDescription" class="form-label">Ticket Description</label>
                    <textarea class="form-control" id="ticketDescription" name="ticketdescription" rows="3" placeholder="Enter Ticket Description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="availablequantity" class="form-label">Available Quantity</label>
                    <input type="number" class="form-control" id="availablequantity" name="availablequantity" min="1" placeholder="Enter Quantity">
                </div>
            </form>
        `;
        modalBody.innerHTML = freeFields;
    }

    function createDonationsFields(modalBody, event_id, ticket_id) {
        const donationsFields = `
            <form id="ticketForm">
                <div class="mb-3" hidden>
                    <label for="ticket_id" class="form-label">Ticket ID</label>
                    <input type="text" class="form-control" id="ticket_id" name="ticket_id" value="${ticket_id}" placeholder="Enter Ticket ID">
                </div>
                <div class="mb-3" hidden>
                    <label for="event_id" class="form-label">Event ID</label>
                    <input type="text" class="form-control" id="event_id" name="event_id" value="${event_id}" placeholder="Enter Event ID">
                </div>
                <div class="mb-3" hidden>
                    <label for="tickettype" class="form-label">Ticket Type</label>
                    <input type="text" class="form-control" id="tickettype" name="tickettype" value="Donations" placeholder="Enter Ticket Type">
                </div>
                <div class="mb-3">
                    <label for="ticketname" class="form-label">Ticket Name</label>
                    <input type="text" class="form-control" id="ticketname" name="ticketname" placeholder="Enter Ticket Name">
                </div>
                <div class="mb-3">
                    <label for="ticketDescription" class="form-label">Ticket Description</label>
                    <textarea class="form-control" id="ticketDescription" name="ticketdescription" rows="3" placeholder="Enter Ticket Description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="availablequantity" class="form-label">Available Quantity</label>
                    <input type="number" class="form-control" id="availablequantity" name="availablequantity" min="1" placeholder="Enter Quantity">
                </div>
            </form>
        `;
        modalBody.innerHTML = donationsFields;
    }

    function createNoTicketsMessage(modalBody, event_id) {
        const noTicketsMessage = `
            <div class="mb-3" hidden>
                <label for="event_id" class="form-label">Event ID</label>
                <input type="text" class="form-control" id="event_id" name="event_id" value="${event_id}" placeholder="Enter Event ID">
            </div>
            <p class="text-danger">No tickets available for this event.</p>
        `;
        modalBody.innerHTML = noTicketsMessage;

        // Add event listener for Save & Continue button
        document.getElementById('submitTicketForm').addEventListener('click', function() {
            const eventId = document.getElementById('event_id').value;
            window.location.href = `/admin/publish-event/${eventId}`;
        });
    }
    $(document).on('click', '#submitTicketForm', function () {
        var ticketType = $('#tickettype').val(); // Get the ticket type from the form
        var isValid = true; // Variable to track form validity
    
        // Validate fields based on ticket type
        if (ticketType === 'Paid') {
            if (!$('#ticketname').val()) {
                isValid = false;
                $('#ticketname').addClass('is-invalid');
            } else {
                $('#ticketname').removeClass('is-invalid');
            }
    
            if (!$('#ticketDescription').val()) {
                isValid = false;
                $('#ticketDescription').addClass('is-invalid');
            } else {
                $('#ticketDescription').removeClass('is-invalid');
            }
    
            if (!$('#availablequantity').val()) {
                isValid = false;
                $('#availablequantity').addClass('is-invalid');
            } else {
                $('#availablequantity').removeClass('is-invalid');
            }
    
            if (!$('#price').val() || $('#price').val() <= 0) {
                isValid = false;
                $('#price').addClass('is-invalid');
            } else {
                $('#price').removeClass('is-invalid');
            }
    
            if (!$('#salesstart').val()) {
                isValid = false;
                $('#salesstart').addClass('is-invalid');
            } else {
                $('#salesstart').removeClass('is-invalid');
            }
    
            if (!$('#salesend').val()) {
                isValid = false;
                $('#salesend').addClass('is-invalid');
            } else {
                $('#salesend').removeClass('is-invalid');
            }
    
        } else if (ticketType === 'Free' || ticketType === 'Donations') {
            if (!$('#ticketname').val()) {
                isValid = false;
                $('#ticketname').addClass('is-invalid');
            } else {
                $('#ticketname').removeClass('is-invalid');
            }
    
            if (!$('#ticketDescription').val()) {
                isValid = false;
                $('#ticketDescription').addClass('is-invalid');
            } else {
                $('#ticketDescription').removeClass('is-invalid');
            }
    
            if (!$('#availablequantity').val()) {
                isValid = false;
                $('#availablequantity').addClass('is-invalid');
            } else {
                $('#availablequantity').removeClass('is-invalid');
            }
        }
    
        // If form is valid, submit the data via AJAX
        if (isValid) {
            var formData = $('#ticketForm').serialize(); // Gather form data
    
            $.ajax({
                url: '/admin/ticketmasterlist/update',  // Update the URL to the correct route for handling updates
                method: 'POST',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: 'Ticket details updated successfully.',
                        }).then(() => {
                            $('#ticketModal').modal('hide'); // Close modal
                            $('#ticketmasterlist').DataTable().ajax.reload(); // Reload table data
                            window.location.href = "/admin/publish-event/" + $('#event_id').val()
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Something went wrong while updating the ticket.',
                        });
                    }
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while processing the request.',
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Submission',
                text: 'Please fill out all required fields.',
            });
        }
    });
});
