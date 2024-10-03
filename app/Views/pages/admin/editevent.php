<?=$this->include('templates/admin/header');?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_H6wQhY-ksDyboh_b-Sa17kkUbeKPdmk&libraries=places"></script>
<div class="app-container">
    <?=$this->include('templates/admin/sidebar');?>
    <div class="app-main" id="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h4><i class="fa fa-calendar"></i> Edit Event</h4>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                    <a href="<?=base_url();?>admin/"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        Dashboard
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Edit Event</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row select-wrapper">
                <form id="addevent" enctype="multipart/form-data">
                    <div class="col-lg-12">
                        <div class="card card-statistics">
                            <div class="card-header">
                                <div class="card-heading">
                                    <h4 class="card-title float-left"><i class="ti ti-calendar"></i> Event</h4>
                                    <div class="float-right">
                                        <div class="form-group">
                                            <div class="checkbox checbox-switch switch-success">
                                                <label>
                                                    <input type="checkbox" value = "Yes" name="publishstatus" <?php if ($eventDetails['publishstatus'] == 'Yes') echo 'checked'; ?> />
                                                    <span></span>
                                                    Publish
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group" hidden>
                                    <label for="event_id">Event ID</label>
                                    <input type="text" name="event_id" id="event_id" value="<?=$eventDetails['event_id'];?>" class="form-control" placeholder="Enter Event Name">
                                </div>
                                <div class="form-group">
                                    <label for="eventbanner">Add Event Banner</label>
                                    <div class="upload-area" id="uploadArea" style="background: url('/<?=$eventDetails['eventbanner'];?>');">
                                        <h2>Add Event Banner</h2>
                                        <button type="button" id="fileSelectBtn" class="btn btn-primary">
                                            <i class="fa fa-upload"></i><br>
                                            Upload Photo
                                        </button>
                                        <input type="file" id="eventbanner" name="eventbanner" hidden accept=".jpg, .jpeg, .png, .webp">
                                        <div id="fileList"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select id="category_id" name="category_id" class="form-control chosen-select" data-placeholder="Choose a category...">
                                        <option></option>
                                        <?php if($categoryList) : ?>
                                        <?php foreach($categoryList as $list) : ?>
                                        <option value="<?=$list['category_id'];?>" <?php if($eventDetails['category_id'] == $list['category_id']) { echo "selected"; } ?>><?=$list['categoryname'];?></option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="eventname">Event Name</label>
                                    <input type="text" name="eventname" id="eventname" value="<?=$eventDetails['eventname'];?>" class="form-control" placeholder="Enter Event Name">
                                </div>
                                <div class="form-group">
                                    <label for="shortdescription">Grab people's attention with a short description about your event. attendees will see this at the top of your event page. (140 Characters Max)</label>
                                    <textarea class="form-control" name="shortdescription" id="shortdescription" placeholder="Enter Description" rows="5"><?=$eventDetails['shortdescription'];?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card card-statistics">
                            <div class="card-header">
                                <div class="card-heading">
                                    <h4 class="card-title float-left"><i class="ti ti-time"></i> Schedule</h4>
                                    <div class="float-right">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="singleEvent" name="eventtype" value="Single" <?php if($eventDetails['eventtype'] == 'Single') { echo "checked"; } ?> class="custom-control-input" checked>
                                                <label class="custom-control-label" for="singleEvent">Single Event</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="recurringEvent" name="eventtype" value="Recurring" <?php if($eventDetails['eventtype'] == 'Recurring') { echo "checked"; } ?> class="custom-control-input">
                                                <label class="custom-control-label" for="recurringEvent">Recurring Event</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-4" id="dateField">
                                        <label for="inputDate">Date</label>
                                        <input type="date" class="form-control" name="eventdate" id="inputDate" value="<?=$eventDetails['eventdate'];?>">
                                    </div>
                                    <div class="form-group col-md-4" id="startTimeField">
                                        <label for="inputStartTime">Starting Time</label>
                                        <input type="time" class="form-control" name="eventstartingtime" id="inputStartTime" value="<?=$eventDetails['eventstartingtime'];?>">
                                    </div>
                                    <div class="form-group col-md-4" id="endTimeField">
                                        <label for="inputEndTime">End Time</label>
                                        <input type="time" class="form-control" name="eventendingtime" id="inputEndTime" value="<?=$eventDetails['eventendingtime'];?>">
                                    </div>
                                    <div class="form-group col-md-3" id="recurrenceOptions" style="display: none;">
                                        <label for="recurrence">Recurrence</label>
                                        <select id="recurrence" name="recurrence" class="form-control">
                                            <option disabled selected>Select Recurrence</option>
                                            <option value="Daily" <?php if($eventDetails['recurrence'] == 'Daily') { echo 'selected'; } ?> >Daily</option>
                                            <option value="Weekly" <?php if($eventDetails['recurrence'] == 'Weekly') { echo 'selected'; } ?>>Weekly</option>
                                            <option value="Monthly" <?php if($eventDetails['recurrence'] == 'Monthly') { echo 'selected'; } ?>>Monthly</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-statistics">
                            <div class="card-header">
                                <div class="card-heading">
                                    <h4 class="card-title float-left"><i class="ti ti-map"></i> Venue</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="locationname">Location Name</label>
                                    <input type="text" name="locationname" value="<?=$eventDetails['locationname'];?>" id="locationname" class="form-control" placeholder="Enter Location Name">
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" name="state" value="<?=$eventDetails['state'];?>" id="state" class="form-control" placeholder="Enter State" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" value="<?=$eventDetails['city'];?>" id="city" class="form-control" placeholder="Enter City" readonly>
                                </div>
                                <div id="map" style="height: 400px; width: 100%;"></div>
                            </div>
                        </div>
                        <div class="card card-statistics">
                            <div class="card-header">
                                <div class="card-heading">
                                    <h4 class="card-title float-left"><i class="ti ti-list"></i> Event Description</h4>
                                    <div class="float-right">
                                        <div class="form-group">
                                            <button type="button" id="addImageBtn" class="btn btn-success mr-2">
                                                <i class="ti ti-image"></i> Add Image
                                            </button>
                                            <button type="button" id="addVideoBtn" class="btn btn-primary">
                                                <i class="ti ti-video-camera"></i> Add Video
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="eventdescription">Description</label>
                                    <textarea class="form-control" name="eventdescription" id="eventdescription" placeholder="Enter Content"><?=$eventDetails['eventdescription'];?></textarea>
                                </div>
                                <div id="mediaContent">
                                    <!-- Containers for the selected files -->
                                    <div id="imageLabel" class="mt-2"></div>
                                    <div id="videoLabel" class="mt-2"></div>
                                </div>

                                <!-- Hidden file input fields -->
                                <input type="file" id="imageInput" name="event_image" accept="image/*" style="display:none;">
                                <input type="file" id="videoInput" name="event_video" accept="video/*" style="display:none;">
                            </div>
                        </div>
                        <div class="card card-statistics">
                            <div class="card-header">
                                <div class="card-heading">
                                    <h4 class="card-title float-left"><i class="ti ti-list"></i> Add More Sections To Your Event Page</h4>
                                    <label>
                                        Make Your Event Stand Out Even More. These Sections Help Attendees Find Information And Answer Their Questions - Which Means More Ticket Sales And Less Time Answering Messages.
                                    </label>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="accordion">
                                    <!-- Agenda Section -->
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Agenda
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <div id="slotsContainer">
                                                    <?php if($agendasList) : ?>
                                                    <?php foreach($agendasList as $list) : ?>
                                                    <div class="slot-item">
                                                        <div class="form-group">
                                                            <label for="slotTitle">Title</label>
                                                            <input type="text" name="slotTitle[]" value="<?=$list['agenda_title'];?>" class="form-control" placeholder="Enter Title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="slotDescription">Description</label>
                                                            <textarea name="slotDescription[]" class="form-control" placeholder="Enter Description"><?=$list['agenda_description'];?></textarea>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="slotStartTime">Starting Time</label>
                                                                <input type="time" name="slotStartTime[]" value="<?=$list['agenda_start_time'];?>" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="slotEndTime">Ending Time</label>
                                                                <input type="time" name="slotEndTime[]" value="<?=$list['agenda_end_time'];?>" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    <?php else : ?>
                                                    <div class="slot-item">
                                                        <div class="form-group">
                                                            <label for="slotTitle">Title</label>
                                                            <input type="text" name="slotTitle[]" class="form-control" placeholder="Enter Title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="slotDescription">Description</label>
                                                            <textarea name="slotDescription[]" class="form-control" placeholder="Enter Description"></textarea>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="slotStartTime">Starting Time</label>
                                                                <input type="time" name="slotStartTime[]" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="slotEndTime">Ending Time</label>
                                                                <input type="time" name="slotEndTime[]" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <button type="button" id="addSlotBtn" class="btn btn-secondary mt-3">Add Slot</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Speakers or Hosts Section -->
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="mb-0">
                                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Speakers or Hosts
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                            <div class="card-body">
                                                <div id="speakersContainer">
                                                    <?php if($speakersList) : ?>
                                                    <?php foreach($speakersList as $list) : ?>
                                                    <div class="speaker-item">
                                                        <div class="form-group">
                                                            <label for="speakerName">Speaker Name</label>
                                                            <input type="text" name="speakerName[]" value="<?=$list['name'];?>" class="form-control" placeholder="Enter Speaker Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="speakerJob">Speaker's Job</label>
                                                            <input type="text" name="speakerJob[]" value="<?=$list['job'];?>" class="form-control" placeholder="Enter Speaker's Job">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="speakerImage">Speaker's Image</label>
                                                            <input type="file" name="speakerImage[]" class="form-control" accept=".jpg, .jpeg, .png, .webp">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label for="facebookLink">Facebook</label>
                                                                <input type="text" name="facebookLink[]" value="<?=$list['facebook_link'];?>" class="form-control" placeholder="Facebook Link">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="instagramLink">Instagram</label>
                                                                <input type="text" name="instagramLink[]" value="<?=$list['instagram_link'];?>" class="form-control" placeholder="Instagram Link">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="youtubeLink">YouTube</label>
                                                                <input type="text" name="youtubeLink[]" value="<?=$list['youtube_link'];?>" class="form-control" placeholder="YouTube Link">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="twitterLink">Twitter</label>
                                                                <input type="text" name="twitterLink[]" value="<?=$list['twitter_link'];?>" class="form-control" placeholder="Twitter Link">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    <?php else : ?>
                                                    <div class="speaker-item">
                                                        <div class="form-group">
                                                            <label for="speakerName">Speaker Name</label>
                                                            <input type="text" name="speakerName[]" class="form-control" placeholder="Enter Speaker Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="speakerJob">Speaker's Job</label>
                                                            <input type="text" name="speakerJob[]" class="form-control" placeholder="Enter Speaker's Job">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="speakerImage">Speaker's Image</label>
                                                            <input type="file" name="speakerImage[]" class="form-control" accept=".jpg, .jpeg, .png, .webp">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label for="facebookLink">Facebook</label>
                                                                <input type="text" name="facebookLink[]" class="form-control" placeholder="Facebook Link">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="instagramLink">Instagram</label>
                                                                <input type="text" name="instagramLink[]" class="form-control" placeholder="Instagram Link">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="youtubeLink">YouTube</label>
                                                                <input type="text" name="youtubeLink[]" class="form-control" placeholder="YouTube Link">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="twitterLink">Twitter</label>
                                                                <input type="text" name="twitterLink[]" class="form-control" placeholder="Twitter Link">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <button type="button" id="addSpeakerBtn" class="btn btn-secondary mt-3">Add Speaker</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h5 class="mb-0">
                                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Sponsors and Partners
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                            <div class="card-body">
                                                <div id="sponsorsContainer">
                                                    <?php if($sponsorsList) : ?>
                                                    <?php foreach($sponsorsList as $list) : ?>
                                                    <div class="sponsor-item">
                                                        <div class="form-group">
                                                            <label for="sponsorDescription">General Description</label>
                                                            <textarea name="sponsorDescription[]" class="form-control" placeholder="Enter Sponsor Description"><?=$list['sponsor_description'];?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sponsorLogo">Sponsor Logo</label>
                                                            <input type="file" name="sponsorLogo[]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    <?php else : ?>
                                                    <div class="sponsor-item">
                                                        <div class="form-group">
                                                            <label for="sponsorDescription">General Description</label>
                                                            <textarea name="sponsorDescription[]" class="form-control" placeholder="Enter General Description"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sponsorLogo">Sponsor Logo</label>
                                                            <input type="file" name="sponsorLogo[]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <button type="button" id="addSponsorBtn" class="btn btn-secondary mt-3">Add Sponsor</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFour">
                                            <h5 class="mb-0">
                                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    FAQ
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                            <div class="card-body">
                                                <div id="faqContainer">
                                                    <?php if($faqsList) : ?>
                                                    <?php foreach($faqsList as $list) : ?>
                                                    <div class="faq-item">
                                                        <div class="form-group">
                                                            <label for="question">Question</label>
                                                            <input type="text" name="question[]" value="<?=$list['question'];?>" class="form-control" placeholder="Enter Question">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="answer">Answer</label>
                                                            <textarea name="answer[]" class="form-control" placeholder="Enter Answer"><?=$list['answer'];?></textarea>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    <?php else : ?>
                                                    <div class="faq-item">
                                                        <div class="form-group">
                                                            <label for="question">Question</label>
                                                            <input type="text" name="question[]" class="form-control" placeholder="Enter Question">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="answer">Answer</label>
                                                            <textarea name="answer[]" class="form-control" placeholder="Enter Answer"></textarea>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <button type="button" id="addFaqBtn" class="btn btn-secondary mt-3">Add FAQ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit Event</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><?=$this->include('templates/admin/footer');?>
<script type="text/javascript" src="<?=base_url();?>assets/js/admin/editevent.js"></script>