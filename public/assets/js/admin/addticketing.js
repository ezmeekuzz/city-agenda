document.addEventListener("DOMContentLoaded", function () {
    const modalButtons = document.querySelectorAll('.open-modal-btn');
    const modalBody = document.querySelector('.modal-body');

    modalButtons.forEach(button => {
        button.addEventListener('click', function () {
            const ticketType = this.getAttribute('data-ticket-type');

            // Clear the modal content
            modalBody.innerHTML = '';

            // Create form fields based on ticket type
            switch (ticketType) {
                case 'Paid':
                    createPaidFields(modalBody);
                    break;
                case 'Free':
                    createFreeFields(modalBody);
                    break;
                case 'Donations':
                    createDonationsFields(modalBody);
                    break;
                case 'No Ticket':
                    createNoTicketsMessage(modalBody);
                    break;
            }

            // Show the modal using Bootstrap's Modal JavaScript API
            const ticketModal = new bootstrap.Modal(document.getElementById('ticketModal'));
            ticketModal.show();
        });
    });

    // Function to create "Paid" ticket fields
    function createPaidFields(modalBody) {
        const paidFields = `
            <form id="ticketForm">
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

    // Function to create "Free" ticket fields
    function createFreeFields(modalBody) {
        const freeFields = `
            <form id="ticketForm">
                <div class="mb-3" hidden>
                    <label for="event_id" class="form-label">Event ID</label>
                    <input type="text" class="form-control" id="event_id" name="event_id" value="${event_id}" placeholder="Enter Event ID">
                </div>
                <div class="mb-3" hidden>
                    <label for="tickettype" class="form-label">Ticket Type</label>
                    <input type="text" class="form-control" id="tickettype" name="tickettype" value="Free" placeholder="Enter Ticket Type">
                </div>
                <div class="mb-3">
                    <label for="ticketName" class="form-label">Ticket Name</label>
                    <input type="text" class="form-control" id="ticketName" name="ticketname" placeholder="Enter Ticket Name">
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
                    <label for="salesstart" class="form-label">Sales Start</label>
                    <input type="datetime-local" class="form-control" id="salesstart" name="salesstart">
                </div>
                <div class="mb-3">
                    <label for="salesend" class="form-label">Sales End</label>
                    <input type="datetime-local" class="form-control" id="salesend" name="salesend">
                </div>
            </form>
        `;
        modalBody.innerHTML = freeFields;
    }

    // Function to create "Donations" ticket fields
    function createDonationsFields(modalBody) {
        const donationFields = `
            <form id="ticketForm">
                <div class="mb-3" hidden>
                    <label for="event_id" class="form-label">Event ID</label>
                    <input type="text" class="form-control" id="event_id" name="event_id" value="${event_id}" placeholder="Enter Event ID">
                </div>
                <div class="mb-3" hidden>
                    <label for="tickettype" class="form-label">Ticket Type</label>
                    <input type="text" class="form-control" id="tickettype" name="tickettype" value="Donations" placeholder="Enter Ticket Type">
                </div>
                <div class="mb-3">
                    <label for="ticketName" class="form-label">Ticket Name</label>
                    <input type="text" class="form-control" id="ticketName" name="ticketname" placeholder="Enter Ticket Name">
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
                    <input type="number" class="form-control" id="price" name="price" value="0.00" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Absorb Fees:</label>
                    <label class="form-text">Ticketing Fees Are Deducted From Your Donation Amount</label>
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
        modalBody.innerHTML = donationFields;
    }

    // Function to create "No Tickets" message
    function createNoTicketsMessage(modalBody) {
        modalBody.innerHTML = '<h1>No Tickets</h1>';
    }

    // Handle form submission
    document.querySelector('.btn-primary').addEventListener('click', function (e) {
        e.preventDefault(); 
    
        const ticketForm = document.getElementById('ticketForm');
        const ticketType = document.getElementById('tickettype') ? document.getElementById('tickettype').value : '';
        let emptyFields = false;
    
        const inputs = ticketForm.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            if (input.value.trim() === '') { // Trim to avoid spaces
                emptyFields = true;
            }
        });
    
        if (emptyFields) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please fill in all fields.',
            });
            return;
        }
    
        // Show loading effect
        Swal.fire({
            title: 'Submitting...',
            html: 'Please wait while we process your request.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    
        const formData = new FormData(ticketForm);
    
        fetch('/admin/addticketing/insert', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                    timer: 2000
                }).then(() => {
                    // Hide the modal and reset the form
                    const ticketModal = new bootstrap.Modal(document.getElementById('ticketModal'));
                    ticketModal.hide();
                    // Manually clear the form fields
                    ticketForm.reset();
                    // Clear any additional fields if needed
                    const additionalFields = ticketForm.querySelectorAll('.form-control');
                    additionalFields.forEach(field => field.value = '');
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message,
                    timer: 2000
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to submit the form. Please try again later.',
                timer: 2000
            });
        });
    });    
});
