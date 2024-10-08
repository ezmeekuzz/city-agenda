<?=$this->include('templates/header');?>
<style>
    .counterSec i {
        cursor: pointer;
    }
    #card-element {
        height: 60px; /* Adjust the height of the container */
    }
    #countdown {
        color: #fff;
    }
</style>
<section class="container-fluid normal-event-section">
    <div class="container event-banner" style="background-image: url(<?=$eventDetails['eventbanner'];?>);">
        <div class="row">
            <div class="col-lg-6 col-md-12 event-countdown">
                <div class="countdown" id="countdown">00 | 00 | 00 | 00</div>
            </div>
            <script>
                // Get the event date and time from PHP
                const eventDateTime = '<?= $eventDateTime; ?>';

                // Function to calculate the countdown
                function startCountdown(eventTime) {
                    const eventDate = new Date(eventTime).getTime();

                    const interval = setInterval(function () {
                        const now = new Date().getTime();
                        const distance = eventDate - now;

                        // Time calculations for days, hours, minutes, and seconds
                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        // Display the result in the countdown element
                        document.querySelector('.countdown').innerHTML = days + " Days | " + hours + " Hours | " + minutes + " Minutes | " + seconds + " Seconds";

                        // If the countdown is finished, display some message
                        if (distance < 0) {
                            clearInterval(interval);
                            document.querySelector('.countdown').innerHTML = "EXPIRED";
                        }
                    }, 1000);
                }

                // Start the countdown
                startCountdown(eventDateTime);
            </script>
        </div>
    </div>
</section>
<section class="container-fluid inner-page event-sec">
    <div class="container">
        <div class="row mb-5 flex-lg-row flex-column-reverse">
            <div class="col-lg-8 col-md-12 d-flex flex-column gap-3">
                <h1><?=$eventDetails['eventname'];?></h1>
                <h5><?=$eventDetails['shortdescription'];?></h5>
                <div class="event-user-sec">
                    <div class="user-profile">
                        <img src="/<?=$eventDetails['image'];?>" alt="User Profile Image" style="border-radius: 50%; width: 80px; height: 80px; object-fit: cover;">
                        <ul>
                            <li><a href="#">By <?=$eventDetails['firstname'] . ' ' . $eventDetails['lastname'];?></a></li>
                            <!--<li><a href="#"> 26.6K Followers</a></li>-->
                        </ul>
                    </div>
                    <button class="main-btn">Explore</button>
                </div>
                <div class="date-location">
                    <div class="dl-sec">
                        <h3>Date And Time</h3>
                        <p><i class="bi bi-calendar-month"></i><?=$eventSchedule;?></p>
                    </div>
                    <div class="dl-sec">
                        <h3>Location</h3>
                        <p><i class="bi bi-geo-alt-fill"></i><?=$eventDetails['locationname'];?></p>
                    </div>
                </div>
                <h2>About This Event</h2>
                <?=$eventDetails['eventdescription'];?>
                <h3>Refund Policy </h3>
                <ul class="refund-list">
                    <li><img src="img/birdImg.png"><?=$eventDetails['refundpolicy'];?></li> 
                </ul>
            </div>
            <div class="col-lg-4 col-md-12 d-flex flex-column gap-2 gap-lg-5 ps-0 ps-lg-5">
                <div class="icon-controls">
                    <i class="bi bi-suit-heart-fill" data-bs-toggle="modal" data-bs-target="#heartModal"></i>
                    <i class="bi bi-upload" data-bs-toggle="modal" data-bs-target="#emailModal"></i>
                </div>
                <div class="modal fade" id="heartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content d-flex flex-column gap-2 align-items-center p-5">
                            <h4>Share With Friends</h4>
                            <hr>
                            <div class="social-share">
                                <i class="bi bi-twitter"></i>
                                <i class="bi bi-facebook"></i>
                                <i class="bi bi-instagram"></i>
                                <i class="bi bi-linkedin"></i>
                                <i class="bi bi-tiktok"></i>
                            </div>
                            <form class="copy-link">
                                <label>Eventurl</label>
                                <input type="text" value="/event-w-payment.html">
                                <i class="bi bi-clipboard"></i>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content d-flex flex-column gap-2 align-items-center p-5">
                            <h4>Share this event</h4>
                            <hr>
                            <form class="form-email">
                                <input type="email" placeholder="Email Address">
                                <input type="submit" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="free-tickets">
                    <div class="quantity">
                        <h3><?= $eventDetails['ticketname']; ?></h3>
                        <div class="counterSec">
                            <!-- Decrement button -->
                            <i class="bi bi-dash-lg" onclick="decrementCounter(0)"></i>
                            
                            <!-- Display the counter -->
                            <span id="counter1">0</span>
                            
                            <!-- Increment button -->
                            <i class="bi bi-plus-lg" onclick="incrementCounter(0)"></i>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            // JavaScript to handle the ticket counter
                            var counters = [0]; // Assuming there's only one counter for now, initialized with 0.

                            // Get the price value and convert it to a number
                            var price = parseFloat(document.getElementById('price').value) || 0;
                            var total_sales = 0;
                            document.getElementById('labelQuantity1').innerText = 0;
                            document.getElementById('labelQuantity2').innerText = 0;
                            // Debugging: Check if you get the correct value in the console
                            console.log('Price:', price); 

                            // Function to increment the counter
                            function incrementCounter(index) {
                                counters[index]++; // Increment the counter
                                document.getElementById('counter1').innerText = counters[index]; // Update the displayed counter
                                document.getElementById('quantity').value = counters[index]; // Update quantity input field
                                // Recalculate total sales
                                total_sales = price * counters[index]; 
                                document.getElementById('total_sales').value = total_sales.toFixed(2);
                                document.getElementById('labelQuantity1').innerText = counters[index];
                                document.getElementById('labelQuantity2').innerText = counters[index];
                                document.getElementById('labelTotalAmount1').innerText = total_sales.toFixed(2);
                                document.getElementById('labelTotalAmount2').innerText = total_sales.toFixed(2);
                            }

                            // Function to decrement the counter
                            function decrementCounter(index) {
                                if (counters[index] > 0) {
                                    counters[index]--; // Decrease the counter if it's greater than 0
                                    document.getElementById('counter1').innerText = counters[index]; // Update the displayed counter
                                    document.getElementById('quantity').value = counters[index]; // Update quantity input field
                                    // Recalculate total sales
                                    total_sales = price * counters[index]; 
                                    document.getElementById('total_sales').value = total_sales.toFixed(2);
                                    document.getElementById('labelQuantity1').innerText = counters[index];
                                    document.getElementById('labelQuantity2').innerText = counters[index];
                                    document.getElementById('labelTotalAmount1').innerText = total_sales.toFixed(2);
                                    document.getElementById('labelTotalAmount2').innerText = total_sales.toFixed(2);
                                }
                            }

                            // Expose the increment and decrement functions to the global scope, if necessary
                            window.incrementCounter = incrementCounter;
                            window.decrementCounter = decrementCounter;
                        });
                    </script>
                    <h4>€<?=$eventDetails['price'];?></h4>
                    <button class="main-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Get tickets</button>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="row modal-details">
                                <div class="col-md-7 d-flex flex-column gap-2 align-items-center p-5">
                                    <h4>Checkout</h4>
                                    <?php
                                        $salesend = strtotime($eventDetails['salesend']);
                                        $current_time = time();
                                        $timeDifference = $salesend - $current_time;
                                        if ($timeDifference > 0) {
                                            echo "<script>var timeLeft = $timeDifference;</script>";
                                        } else {
                                            echo "<script>var timeLeft = 0;</script>";
                                        }
                                    ?>
                                    <p id="countdownTimer">Time Left 00:00</p>
                                    <script>
                                        window.onload = function startCountdown() {
                                            var countdownInterval = setInterval(function () {
                                                if (timeLeft > 0) {
                                                    var hours = Math.floor(timeLeft / 3600);
                                                    var minutes = Math.floor((timeLeft % 3600) / 60);
                                                    var formattedTime = ("0" + hours).slice(-2) + ":" + ("0" + minutes).slice(-2);
                                                    document.getElementById("countdownTimer").innerHTML = "Time Left " + formattedTime;

                                                    timeLeft -= 60;
                                                } else {
                                                    clearInterval(countdownInterval);
                                                    document.getElementById("countdownTimer").innerHTML = "Time Left 00:00";
                                                }
                                            }, 1000);
                                        };
                                    </script>
                                    <hr>
                                    <form id="payment-form">
                                        <input type="hidden" name="ticket_id" value="<?=$eventDetails['ticket_id'];?>">
                                        <input type="hidden" name="event_id" value="<?=$eventDetails['event_id'];?>">
                                        <input type="hidden" name="user_id" value="<?=session()->get('organizer_user_id');?>">
                                        <input type="hidden" name="price" id="price" value="<?=$eventDetails['price'];?>">
                                        <input type="hidden" name="total_sales" id="total_sales">
                                        <input type="hidden" name="quantity" id="quantity" value="1">
                                        <input type="hidden" name="tickettype" value="<?=$eventDetails['tickettype'];?>">
                                        <div class="fullname">
                                            <label>
                                                First Name*
                                                <input type="text" name="first_name" value="<?= session()->get('organizer_firstname'); ?>" required>
                                            </label>
                                            <label>
                                                Last Name*
                                                <input type="text" name="last_name" value="<?= session()->get('organizer_lastname'); ?>" required>
                                            </label>
                                        </div>
                                        <label class="email-input">
                                            Email Address*
                                            <input type="email" name="email" value="<?= session()->get('organizer_emailaddress'); ?>" required>
                                        </label>
                                        <label class="checkbox-input">
                                            <input type="checkbox" name="updates" value="1">
                                            Keep Me Updated On More Events And News From This Event Organizer.
                                        </label>
                                        <label class="checkbox-input">
                                            <input type="checkbox" name="best_events" value="1">
                                            Send Me Emails About The Best Events Happening Nearby Or Online.
                                        </label><h4>Pay With</h4>
                                        <script src="https://js.stripe.com/v3/"></script>
                                        <div class="credit-debit">
                                            <label>
                                                <input type="radio" name="collapseGroup" value="section1"> Credit Or Debit Card
                                            </label>
                                            <div id="section1" class="collapse">
                                                <div class="form-row">
                                                    <label for="card-element">
                                                        Card Number, Expiry Date, CVC
                                                    </label>
                                                    <div id="card-element">
                                                    </div>
                                                    <div id="card-errors" role="alert" style="color: red;"></div>
                                                </div>

                                                <label class="checkbox-input">
                                                    <input type="checkbox">
                                                    Save Payment Details To Your Account (Optional)
                                                </label>
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                            // Get all radio buttons with the name 'collapseGroup'
                                            var radios = document.querySelectorAll('input[name="collapseGroup"]');

                                            // Add change event listener to each radio button
                                            radios.forEach(function(radio) {
                                                radio.addEventListener('change', function() {
                                                    // Hide all collapsible sections initially
                                                    document.querySelectorAll('.collapse').forEach(function(section) {
                                                        section.style.display = 'none';
                                                    });

                                                    // Get the selected value (the section to show)
                                                    var selectedSection = document.getElementById(this.value);
                                                    
                                                    // Show the selected section
                                                    if (selectedSection) {
                                                        selectedSection.style.display = 'block';
                                                    }
                                                });
                                            });

                                            // Set default visibility for the initially checked radio button
                                            var checkedRadio = document.querySelector('input[name="collapseGroup"]:checked');
                                            if (checkedRadio) {
                                                document.getElementById(checkedRadio.value).style.display = 'block';
                                            }
                                        });
                                        </script>
                                        <p>By Selecting Place Order, I Agree To The  CityAgenda Terms Of Services</p>
                                        <input type="submit" value="Place Order" class="main-btn place-oder">
                                    </form>
                                </div>
                                <div class="col-md-5 order-col">
                                    <img src="<?=$eventDetails['eventbanner'];?>" alt="Order Image" class="img-fluid">
                                    <div class="order-sum">
                                        <div class="order-details">
                                            <h4>Order Summary</h4>
                                            <p><?= $eventSchedule; ?></p>
                                            <hr>
                                            <div class="sum-detail">
                                                <p><span id="labelQuantity1"></span> x <?= $eventDetails['ticketname']; ?></p>
                                                <p><b>€<span id="labelTotalAmount1"></span></b></p>
                                            </div>
                                        </div>
                                        <div class="order-total">
                                            <div class="sum-total">
                                                <p><b><span id="labelQuantity2"></span> x Eticket</b></p>
                                                <h5><b>€<span id="labelTotalAmount2"></span></b></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($agendasDetails) : ?>
    <h1>Agenda</h1>
        <?php foreach($agendasDetails as $list) : ?>
        <div class="agenda-sec mt-4">
            <div class="agend-date">
                <h4>
                <?php
                    // Assuming $eventDetails['eventdate'], $list['agenda_start_time'], and $list['agenda_end_time'] are strings
                    $eventDate = strtotime($eventDetails['eventdate']); // Convert event date to timestamp
                    $startTime = strtotime($list['agenda_start_time']); // Convert start time to timestamp
                    $endTime = strtotime($list['agenda_end_time']); // Convert end time to timestamp

                    // Format the event date as "Friday, August 9"
                    $formattedDate = date('l, F j', $eventDate);

                    // Format the start time as "12 AM"
                    $formattedStartTime = date('g A', $startTime);

                    // Format the end time as "5 AM" (PST is assumed as static)
                    $formattedEndTime = date('g A', $endTime) . ' PST';

                    // Output the final formatted date and time
                    echo $formattedDate . ' ' . $formattedStartTime . ' - ' . $formattedEndTime;
                ?>
                </h4>
            </div>
            <div class="agenda-content">
                <div class="agenda-details">
                    <h3><?=$list['agenda_title'];?></h3>
                    <p><?=$list['agenda_description'];?></p>
                </div>
                <!--<div class="agend-person">
                    <img src="img/img-user.png">
                    <img src="img/img-user1.png">
                </div>-->
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>
<?php if($sponsorsDetails) : ?>
<section class="container-fluid banner sponsors-section">
    <div class="container">
        <h2>Sponsors And Partners</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed ullamcorper morbi tincidunt ornare. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. </p>
        <div class="sponsors-logos">
        <?php foreach($sponsorsDetails as $list) : ?>
            <img src="<?=$list['sponsor_logo'];?>">
        <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<section class="container-fluid find-free-political-section main-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 gap-4 d-flex align-items-center mb-4 mb-lg-0">
                <h2>Find Similar Events</h2>
            </div>
            <div class="col-lg-3 col-md-12 pt-lg-0 pt-md-4 gap-3 d-flex justify-content-around align-items-start align-items-lg-center flex-column">
                <div class="carousel-control-section find-free-political">
                    <button class="carousel-control-prev" type="button" data-bs-target="#find-free-political" data-bs-slide="prev">
                        <i class="bi bi-arrow-left-short"></i>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#find-free-political" data-bs-slide="next">
                        <i class="bi bi-arrow-right-short"></i>
                    </button> 
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="events-container">
        
    </div>
</section>
<?=$this->include('templates/footer');?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var stripe = Stripe('pk_test_EXAPOOl0hxz5SAhlAwzqb4ta'); // Your Stripe key
        var elements = stripe.elements();
        var card = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }
        });
        card.mount('#card-element');

        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Show SweetAlert2 loading effect before starting the payment process
            Swal.fire({
                title: 'Processing Payment...',
                text: 'Please wait while we process your payment.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Create a token with the card details (without zip code)
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    Swal.close(); // Close the loading effect
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Handle the token and use AJAX to send it to the server
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var formData = new FormData(document.getElementById('payment-form'));
            formData.append('stripeToken', token.id);

            // Send the token via AJAX to the server
            $.ajax({
                url: '/eventdetails/stripePayment',  // Adjust the route to your CodeIgniter controller
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        title: 'Payment Successful!',
                        text: 'Your payment has been processed successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Reset the form after a successful payment
                        form.reset();
                        card.clear(); // Clear the card details from the Stripe element
                        // Redirect or reload page after confirmation
                        window.location.href = '<?= base_url('/'); ?>';
                    });
                },
                error: function(xhr) {
                    // Handle errors and show them in SweetAlert2
                    Swal.fire({
                        title: 'Payment Failed!',
                        text: 'An error occurred: ' + xhr.responseText,
                        icon: 'error',
                        confirmButtonText: 'Retry'
                    });
                }
            });
        }
        function loadEvents() {
            $.ajax({
                url: '/getEvents',  // Endpoint to get events
                method: 'GET',
                data: {
                    category: '',  // Pass selected category
                    date: ''           // Pass selected date
                },
                success: function(response) {
                    let eventsContainer = $('#events-container');
                    eventsContainer.empty();  // Clear the previous events

                    if (response.length === 0) {
                        eventsContainer.html('<center> <img src="img/page-not-found.png" alt=""></center><center><h1 style="color: #741774;">No Events Found</h1></center>');
                        return;
                    }

                    // Loop through the response and create HTML for each event
                    response.forEach(function(event) {
                        // Determine if the event is favorited
                        const isFavoritedClass = event.is_favorited ? 'active' : '';
                        
                        let eventHTML = `
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card">
                                    <!-- User image (circular) -->
                                    <img class="user-id img-fluid" src="${event.image}" alt="User" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; margin: 10px;">
                                    
                                    <!-- Event banner -->
                                    <img src="${event.eventbanner}" class="img-fluid" style="max-height: 250px; object-fit: cover;" alt="${event.eventname}">
                                    
                                    <div class="card-body">
                                        <!-- Event name and heart icon on the right -->
                                        <div class="d-flex align-items-center">
                                            <a href="${event.slug}" style="text-decoration: none; color: black; flex-grow: 1;">
                                                <h4 style="font-size: 1.2rem;">${event.eventname}</h4>
                                            </a>
                                            <!-- Heart icon positioned on the right -->
                                            <button class="heart-button ml-auto" onclick="toggleFavorite(this, ${event.event_id})" style="border: none; background: transparent;">
                                                <i class="bi bi-suit-heart-fill heartIcon ${isFavoritedClass}" style="font-size: 1.5rem; color: red;"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="card-bottom p-2">
                                        <div class="d-flex align-items-center">
                                            <p class="ml-2">
                                                ${event.city} <br>
                                                <span>${event.locationname}</span>
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clock-fill"></i>
                                            <p class="ml-2">
                                                ${formatDate(event.eventdate)}<br>
                                                <span>${formatTime(event.eventstartingtime)}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                        eventsContainer.append(eventHTML);  // Append the event HTML to the container
                    });
                },
                error: function() {
                    $('#events-container').html('<p>Error loading events</p>');  // Show error message
                }
            });
        }
        // Initial load of events
        loadEvents();

        // Formatting helper functions
        function formatDate(dateString) {
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            const date = new Date(dateString);
            return date.toLocaleDateString('en-GB', options);
        }

        function formatTime(timeString) {
            let [hours, minutes] = timeString.split(':');
            let period = 'AM';

            hours = parseInt(hours);
            if (hours >= 12) {
                period = 'PM';
                if (hours > 12) hours -= 12;
            } else if (hours === 0) hours = 12;

            return `${hours}:${minutes} ${period}`;
        }
    });
    
    function toggleFavorite(button, eventId) {
        const heartIcon = button.querySelector('.heartIcon');
        const isActive = heartIcon.classList.contains('active'); // Check the current state

        // Toggle the active class
        heartIcon.classList.toggle('active');

        // Send an AJAX request to update the wishlist in the database
        $.ajax({
            url: '/wishlist/toggle',  // Change this to your actual API route
            type: 'POST',
            data: {
                event_id: eventId,  // The ID of the event being favorited/unfavorited
                is_favorited: !isActive  // True if adding to favorites, False if removing
            },
            success: function(response) {
                if (response.status === 'success') {
                    // Show success notification
                    Swal.fire({
                        icon: 'success',
                        title: !isActive ? 'Added to Wishlist' : 'Removed from Wishlist',
                        text: !isActive ? 'The item has been added to your wishlist.' : 'The item has been removed from your wishlist.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else if (response.status === 'error' && response.message === 'You need to log in first to add this event to your wishlist.') {
                    // Show login required error message
                    Swal.fire({
                        icon: 'warning',
                        title: 'Login Required',
                        text: response.message, // The error message from the server
                        timer: 3000,
                        showConfirmButton: false
                    });
                    // Reverse the toggle state since the user is not logged in
                    heartIcon.classList.toggle('active');
                } else {
                    // Show error notification
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error updating the wishlist. Please try again.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    // If there's an error, reverse the toggle state
                    heartIcon.classList.toggle('active');
                }
            },
            error: function(xhr, status, error) {
                // Show error notification for AJAX failure
                Swal.fire({
                    icon: 'error',
                    title: 'AJAX Error',
                    text: 'There was a problem with your request. Please try again.',
                    timer: 2000,
                    showConfirmButton: false
                });
                // In case of error, reverse the toggle state
                heartIcon.classList.toggle('active');
            }
        });
    }
</script>