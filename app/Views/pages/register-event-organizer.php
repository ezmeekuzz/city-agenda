<?=$this->include('templates/header');?>
<div class="registration-container">
    <div class="container mt-5">
        <h2 class="text-center registration-title">Event Organizer Registration</h2>
        <p class="text-center mb-5 pb-5">Complete the form below and manage your incoming event</p>
        <form id="register">
            <div class="row mb-3">
                <!-- First Name -->
                <div class="col-md-6">
                    <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="firstName" name="firstname" placeholder="First Name" >
                </div>
                <!-- Last Name -->
                <div class="col-md-6">
                    <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Last Name" >
                </div>
            </div>

            <div class="row mb-3">
                <!-- E-Mail -->
                <div class="col-md-6">
                    <label for="email" class="form-label">E-Mail <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="emailaddress" placeholder="Email" >
                </div>
                <!-- Phone Number -->
                <div class="col-md-6">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                </div>
            </div>
            <br>
            <!-- Terms and Conditions Checkbox -->
            <div class="mb-5 mt-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="termsCheck">
                    <label class="form-check-label" for="termsCheck">
                        Terms and Conditions <span class="text-danger">*</span>
                    </label>
                </div>
                <p class="terms-text">
                    You consent to receive communications from us electronically. We will communicate with you by email or phone. 
                    You agree that all agreements, notices, disclosures, and other communications that we provide to you electronically 
                    satisfy any legal requirement that such communications be in writing.
                </p>
            </div>

            <div class="row mb-3">
                <!-- Submit Button on the Left Side -->
                <div class="col-md-6">
                    <button type="submit" class="btn btn-custom registration-button">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?=$this->include('templates/footer');?>
<script>
    $(document).ready(function () {
        // Handle form submission
        $('#register').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            // Gather form data
            let firstName = $('#firstName').val().trim();
            let lastName = $('#lastName').val().trim();
            let email = $('#email').val().trim();
            let password = $('#password').val().trim();
            let termsCheck = $('#termsCheck').is(':checked');

            // Validate form fields
            if (firstName === '' || lastName === '' || email === '' || password === '') {
                // Show error alert if any field is empty
                Swal.fire({
                    icon: 'error',
                    title: 'Missing Information',
                    text: 'All fields are required. Please fill in all the fields.',
                });
                return;
            }

            if (!termsCheck) {
                // Show error alert if terms and conditions are not accepted
                Swal.fire({
                    icon: 'error',
                    title: 'Terms and Conditions',
                    text: 'You must agree to the terms and conditions to proceed.',
                });
                return;
            }

            // If validation passes, submit form data via AJAX
            $.ajax({
                url: '/register/insert', // Replace with your actual server-side URL
                type: 'POST',
                data: {
                    firstname: firstName,
                    lastname: lastName,
                    emailaddress: email,
                    password: password,
                    termsCheck: termsCheck
                },
                success: function (response) {
                    // Check the response from the server
                    if (response.success) {
                        // Show success message on successful form submission
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Successful',
                            text: response.message, // Use the message from the server
                        }).then(() => {
                            // Clear form fields after showing success alert
                            $('#register')[0].reset();
                        });
                    } else {
                        // Show error message if registration fails (e.g., email already exists)
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: response.message, // Use the error message from the server
                        });
                    }
                },
                error: function (xhr, status, error) {
                    // Show a general error message if the request fails
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration Failed',
                        text: 'There was an error with your registration. Please try again later.',
                    });
                }
            });
        });
    });

</script>