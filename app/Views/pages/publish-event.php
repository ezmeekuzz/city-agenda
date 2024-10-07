<?=$this->include('templates/header');?>
<section class="container-fluid inner-page progress-header">
        <div class="container mb-0 mb-lg-5">
            <div class="progress-container">
                <div class="progress-step active mobile">
                    <p>Build Event Page</p>
                    <div class="circle">1</div>
                    <div class="line"></div>
                </div>
                <div class="progress-step active mobile">
                    <p>Add Tickets</p>
                    <div class="circle">2</div>
                    <div class="line"></div>
                </div>
                <div class="progress-step active">
                    <p>Publish</p>
                    <div class="circle">3</div>
                </div>
            </div>
        </div>
    </section>



    <section class="container-fluid publish-form">
        <div class="container">
            <form class="ticket-publish" id="publishEvent">
                <h2>Your Event Is Almost Ready To Publish</h2>
                <h5>Review Your Settings And Let Everyone Find Your Event.</h5>
                <div class="ticket-card-sec">
                    <img src="/<?=$eventDetails['eventbanner'];?>">
                    <div class="ticket-details">
                        <h3><?=$eventDetails['eventname'];?></h3>
                        <h6>
                                        <?= date('l, F j', strtotime($eventDetails['eventdate'])); ?> · 
                                        <?= date('gA', strtotime($eventDetails['eventstartingtime'])); ?> - 
                                        <?= date('gA', strtotime($eventDetails['eventendingtime'])); ?> EDT</h6>
                        <p><?=$eventDetails['locationname'];?>, <?=$eventDetails['city'];?>, <?=$eventDetails['state'];?></p>
                        <ul class="ticket-price">
                            <li>
                                <img src="/img/ticketImg.png">
                                <p>$<?=$eventDetails['price'];?></p>
                            </li>
                            <li>
                                <img src="/img/user.png">
                                <p><?=$eventDetails['availablequantity'];?></p>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="publish-settings">
                    <h3>Publish Settings</h3>
                    <input type="hidden" name="event_id" id="event_id" value="<?=$eventDetails['event_id'];?>">
                    <h4>Is Your Event Public Or Private?</h4>
                    <label>
                        <input type="radio" id="public" name="event_visibility" value="Public" checked>
                        <div class="checkbox-label">
                            <h6>Public</h6>
                            <p>Public Your Event Will Appear In The Search <br>
                                Engine And Other Pages</p>
                        </div>
                    </label>
                    <label>
                        <input type="radio" id="private" name="event_visibility" value="Private">
                        <div class="checkbox-label">
                            <h6>Private</h6>
                            <p>Private Your Event Will Not Appear In The Search Engine<br>
                            Only People With The Link Can Review Your Event.</p>
                        </div>
                    </label>
                    <h4>Refund Policy </h4>

                    <label>
                        <input type="radio" id="no_refund" name="refund_policy" value="Do Not Allow Refund." checked>
                        <div class="checkbox-label">
                            <p><b>Do Not Allow Refund.</b></p>
                        </div>
                    </label>
                    <label>
                        <input type="radio" id="refund_24_hours" name="refund_policy" value="Allow Refund If Attendee Cancels 24 Hours Before The Event Starts.">
                        <div class="checkbox-label">
                            <p><b>Allow Refund If Attendee Cancel 24 Hours Before The Event Start</b></p>
                        </div>
                    </label>
                    <label>
                        <input type="radio" id="refund_7_days" name="refund_policy" value="Allow Refund If Attendee Cancels 7 Days Before The Event Starts.">
                        <div class="checkbox-label">
                            <p><b>Allow Refund If Attendee Cancel 7 Days Before The Event Start</b></p>
                        </div>
                    </label>
                    <p class="note-text">Please Notice If You Cancel Your Event Regardless Of The Reasons All Attendees Who Bought Tickets Will Be Refunded. </p>
                    <hr>
                </div>
                <div class="create-submit-btn">
                    <i class="bi bi-arrow-up-right submit-btn-arrow"></i>
                    <input class="main-btn" type="submit" value="Publish">
                </div>
            </form>
        </div>
    </section>

<?=$this->include('templates/footer');?>
<script>
$('#publishEvent').on('submit', function(event) {
    event.preventDefault(); // Prevent form from submitting the default way

    // Show loading effect using SweetAlert2
    Swal.fire({
        title: 'Publishing Event...',
        text: 'Please wait while we process your request.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading(); // Show loading spinner
        }
    });

    // Prepare form data for submission
    var formData = $(this).serialize();

    // AJAX call to submit the form data
    $.ajax({
        url: '/organizer/publishevent/update', // Your server-side form handler
        method: 'POST',
        data: formData,
        success: function(response) {
            Swal.close(); // Close the loading effect

            // Check if the response indicates success
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Event Published!',
                    text: 'Your event has been successfully published.',
                    confirmButtonText: 'OK'
                }).then(function() {
                    // Optionally, redirect after success
                    window.location.href = '/organizer/event-masterlist'; // Redirect to the events page
                });
            } else {
                // Handle case where the server responds with an error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Something went wrong while publishing the event. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.close(); // Close the loading effect

            // Show error alert if AJAX fails
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while processing your request. Please try again later.',
                confirmButtonText: 'OK'
            });
        }
    });
});
</script>