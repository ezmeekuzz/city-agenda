<footer class="container-fluid footer-section">
    <section class="container">
        <div class="row top-footer">
            <div class="col-lg-3 col-md-4 col-sm-12 mb-3">
                <h4>Plan Events</h4>
                <ul>
                    <li><a href="<?=base_url();?>login">Publish Your Events</a></li>
                    <li><a href="#">Promote Your Events</a></li>
                    <li><a href="#">Sell Tickets Online</a></li>
                    <li><a href="#">Host Recorded Events</a></li>
                    <li><a href="#">Pricing Plans</a></li>
                    <li><a href="#">Event Manager App</a></li>
                    <li><a href="#">Rank Your Event</a></li>
                    <li><a href="#">Event Listing</a></li>
                    <li><a href="#">Learn Event Marketing</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 mb-3">
                <h4>Find Events</h4>
                <ul>
                    <li><a href="#">Events for You</a></li>
                    <li><a href="#">Virtual Events</a></li>
                    <li><a href="#">Get Event Updates</a></li>
                    <li><a href="#">Event Discovery App</a></li>
                    <li><a href="#">Write for Us</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-12 mb-3">
                <h4>Connect With Us</h4>
                <ul>
                    <li><a href="<?=base_url();?>contact-us">Contact Support</a></li>
                    <li><a href="#">Contact Sales</a></li>
                    <li><a href="#">X</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">LinkedIn</a></li>
                    <li><a href="#">Instagram</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-12 mb-3 d-flex flex-column align-items-center newsletter-col">
                <h2>Subscribe To Our Newsletter</h2>
                <form class="newsletter-form w-100 d-flex" id="subscribe">
                    <input type="email" name="emailaddress" id="emailaddress" class="form-control" placeholder="Email Here">
                    <button class="btn btn-transparent" type="submit">
                        <i class="bi bi-arrow-right-short"></i>
                    </button>
                </form>
                <ul class="mt-3">
                    <li><a href="<?=base_url();?>privacy-policy">Privacy Policy</a></li>
                    <li><a href="<?=base_url();?>terms-of-use">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="row bottom-footer">
            <div class="col-lg-3 col-md-12 mb-3 footer-logo d-flex justify-content-center">
                <img src="<?=base_url();?>img/footerLogo.png" alt="Footer Logo">
            </div>
            <div class="col-lg-6 col-md-12 mb-3 d-flex justify-content-center align-items-center">
                <p class="text-center creds">© 2024 City Agenda. All Rights Reserved.</p>
            </div>
            <div class="col-lg-3 col-md-12 mb-3 d-flex flex-column align-items-center justify-content-center footer-social">
                <h4>Follow Us</h4>
                <div class="social-icons d-flex gap-3">
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </section>
</footer>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="<?=base_url();?>js/js.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#subscribe').on('submit', function(e) {
            e.preventDefault();

            var emailaddress = $('#emailaddress').val();

            if (!emailaddress || !validateEmail(emailaddress)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email!',
                    text: 'Please enter a valid email address.',
                    timer: 2000,
                    showConfirmButton: false
                });
                return;
            }

            function validateEmail(email) {
                var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Show loading effect before sending the AJAX request
            Swal.fire({
                title: 'Processing...',
                text: 'Please wait while we subscribe you to our newsletter.',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading(); // Show loading indicator
                }
            });

            $.ajax({
                url: '/subscribe', // Backend URL
                type: 'POST',
                data: { emailaddress: emailaddress },
                success: function(response) {
                    $('#subscribe')[0].reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Subscribed!',
                        text: response.message, // Display only the message from the response
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    let response = JSON.parse(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.message, // Display only the message from the response
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        });
    });
</script>

</body>
</html>
