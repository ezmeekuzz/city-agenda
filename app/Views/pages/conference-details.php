<?=$this->include('templates/header');?>
<section class="container-fluid confernce-section" style="background-image: url(<?=$eventDetails['eventbanner'];?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 md-12 confernce-content">
                <!--<h2>12 <span>Days</span></h2>-->
                <h2><?=COUNT($agendasDetails);?> <span>Workshops</span></h2>
                <h2><?=COUNT($speakersDetails);?> <span>Speakers</span></h2>
                <hr>
                <p><?=date('F d, Y', strtotime($eventDetails['eventdate']));?>, <?=$eventDetails['cityname']?>, <?=$eventDetails['eventname']?></p>
                <div class="banner-btn-section">
                    <button class="main-btn getTick">Get Tickets</button>
                    <button class="main-btn viewSched">View Schedule</button>
                </div>
                <div class="confernce-counter"></div>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid inner-page confernce-inner-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 pe-0 pe-lg-5">
                    <h3><?=$eventDetails['eventname'];?></h3>
                    <?=$eventDetails['eventdescription'];?>
                    <br>
                    <a href="#">SEE FAQ</a>
                    <br>
                    <br>
                    <h4>Venue: <span><?=$eventDetails['locationname'];?></span></h4>
                    <div class="con-inner-img">
                        <img src="img/venue-img.png">
                        <img src="img/venue-img1.png">
                        <img src="img/venue-img2.png">
                        <img src="img/venue-img3.png">
                        <img src="img/venue-img4.png">
                    </div>
                    <h4><span><?=$eventDetails['locationname'] . ', ' . $eventDetails['cityname'] . ', ' . $eventDetails['state_name'];?></span></h4>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="user-sched-sec">
                        <div class="prof-sec">
                            <div class="prof-details">
                                <img src="img/confi-user.png">
                                <div class="prof-ident">
                                    <h4>Jonathan</h4>
                                    <p>Host</p>
                                </div>
                            </div>
                            <button class="prof-btn">€<?=number_format($eventDetails['price'], 2);?></button>
                        </div>
                        <div class="user-sched-input row">
                            <input type="date" class="col-lg-12">
                            <input type="time" class="col-lg-5">
                            <h5 class="col-lg-2">To</h5>
                            <input type="time" class="col-lg-5">
                            <hr>
                            <input type="submit" class="col-lg-12 main-btn" value="Get Tickets">
                            <p><?=$eventDetails['refundpolicy'];?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="container-fluid inner-page">
        <div class="container">
            <h3>Meet The Speaker</h3>
            <div class="row">
                <?php if($speakersDetails) : ?>
                <?php foreach($speakersDetails as $list) : ?>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="speaker-card">
                        <div class="speaker-details" style="background-image: url(<?=$list['image'];?>);">
                            <h5><?=$list['name'];?></h5>
                            <p><?=$list['job'];?></p>
                        </div>
                        <div class="speaker-icons">
                            <a href="<?=$list['facebook_link'];?>"><i class="bi bi-facebook"></i></a>
                            <a href="<?=$list['twitter_link'];?>"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <section class="container-fluid banner sponsors-section">
        <div class="container">
            <h2>Sponsors And Partners</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed ullamcorper morbi tincidunt ornare. Nunc eget lorem dolor sed viverra ipsum nunc aliquet. </p>
            <div class="sponsors-logos">
                <?php if($sponsorsDetails) : ?>
                <?php foreach($sponsorsDetails as $list) : ?>
                <img src="<?=$list['sponsor_logo'];?>" alt="">
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>


    <section class="container-fluid inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <h2>Getting 
                        Started: 
                        Frequently 
                        Asked 
                        Questions</h2>
                </div>
                <div class="col-lg-8 col-md-12">
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
                                Can I Sell Tickets Online For A Charity Event On City Agenda ?
                              </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                              <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                How Do I Use City Agenda?
                              </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                              <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?=$this->include('templates/footer');?>