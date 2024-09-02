<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$title;?></title>

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/responsive.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script>
        // Google Sign-In setup
        function handleCredentialResponse(response) {
            const idToken = response.credential;

            fetch('<?=base_url();?>login/google_callback', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'credential=' + encodeURIComponent(idToken)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/dashboard';
                } else {
                    alert('Login failed. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        window.onload = function () {
            google.accounts.id.initialize({
                client_id: '717214415755-50s2mm9uk13l9rs36jh7am6h59i8kdcn.apps.googleusercontent.com',
                callback: handleCredentialResponse
            });
            google.accounts.id.renderButton(
                document.getElementById('buttonDiv'),
                { theme: 'outline', size: 'large' }
            );
        };

        // Facebook SDK setup
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) { return; }
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // Initialize the Facebook SDK
        window.fbAsyncInit = function() {
            FB.init({
                appId: '401735096268819', // Replace with your actual App ID
                cookie: true,
                xfbml: true,
                version: 'v20.0' // Ensure this version is valid and supported
            });

            FB.AppEvents.logPageView();
        };

        // Function to check login status and handle login
        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                console.log('Facebook login status response:', response);
                if (response.status === 'connected') {
                    statusChangeCallback(response);
                } else {
                    // Show the login dialog if not logged in
                    FB.login(function(response) {
                        if (response.status === 'connected') {
                            statusChangeCallback(response);
                        } else {
                            alert('User cancelled login or did not fully authorize.');
                        }
                    }, {scope: 'email'}); // Request the necessary permissions
                }
            });
        }

        function statusChangeCallback(response) {
            if (response.status === 'connected') {
                FB.api('/me', { fields: 'name,email' }, function(apiResponse) {
                    const accessToken = FB.getAuthResponse().accessToken;
                    const userID = apiResponse.id;
                    const name = apiResponse.name;
                    const email = apiResponse.email;

                    fetch('<?=base_url();?>login/facebook_callback', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            accessToken: accessToken,
                            userID: userID,
                            name: name,
                            email: email
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = '/dashboard';
                        } else {
                            alert('Login failed. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error during Facebook login:', error);
                        alert('An error occurred during login. Please try again later.');
                    });
                });
            } else {
                alert('User cancelled login or did not fully authorize.');
            }
        }
    </script>
</head>

<body>
    <section class="container-fluid">
        <div class="row flex-lg-row flex-column-reverse">
            <div class="col-lg-6 col-md-12 d-flex flex-column gap-2 justify-content-center align-items-center login-sec">
                <img class="regLogo" src="img/reg-Img-Logo.png">
                <h2>Welcome To City Agenda</h2>
                <form class="login-form">
                    <input type="name" name="log-name" placeholder="Email Address">
                    <input type="password" name="log-pass" placeholder="Password">
                    <div class="formCheckItem">
                        <div class="forgot-checkbox">
                            <input type="checkbox">
                            <label>Remember Me</label>
                        </div>
                        <a href="#">Forget Your Password</a>
                    </div>
                    <input type="submit" value="Login">
                </form>
                <p>Don’t Have An Account? <a href="#">Create An Account</a> Or Sign Up With. </p>
                <div class="sign-up-with">
                    <div></div> <!-- Added this div for Google Sign-In button -->
                    <button id="buttonDiv"></button>
                    <button onclick="checkLoginState()"><img src="img/fb-img.png"> <span>Continue With Facebook</span></button>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 reg-image-sec"></div>
        </div>
    </section>

    <?=$this->include('templates/footer');?>
</body>
</html>
