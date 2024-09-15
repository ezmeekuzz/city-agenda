<?=$this->include('templates/organizer/header');?>
<style>
    /* Targeting elements inside the publish-settings form */
    form.publish-settings-form input[type="radio"] {
        transform: scale(1.5); /* Make the radio buttons larger */
        margin-right: 10px;
    }

    form.publish-settings-form label {
        font-weight: 500; /* Make labels more prominent */
    }

    form.publish-settings-form p {
        margin-left: 25px; /* Align text with radio buttons */
        font-size: 14px; /* Adjust text size */
        color: #666; /* Make the description text lighter */
    }

    form.publish-settings-form h2, 
    form.publish-settings-form h4 {
        font-weight: 600; /* Make headings more prominent */
    }
</style>
<div class="app-container">
    <?=$this->include('templates/organizer/sidebar');?>
    <div class="app-main" id="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h4><i class="ti ti-calendar"></i> Publish Event</h4>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                    <a href="<?=base_url();?>organizer/"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        Dashboard
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Publish Event</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row select-wrapper">
                <div class="col-lg-12 selects-contant">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <div class="card-heading">
                                <h4 class="card-title"><i class="fa fa-calendar"></i> Publish Event</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Heading Content -->
                            <div class="event-publish-info mb-5" style="text-align: center; margin-bottom: 20px;">
                                <h2>Your Event Is Almost Ready To Publish</h2>
                                <p>Review Your Settings And Let Everyone Find Your Event.</p>
                            </div>

                            <!-- Flexbox Container for Image and Event Details -->
                            <div class="flex-container mt-3" style="display: flex; align-items: flex-start;">
                                <!-- Left Side: Event Banner Image -->
                                <div class="image-container" style="flex: 1; padding-right: 20px;">
                                    <img src="/<?=$eventDetails['eventbanner'];?>" style="width: 100%; height: auto; border-radius: 12px;" alt="Event Banner" />
                                </div>

                                <!-- Right Side: Event Details -->
                                <div class="event-details" style="flex: 2;">
                                    <h1><?=$eventDetails['eventname'];?></h1>
                                    <h3>
                                        <?= date('l, F j', strtotime($eventDetails['eventdate'])); ?> · 
                                        <?= date('gA', strtotime($eventDetails['eventstartingtime'])); ?> - 
                                        <?= date('gA', strtotime($eventDetails['eventendingtime'])); ?> EDT
                                    </h3>
                                    <p class="mt-3"><?=$eventDetails['locationname'];?>, <?=$eventDetails['cityname'];?>, <?=$eventDetails['state_name'];?></p>
                                    <p class="mt-3">
                                        <span><i class="fa fa-ticket"></i> $<?=$eventDetails['price'];?></span>
                                        <span><i class="fa fa-user"></i> <?=$eventDetails['availablequantity'];?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="publish-settings" style="margin-top: 30px;">
                                <form id="publishEvent">
                                    <h2 class="mb-3">Publish Settings</h2>
                                    <input type="hidden" name="event_id" id="event_id" value="<?=$eventDetails['event_id'];?>">
                                    <h4 class="mb-3">Is Your Event Public Or Private?</h4>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="public" name="event_visibility" value="Public" checked>
                                        <label class="form-check-label" for="public">Public</label>
                                        <p>Public: Your event will appear in the search engine and other pages.</p>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="private" name="event_visibility" value="Private">
                                        <label class="form-check-label" for="private">Private</label>
                                        <p>Private: Your event will not appear in the search engine. Only people with the link can view your event.</p>
                                    </div>

                                    <h4 class="mb-3">Refund Policy</h4>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="no_refund" name="refund_policy" value="No Refund" checked>
                                        <label class="form-check-label" for="no_refund">Do Not Allow Refund.</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="refund_24_hours" name="refund_policy" value="Refund 24 Hours">
                                        <label class="form-check-label" for="refund_24_hours">Allow Refund If Attendee Cancels 24 Hours Before The Event Starts.</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" id="refund_7_days" name="refund_policy" value="Refund 7 Days">
                                        <label class="form-check-label" for="refund_7_days">Allow Refund If Attendee Cancels 7 Days Before The Event Starts.</label>
                                    </div>

                                    <p>Please note, if you cancel your event regardless of the reasons, all attendees who bought tickets will be refunded.</p>

                                    <!-- Submit Button -->
                                    <div style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-primary">Publish</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?=$this->include('templates/organizer/footer');?>
<script>
    $(document).ready(function() {
        // Get event details from server-side PHP (assuming PHP variable `eventDetails` is available)
        var eventVisibility = "<?=$eventDetails['publishsetting'];?>";
        var refundPolicy = "<?=$eventDetails['refundpolicy'];?>";

        // Set visibility radio button based on eventVisibility
        if (eventVisibility === 'Public') {
            $('#public').prop('checked', true);
        } else if (eventVisibility === 'Private') {
            $('#private').prop('checked', true);
        } else {
            // Default to Public if no valid value is found
            $('#public').prop('checked', true);
        }

        // Set refund policy radio button based on refundPolicy
        if (refundPolicy === 'No Refund') {
            $('#no_refund').prop('checked', true);
        } else if (refundPolicy === 'Refund 24 Hours') {
            $('#refund_24_hours').prop('checked', true);
        } else if (refundPolicy === 'Refund 7 Days') {
            $('#refund_7_days').prop('checked', true);
        } else {
            // Default to No Refund if no valid value is found
            $('#no_refund').prop('checked', true);
        }
    });
</script>
<script src="<?=base_url();?>assets/js/organizer/publishevent.js"></script>