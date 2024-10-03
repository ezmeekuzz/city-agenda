<?=$this->include('templates/header');?>
<section class="container-fluid inner-page contact-banner">
    <div class="container">
        <div class="contact-content">
            <div class="contact-form-col">
                <h2>Drop Us a Line</h2>
                <p>We would love to hear from you.<br>
                    Please contact us at hello@CityAgenda or fill in the form below.</p>
                <form id="sendMessage">
                    <input type="text" name="fullname" id="fullname" placeholder="Your Name" required>
                    <input type="email" name="email" id="email" placeholder="Your Email" required>
                    <textarea name="message" id="message" placeholder="Write Your Message" rows="6" required></textarea>
                    <div class="submitBottom">
                        <input type="submit" class="main-btn contact-submit" value="Send Message">
                    </div>
                </form>
            </div>
            <div class="contact-img-sec">
                <img src="img/contact_img.webp" alt="Contact Image">
            </div>
        </div>
    </div>
</section>
<section class="container-fluid contact-section">
    <div class="container">
        <div class="row flex-lg-row flex-column-reverse">
            <div class="col-lg-6 col-md-12 contact-sec-col">
                <img src="img/contact_img1.webp" alt="Contact Information Image">
            </div>
            <div class="col-lg-6 col-md-12 p-lg-5 p-md-2 d-flex flex-column gap-2 justify-content-center">
                <h3>Contact Information</h3>
                <p>Your support options. It looks like you attend events. For help, you can find answers to common issues on this page. Email support is available for some issues.</p>
                <p>Please find our return address as below:</p>
                <h6>Rijswijkseweg 340<br>37, The Hague,<br>Netherlands</h6>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid inner-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <h2>Common Issues And Questions</h2>
            </div>
            <div class="col-lg-8 col-md-12 mt-lg-0 mt-md-3">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                How Do I Get Started Selling Tickets Online For Free?
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Can I Offer Discounts Or Promo Codes On Event Tickets?
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                How Do I Create Multiple Ticket Types  City Agenda?
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                Can I Sell Tickets Online For A Charity Event On City Agenda?
                            </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the fourth item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                How Do I Use City Agenda?
                            </button>
                        </h2>
                        <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the fifth item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?=$this->include('templates/footer');?>
<script>
    $(document).ready(function() {
        $('#sendMessage').on('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting the traditional way

            // Show the loading spinner
            Swal.fire({
                title: 'Sending...',
                text: 'Please wait while we process your message.',
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: false, // Prevent closing the Swal while loading
                showConfirmButton: false // Hide the confirm button
            });

            // Gather the form data
            var formData = $(this).serialize();

            // Perform AJAX request
            $.ajax({
                url: '/contactus/send',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Message Sent',
                            text: response.message,
                            showConfirmButton: true,
                        });
                        $('#sendMessage')[0].reset(); // Clear the form fields
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            showConfirmButton: true,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error sending your message. Please try again later.',
                        showConfirmButton: true,
                    });
                }
            });
        });
    });
</script>