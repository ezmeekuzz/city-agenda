<?=$this->include('templates/header');?>
<style>
.form-control {
    height: 50px !important;
}
</style>
<section class="container-fluid ticket-section">
    <div class="container d-flex flex-column gap-5">
        <div class="progress-container">
            <div class="progress-step active mobile">
                <p>Build Event Page</p>
                <div class="circle">1</div>
                <div class="line"></div>
            </div>
            <div class="progress-step active">
                <p>Add Tickets</p>
                <div class="circle">2</div>
                <div class="line"></div>
            </div>
            <div class="progress-step mobile">
                <p>Publish</p>
                <div class="circle">3</div>
            </div>
        </div>

        <div class="ticket-option-sec">
            <h3>Create Tickets</h3>
            <p>Choose A Ticket Type Or Build A Section With Multiple Ticket Types.</p>

            <div class="ticket-option-items">
                <div class="tick-opt-item" type="button" data-ticket-type="Paid">
                    <img class="img-option" src="/img/paidImg.png">
                    <div class="option-details">
                        <h4>Paid</h4>
                        <p>Create A Ticket That People Have To Pay For.</p>
                    </div>
                    <i class="bi bi-arrow-right-short"></i>
                </div>
                <div class="tick-opt-item" type="button" data-ticket-type="Free">
                    <img class="img-option" src="/img/freeImg.png">
                    <div class="option-details">
                        <h4>Free</h4>
                        <p>Create A Ticket That No One Has To Pay For.</p>
                    </div>
                    <i class="bi bi-arrow-right-short"></i>
                </div>
                <div class="tick-opt-item" type="button" data-ticket-type="Donations">
                    <img class="img-option" src="/img/danationImg.png">
                    <div class="option-details">
                        <h4>Donation</h4>
                        <p>Let People Pay Any Amount For Their Ticket.</p>
                    </div>
                    <i class="bi bi-arrow-right-short"></i>
                </div>
                <div class="tick-opt-item" type="button" data-ticket-type="No Ticket">
                    <img class="img-option" src="/img/no-ticketImg.png">
                    <div class="option-details">
                        <h4>No Tickets</h4>
                        <p>No Need To Pay For A Ticket.</p>
                    </div>
                    <i class="bi bi-arrow-right-short"></i>
                </div>
            </div>

            <!-- Static Modal with Dynamic Fields -->
            <div class="modal fade" id="paidModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content ticket-modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Ticket</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="ticketForm">
                                <!-- Static hidden fields -->
                                <input type="hidden" class="form-control" id="event_id" name="event_id" value="<?=$event_id;?>">
                                <input type="hidden" class="form-control" id="tickettype" name="tickettype">
                                
                                <!-- Dynamic fields will be inserted here -->
                                <div id="dynamicFields"></div>
                                <div class="formSubmit">
                                    <button class="main-btn formSubmit-btn-cancel" data-bs-dismiss="modal">Cancel<i class="bi bi-arrow-up-right"></i></button>
                                    <button type="button" class="main-btn formSubmit-btn-submit btn-primary" id="save_continue">Save & Continue<i class="bi bi-arrow-up-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?=$this->include('templates/footer');?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const modalButtons = document.querySelectorAll('.tick-opt-item');
    const ticketTypeInput = document.getElementById('tickettype');
    const dynamicFields = document.getElementById('dynamicFields');

    modalButtons.forEach(button => {
        button.addEventListener('click', function () {
            const ticketType = this.getAttribute('data-ticket-type');
            
            // Set the ticket type input field
            ticketTypeInput.value = ticketType;

            // Clear any existing dynamic fields
            dynamicFields.innerHTML = '';

            // Create input fields based on ticket type
            switch (ticketType) {
                case 'Paid':
                    createPaidFields(dynamicFields);
                    break;
                case 'Free':
                    createFreeFields(dynamicFields);
                    break;
                case 'Donations':
                    createDonationsFields(dynamicFields);
                    break;
                case 'No Ticket':
                    createNoTicketsMessage(dynamicFields);
                    break;
            }

            // Show the modal
            const ticketModal = new bootstrap.Modal(document.getElementById('paidModal'));
            ticketModal.show();
        });
    });

    function createPaidFields(container) {
        container.innerHTML = `
            <div class="mb-3">
                <label for="ticketname" class="form-label">Ticket Name</label>
                <input type="text" class="form-control" id="ticketname" name="ticketname" placeholder="Enter Ticket Name">
            </div>
            <div class="mb-3">
                <label for="ticketdescription" class="form-label">Ticket Description</label>
                <textarea class="form-control" id="ticketdescription" name="ticketdescription" rows="3" placeholder="Enter Ticket Description"></textarea>
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
        `;
    }

    function createFreeFields(container) {
        container.innerHTML = `
            <div class="mb-3">
                <label for="ticketname" class="form-label">Ticket Name</label>
                <input type="text" class="form-control" id="ticketname" name="ticketname" placeholder="Enter Ticket Name">
            </div>
            <div class="mb-3">
                <label for="ticketdescription" class="form-label">Ticket Description</label>
                <textarea class="form-control" id="ticketdescription" name="ticketdescription" rows="3" placeholder="Enter Ticket Description"></textarea>
            </div>
            <div class="mb-3">
                <label for="availablequantity" class="form-label">Available Quantity</label>
                <input type="number" class="form-control" id="availablequantity" name="availablequantity" min="1" placeholder="Enter Quantity">
            </div>
        `;
    }

    function createDonationsFields(container) {
        container.innerHTML = `
            <div class="mb-3">
                <label for="ticketname" class="form-label">Ticket Name</label>
                <input type="text" class="form-control" id="ticketname" name="ticketname" placeholder="Enter Ticket Name">
            </div>
            <div class="mb-3">
                <label for="ticketdescription" class="form-label">Ticket Description</label>
                <textarea class="form-control" id="ticketdescription" name="ticketdescription" rows="3" placeholder="Enter Ticket Description"></textarea>
            </div>
            <div class="mb-3">
                <label for="availablequantity" class="form-label">Available Quantity</label>
                <input type="number" class="form-control" id="availablequantity" name="availablequantity" min="1" placeholder="Enter Quantity">
            </div>
        `;
    }

    function createNoTicketsMessage(container) {
        container.innerHTML = `<p>No tickets are required for this event.</p>`;
    }

    document.getElementById('save_continue').addEventListener('click', function () {
        const ticketForm = document.getElementById('ticketForm');

        Swal.fire({
            title: 'Processing...',
            text: 'Please wait while we submit your request.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });

        const formData = new FormData(ticketForm);

        // AJAX request to submit form
        fetch('/organizer/addticketing/insert', {
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
                    window.location.href = "/organizer/publish-event/" + <?=$event_id;?>
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
</script>

