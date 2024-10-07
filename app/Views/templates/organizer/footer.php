
            <footer class="footer">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-left">
                        <p>&copy; Copyright <?=date('Y');?>. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?=base_url();?>assets/js/vendors.js"></script>
    <script src="<?=base_url();?>assets/js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="<?=base_url();?>assets/js/Toolbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input@1.3.4/dist/bs-custom-file-input.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
        $(".chosen-select").chosen({ 
            maxHeight: "400px" 
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#deactivateAccountBtn').on('click', function(e) {
                e.preventDefault();

                // Show SweetAlert2 confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action will deactivate your account and you won't be able to access it.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, deactivate it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform AJAX request to update the account status
                        $.ajax({
                            url: '/organizer/deactivate-account',  // The URL where the backend logic for deactivation is handled
                            type: 'POST',
                            data: { 
                                user_id: <?=session()->get('organizer_user_id');?>  // Passing the user ID
                            },
                            success: function(response) {
                                // Check the response from the server
                                if(response.success) {
                                    Swal.fire(
                                        'Deactivated!',
                                        'Your account has been deactivated.',
                                        'success'
                                    ).then(() => {
                                        // Optional: redirect to the login page or another page
                                        window.location.href = "<?=base_url()?>organizer/logout";
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'There was an error deactivating your account. Please try again.',
                                        'error'
                                    );
                                }
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'Failed to send the request. Please try again.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
            $('#2faToggle').on('change', function() {
                // Get the current state of the checkbox
                let twoFactorEnabled = $(this).is(':checked') ? 1 : 0;

                // Send the AJAX request to update the 2FA status
                $.ajax({
                    url: '/organizer/update-2fa',  // Adjust the URL to match your controller method
                    method: 'POST',
                    data: {
                        two_factor_enabled: twoFactorEnabled
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // To make sure it's an AJAX request
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                timer: 2000
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                                timer: 2000
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while updating 2FA status.',
                            timer: 2000
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>