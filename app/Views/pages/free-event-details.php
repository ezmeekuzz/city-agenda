<?=$this->include('templates/header');?>
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
                        <img src="/<?=$eventDetails['image'];?>">
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
                        <p><i class="bi bi-geo-alt-fill"></i><?=$eventDetails['locationname'];?>, <?=$eventDetails['cityname'];?></p>
                    </div>
                </div>
                <h2>About This Event</h2>
                <?=$eventDetails['eventdescription'];?>
                <h3>Refund Policy </h3>
                <ul class="refund-list">
                    <li><img src="img/birdImg.png"><?=$eventDetails['refundpolicy'];?></li> 
                </ul>
                <h2>Tags</h2>
                <div class="tag-section">
                    <button class="main-btn tag-items">Online Events</button>
                    <button class="main-btn tag-items">Things To Do Online</button>
                    <button class="main-btn tag-items">Online Conferences</button>
                    <button class="main-btn tag-items">Online Science & Tech Conferences</button>
                    <button class="main-btn tag-items">#Conference</button>
                    <button class="main-btn tag-items">#Upskill</button>
                    <button class="main-btn tag-items">#Product_Manager</button>
                    <button class="main-btn tag-items">#Product_Management</button>
                    <button class="main-btn tag-items">#Break_Into_Product</button>
                    <button class="main-btn tag-items">#Breakintoproduct</button>
                </div>
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
                            <h4>Get Updated By Email</h4>
                            <hr>
                            <form class="form-email">
                                <input type="email" placeholder="Email Address">
                                <input type="submit" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="free-tickets">
                    <h3>Free</h3>
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
                                    <form action="/process_checkout" method="POST">
                                        <input type="text" name="ticket_id" value="<?=$eventDetails['ticket_id'];?>">
                                        <input type="text" name="event_id" value="<?=$eventDetails['event_id'];?>">
                                        <input type="text" name="user_id" value="<?=session()->get('organizer_user_id');?>">
                                        <input type="text" name="total_sales" value="0.00">
                                        <input type="text" name="quantity" value="1">
                                        <input type="text" name="tickettype" value="<?=$eventDetails['tickettype'];?>">
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
                                        </label>
                                        <p>By Selecting Register, I Agree To The <a href="#">CityAgenda Terms Of Services</a>.</p>
                                        <button type="submit" class="btn btn-primary">Complete Purchase</button>
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
                                                <p>1 x <?= $eventDetails['ticketname']; ?></p>
                                                <p><b>₱0.00</b></p>
                                            </div>
                                            <hr>
                                            <p>Delivery</p>
                                            <div class="sum-detail">
                                                <p>1 x Eticket</p>
                                                <p><b>₱0.00</b></p>
                                            </div>
                                        </div>
                                        <div class="order-total">
                                            <div class="sum-total">
                                                <p><b>1 x Eticket</b></p>
                                                <h5><b>₱0.00</b></h5>
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
    <div class="container-fluid">
        <div id="find-free-political" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card" >
                        <img class="user-id" src="img/user-img.png">
                        <i class="bi bi-suit-heart-fill heartIcon"></i>
                        <img src="img/image-6.png" class="card-img" alt="image-1">
                        <div class="card-body">
                            <h3>California Piano Concert Events 2024</h3>
                        </div>
                        <div class="card-bottom">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill"></i>
                                <p>
                                    Amsterdam <br>
                                    <span>Schipol Airport</span>
                                </p>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock-fill"></i>
                                <p>
                                    17 July 2024<br>
                                    <span>6:00 Am</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?=$this->include('templates/footer');?>