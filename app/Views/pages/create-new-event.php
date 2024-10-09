<?=$this->include('templates/header');?>
<style>
/* Styling the buttons as smaller, pill-shaped, and with custom background */
.btn-select-pill {
    background-color: #DCDCDC;
    border: none;
    border-radius: 50px; /* Makes the button a pill shape */
    padding: 5px 15px; /* Adjusts size to make it smaller */
    font-size: 18px !important; /* Smaller text size */
    color: black;
    margin-right: 10px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Change background color and text color when active */
.btn-select-pill.active {
    background-color: #741774; /* Active state background */
    color: white; /* White text on active */
}

/* Hide the radio inputs */
input[type="radio"] {
    display: none;
}

/* Change background and text color on hover */
.btn-select-pill:hover {
    background-color: #741774; /* Hover color */
    color: white; /* White text on hover */
}

</style>
<section class="container-fluid banner inner-page create-event">
        <div class="container d-flex flex-column align-items-center gap-3">
            <h3> Welcome To CityAgenda</h3>
            <p>This Platform Was Built To Support Entrepreneurs, Politics, Business, Religions, Education, Cultures And Sports Events. You Can Promote Your Event To The Public And Start Selling Tickets, We Do Not Support Nightclubs, Music Festivals, Or Parties Types Of Events Please Do Not Use City Agenda Platform Of These Types Of Event You Can Use Different Platforms For This Purpose. If You Want To Learn More Read Our Policies In Terms Of Use And Privacy Before You Publish Your Event.</p>
        </div>
    </section>
    <section class="container-fluid inner-page">
        <div class="container mb-5">
            <div class="progress-container">
                <div class="progress-step active">
                    <p>Build Event Page</p>
                    <div class="circle">1</div>
                    <div class="line"></div>
                </div>
                <div class="progress-step">
                    <p>Add Tickets</p>
                    <div class="circle">2</div>
                    <div class="line"></div>
                </div>
                <div class="progress-step">
                    <p>Publish</p>
                    <div class="circle">3</div>
                </div>
            </div>
        </div>
        <form class="container mt-5 upload-section" id="addevent" enctype="multipart/form-data">
            <h2>Add Event Banner</h2>
            <div class="upload-container mt-4">
                <div class="upload-banner" id="uploadBanner" style="background-image: url('img/upload-img-bg.png');">
                    <div class="upload-text" id="uploadText">
                        <i class="bi bi-cloud-arrow-up"></i>
                        <p>Upload Photos</p>
                    </div>
                    <input type="file" id="eventbanner" name="eventbanner" hidden accept=".jpg, .jpeg, .png, .webp">
                </div>
            </div>
            <div class="event-input-detials-section">
                <label>
                    Select Your Event Category *
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Category
                        </button>
                        <ul class="dropdown-menu">
                            <?php if($categoryList) : ?>
                            <?php foreach($categoryList as $list) : ?>
                            <li><a class="dropdown-item" href="javascript:void(0);" data-id="<?=$list['category_id'];?>"><?=$list['categoryname'];?></a></li>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                      </div>
                      <input type="hidden" name="category_id" id="category_id" value="" required>
                </label>
                <label>
                    What Is The Event Name? *
                    <p>Be clear with your event name that tells people what your event is about</p>
                    <input class="btn btn-secondary event-name" type="text" name="eventname" id="eventname" placeholder="Type Event Name Here">
                </label>
                <label>
                    Event Summary*
                    <p>Grab people's attention with a short description about your event. attendees will see this 
                        at the top of your event page. (140 Characters Max) </p>
                    <div class="card p-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="btn-group me-2" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-light"><b>B</b></button>
                                <button type="button" class="btn btn-light"><i>I</i></button>
                                <button type="button" class="btn btn-light"><u>U</u></button>
                                <button type="button" class="btn btn-light"> <i class="bi bi-list-ul"></i> </button>
                                <button type="button" class="btn btn-light"> <i class="bi bi-list-ol"></i> </button>
                            </div>
                            <button type="button" class="btn btn-success me-2">New</button>
                            <button type="button" class="btn btn-light">Generate using AI ✨</button>
                            <button type="button" class="btn btn-light ms-auto"><i class="bi bi-code"></i></button>
                        </div>
                        <textarea class="form-control" rows="7" name="shortdescription" id="shortdescription" placeholder="Write your event summary here..."></textarea>
                    </div>
                </label>
            </div>
            <div class="event-input-detials-section">
                <div class="event-date-section">
                    Date And Time*
                    <div class="form-group">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-select-pill snglEvent">
                                <input type="radio" name="eventtype" id="singleEvent" value="Single" autocomplete="off" checked hidden> Single Event
                            </label>
                            <label class="btn btn-select-pill recurEvent">
                                <input type="radio" name="eventtype" id="recurringEvent" value="Recurring" autocomplete="off" hidden> Recurring Event
                            </label>
                        </div>
                    </div>
                </div>
                <div class="event-date-section">
                    <div class="date-inputs-fields">
                        <div class="date-fields-item">
                            <p>Date*</p>
                            <div class="input-field">
                                <input type="date" name="eventdate" id="inputDate">
                            </div>
                        </div>
                        <div class="date-fields-item">
                            <p>Starting Time*</p>
                            <div class="input-field">
                                <input type="time" name="eventstartingtime" id="inputStartTime">
                            </div>
                        </div>
                        <div class="date-fields-item">
                            <p>End Time</p>
                            <div class="input-field">
                                <input type="time" name="eventendingtime" id="inputEndTime">
                            </div>
                        </div>
                        <div class="date-fields-item recurring-event" style="margin-top: 10px;">
                            <p>Recurrence</p>
                            <select id="recurrence" name="recurrence" class="form-control" style="height: 58px;">
                                <option disabled selected>Select Recurrence</option>
                                <option value="Daily">Daily</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Monthly">Monthly</option>
                            </select>
                        </div>
                    </div>
                    <div class="date-inputs-fields">
                        <div class="date-fields-item location-inputs">
                            <h3>Location Name*</h3>
                            <div class="input-field">
                                <input type="text" name="locationname" id="locationname" placeholder="Enter Location Name" >
                                <input type="text" name="state" id="state" placeholder="Address" >
                                <input type="text" name="city" id="city" placeholder="City" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event-date-section">
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
                <label>
                    Event Description*
                    <p>Grab people's attention with a short description about your event. attendees will see this 
                        at the top of your event page. </p>
                    <div class="card p-3">
                        <h4 class="text-summary">Event Description</h4>
                        <div class="d-flex align-items-center mb-2">
                            <div class="btn-group me-2" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-light"><b>B</b></button>
                                <button type="button" class="btn btn-light"><i>I</i></button>
                                <button type="button" class="btn btn-light"><u>U</u></button>
                                <button type="button" class="btn btn-light"> <i class="bi bi-list-ul"></i> </button>
                                <button type="button" class="btn btn-light"> <i class="bi bi-list-ol"></i> </button>
                            </div>
                            <button type="button" class="btn btn-success me-2">New</button>
                            <button type="button" class="btn btn-light">Generate using AI ✨</button>
                            <button type="button" class="btn btn-light ms-auto"><i class="bi bi-code"></i></button>
                        </div>
                        <textarea class="form-control" name="eventdescription" rows="15" placeholder="Write your event summary here..."></textarea>
                    </div>
                </label>
                <div class="event-date-section">
                    <div class="uploadButton">
                        <button type="button" id="addImageBtn" class="main-btn uploadBtn"><i class="bi bi-card-image"></i>Add Image</button>
                        <button type="button" id="addVideoBtn" class="main-btn uploadBtn"><i class="bi bi-play-btn-fill"></i>Add Video</button>
                    </div>
                    <div id="mediaContent">
                        <div id="imageLabel" class="mt-2"></div>
                        <div id="videoLabel" class="mt-2"></div>
                    </div>
                    <input type="file" id="imageInput" name="event_image" accept="image/*" style="display:none;">
                    <input type="file" id="videoInput" name="event_video" accept="video/*" style="display:none;">
                </div>
            </div>
            <div class="event-input-detials-section">
                <label>
                    Add More Sections To Your Event Page
                    <p>Make Your Event Stand Out Even More. These Sections Help Attendees Find Information And Answer Their 
                        Questions -Which Means More Ticket Sales And Less Time Answering Messages.</p>
                </label>
                <div class="event-date-section">
                    <div class="event-content-field-item">
                        <div class="toggelHeader" data-bs-toggle="collapse" href="#agenda" role="button" aria-expanded="false" aria-controls="agenda">
                            <h3> <i class="bi bi-journal-text"></i>Agenda*</h3>
                            <button class="main-btn" type="button" data-bs-toggle="collapse" data-bs-target="#agenda" aria-expanded="false" aria-controls="agenda">
                                + Add 
                            </button>
                        </div>
                        <div class="collapse" id="agenda">
                            <div class="card card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">Agenda</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" href="#">+ Add New Agenda</a>
                                    </li> -->
                                </ul>
                                <div id="agendaForm">
                                    <div class="form-row form-section">
                                        <div class="row">
                                            <div class="form-group form-section">
                                                <input type="text" name="slotTitle[]" class="agenda-title" placeholder="Title*" >
                                                <textarea rows="7" name="slotDescription[]" class="agenda-description" placeholder="Add Description" ></textarea>
                                            </div>
                                            <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                                                <label>Starting Time*</label>
                                                <div class="input-group">
                                                    <input type="time" name="slotStartTime[]" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                                                <label>End Time</label>
                                                <div class="input-group">
                                                    <input type="time" name="slotEndTime[]" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-section buttonLink">
                                            <!-- <a href="#" class="mr-3"><i class="icon">&#128100;</i> Host Or Artist</a> -->
                                            <!-- <a href="#"><i class="icon">&#9998;</i> Add Description</a> -->
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="form-group form-section">
                                    <div class="main-btn add-slot-btn">+ Add Slot</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event-content-field-item">
                        <div class="toggelHeader" data-bs-toggle="collapse" href="#meet-the-speakers" role="button" aria-expanded="false" aria-controls="meet-the-speakers">
                            <h3><i class="bi bi-person-fill"></i>Speakers Or Hosts*</h3>
                            <button class="main-btn" type="button" data-bs-toggle="collapse" data-bs-target="#meet-the-speakers" aria-expanded="false" aria-controls="meet-the-speakers">
                                + Add 
                            </button>
                        </div>
                        <div class="collapse" id="meet-the-speakers">
                            <div class="card card-body">
                                <div id="meet-the-speakers-section">
                                    <div class="row">
                                        <div class="col-lg-12 form-row form-section">
                                            <h3>Speakers</h3>
                                            <div class="row">
                                                <div class="col-md-5 mb-3 gap-2 d-flex flex-column">
                                                    <div class="input-group">
                                                        <input type="text" name="speakerName[]" class="form-control" placeholder="Speakers's Name" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3 gap-2 d-flex flex-column">
                                                    <div class="input-group">
                                                        <input type="text" name="speakerJob[]" class="form-control" placeholder="Speaker's Job" >
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3 gap-2 d-flex flex-column">
                                                    <div class="input-group img-upload-btn">
                                                        <input type="file" name="speakerImage[]" id="file-upload" />
                                                        <div for="file-upload" class="file-upload-btn">
                                                            <i class="bi bi-card-image"></i>
                                                            Speaker Image
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-row form-section">
                                            <h5>Sponsor Socail Link</h5>
                                            <div id="meetthespeakers">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                                                        <div class="input-group">
                                                            <input type="text" name="facebookLink[]" class="form-control" placeholder="Facebook" >
                                                            <i class="bi bi-facebook"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                                                        <div class="input-group">
                                                            <input type="text" name="instagramLink[]" class="form-control" placeholder="Instagram" >
                                                            <i class="bi bi-instagram"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                                                        <div class="input-group">
                                                            <input type="text" name="youtubeLink[]" class="form-control" placeholder="Youtube" >
                                                            <i class="bi bi-youtube"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                                                        <div class="input-group">
                                                            <input type="text" name="twitterLink[]" class="form-control" placeholder="Twitter X" >
                                                            <i class="bi bi-twitter"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3 gap-2 d-flex flex-column">
                                                        <button class="main-btn meetthespeakers-btn">+ Add More Speaker</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event-content-field-item">
                        <div class="toggelHeader" data-bs-toggle="collapse" href="#sponsors-and-partner" role="button" aria-expanded="false" aria-controls="sponsors-and-partner">
                            <h3><i class="bi bi-people"></i>Sponsors And Partner*</h3>
                            <button class="main-btn" type="button" data-bs-toggle="collapse" data-bs-target="#sponsors-and-partner" aria-expanded="false" aria-controls="sponsors-and-partner">
                                + Add 
                            </button>
                        </div>
                        <div class="collapse" id="sponsors-and-partner">
                            <div class="card card-body">
                                <div id="socialLink-sap">
                                    <div class="row">
                                        <div class="col-lg-12 form-row form-section">
                                            <h3>Sponsors And Partner*</h3>
                                            <div class="row">
                                                <div class="col-md-12 mb-3 gap-2 d-flex flex-column">
                                                    <div class="input-group">
                                                        <textarea name="sponsorDescription[]" maxlength="240" rows="4" class="agenda-description" placeholder="Add General Description" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 form-row form-section">
                                            <h5>Add Sponsor Logo Link</h5>
                                            <div id="linkSponsor">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                                                        <div class="input-group img-upload-btn">
                                                            <input type="file" name="sponsorLogo[]" id="file-upload" />
                                                            <div for="file-upload" class="file-upload-btn">
                                                                <i class="bi bi-card-image"></i>
                                                                Add the Sponsor Logo
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3 gap-2 d-flex flex-column">
                                                        <button class="main-btn add-more-btn-sap">+ Add More Sponsor</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event-content-field-item">
                        <div class="toggelHeader" data-bs-toggle="collapse" href="#faq-section" role="button" aria-expanded="false" aria-controls="faq-section">
                            <h3><i class="bi bi-question-circle-fill"></i>FAQ*</h3>
                            <button class="main-btn" type="button" data-bs-toggle="collapse" data-bs-target="#faq-section" aria-expanded="false" aria-controls="faq-section">
                                + Add 
                            </button>
                        </div>
                        <div class="collapse" id="faq-section">
                            <div class="card card-body">
                                <div class="form-row form-section">
                                    <div id="faqSection">
                                        <h3>FAQ</h3>
                                        <div class="row">
                                            <div class="col-md-5 mb-3 gap-2 d-flex flex-column">
                                                <div class="input-group">
                                                    <input type="text" name="question[]" class="form-control" placeholder="Type question here" >
                                                </div>
                                            </div>
                                            <div class="col-md-5 mb-3 gap-2 d-flex flex-column">
                                                <div class="input-group">
                                                    <input type="text" name="answer[]" class="form-control" placeholder="Type Answer Here" >
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3 gap-2 d-flex flex-column">
                                                <div class="input-group">
                                                    <button class="main-btn faq-add-more">Add more</button>
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
            <div class="create-submit-btn">
                <i class="bi bi-arrow-up-right submit-btn-arrow"></i>
                <input class="main-btn" type="submit" value="Save & Continue">
            </div>
        </form>
    </section>
<?=$this->include('templates/footer');?>
<script>
// Get the upload banner, file input, and text elements
const uploadBanner = document.getElementById('uploadBanner');
const fileInput = document.getElementById('eventbanner');
const uploadText = document.getElementById('uploadText');

// Add a click event listener to the upload banner
uploadBanner.addEventListener('click', function() {
    // Trigger the file input when the banner is clicked
    fileInput.click();
});

// Add a change event listener to the file input
fileInput.addEventListener('change', function(event) {
    // Check if a file is selected
    if (event.target.files && event.target.files[0]) {
        let file = event.target.files[0];
        let reader = new FileReader();

        // When the file is loaded, update the background image
        reader.onload = function(e) {
            // Set the background image of the upload banner to the selected image
            uploadBanner.style.backgroundImage = `url('${e.target.result}')`;
            // Optionally hide the upload text once an image is uploaded
            uploadText.style.display = 'none';
        };

        // Read the selected image file as a data URL
        reader.readAsDataURL(file);
    }
});

// Select the buttons and the recurring event field
const singleEventButton = document.querySelector('.snglEvent');
const recurringEventButton = document.querySelector('.recurEvent');
const recurringField = document.querySelector('.recurring-event');

// Show recurrence field when "Recurring Event" button is clicked
recurringEventButton.addEventListener('click', function() {
    recurringField.style.display = 'block'; // Show the recurrence field
});

// Hide recurrence field when "Single Event" button is clicked
singleEventButton.addEventListener('click', function() {
    recurringField.style.display = 'none';  // Hide the recurrence field
});


let map, marker, geocoder, autocomplete;

function initMap() {
    // Default location (e.g., New York City)
    const defaultLocation = { lat: 40.712776, lng: -74.005974 };
    
    // Initialize the map centered on the default location
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 13,
        center: defaultLocation
    });

    // Initialize a draggable marker
    marker = new google.maps.Marker({
        map: map,
        draggable: true
    });

    // Initialize the geocoder for future use
    geocoder = new google.maps.Geocoder();

    // Initialize autocomplete for the location input field
    setupAutocomplete();

    // Add event listener to update the map position when the marker is dragged
    google.maps.event.addListener(marker, 'dragend', updateMapCenter);
}

// Function to set up the autocomplete for the location input
function setupAutocomplete() {
    const locationInput = document.getElementById("locationname");
    autocomplete = new google.maps.places.Autocomplete(locationInput);

    // When the user selects a place, populate the map and address fields
    autocomplete.addListener('place_changed', function () {
        const place = autocomplete.getPlace();
        if (!place.geometry) {
            console.error("No details available for input: '" + place.name + "'");
            return;
        }

        // Center the map on the selected place
        map.setCenter(place.geometry.location);
        marker.setPosition(place.geometry.location);

        // Extract and fill in the state and city fields
        fillAddressComponents(place);
    });
}

// Function to extract and populate address components (state and city)
function fillAddressComponents(place) {
    const addressComponents = place.address_components;
    let state = '';
    let city = '';

    // Iterate through the address components
    addressComponents.forEach(component => {
        const types = component.types;

        // State/Province from 'administrative_area_level_2' (PH provinces)
        if (types.includes('administrative_area_level_2')) {
            state = component.long_name;
        }
        // City/Municipality from 'locality' or 'administrative_area_level_1'
        if (types.includes('locality')) {
            city = component.long_name;
        }
        // Backup: Get state if city isn't found from 'administrative_area_level_1'
        if (types.includes('administrative_area_level_1') && !city) {
            state = component.long_name;
        }
    });

    // Populate the state and city fields
    document.getElementById("state").value = state;
    document.getElementById("city").value = city;
}

// Update map center when the marker is dragged
function updateMapCenter() {
    map.panTo(marker.getPosition());
}

// Initialize the map when the window loads
window.onload = initMap;

document.getElementById('addImageBtn').addEventListener('click', function() {
        document.getElementById('imageInput').click();
    });
    
    document.getElementById('addVideoBtn').addEventListener('click', function() {
        document.getElementById('videoInput').click();
    });
    
    document.getElementById('imageInput').addEventListener('change', function(event) {
        displaySelectedFile(event, 'image');
    });
    
    document.getElementById('videoInput').addEventListener('change', function(event) {
        displaySelectedFile(event, 'video');
    });
    
    function displaySelectedFile(event, type) {
        const file = event.target.files[0];
        
        if (file) {
            const fileDisplay = document.getElementById(`${type}Label`);
    
            if (type === 'image') {
                fileDisplay.innerHTML = `<strong>Image:</strong> ${file.name}`;
            } else if (type === 'video') {
                fileDisplay.innerHTML = `<strong>Video:</strong> ${file.name}`;
            }
        }
    }
// Select the Add Slot button and the agenda form container
const addSlotBtn = document.querySelector('.add-slot-btn');
const agendaForm = document.getElementById('agendaForm');

// Event listener for the Add Slot button
addSlotBtn.addEventListener('click', function() {
    // Create a new div to hold the new slot (clone of the first form-row)
    const newSlot = document.createElement('div');
    newSlot.classList.add('form-row', 'form-section');

    // Insert the HTML for the new agenda slot (same structure as the existing one)
    newSlot.innerHTML = `
        <div class="row">
            <div class="form-group form-section">
                <input type="text" name="slotTitle[]" class="agenda-title" placeholder="Title*" >
                <textarea rows="7" name="slotDescription[]" class="agenda-description" placeholder="Add Description" ></textarea>
            </div>
            <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                <label>Starting Time*</label>
                <div class="input-group">
                    <input type="time" name="slotStartTime[]" class="form-control" >
                </div>
            </div>
            <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                <label>End Time</label>
                <div class="input-group">
                    <input type="time" name="slotEndTime[]" class="form-control" >
                </div>
            </div>
        </div>
        <div class="form-group form-section buttonLink">
            <!-- Optional buttons for host or artist or add description if needed -->
        </div>
    `;

    // Append the new slot to the agenda form container
    agendaForm.appendChild(newSlot);
});
// Select the Add More Speaker button and the speakers section container
const addMoreSpeakerBtn = document.querySelector('.meetthespeakers-btn');
const speakersSection = document.getElementById('meet-the-speakers-section');

// Event listener for the Add More Speaker button
addMoreSpeakerBtn.addEventListener('click', function(e) {
    e.preventDefault(); // Prevent form submission if inside a form

    // Create a new div to hold the new speaker slot (clone the speaker form-row)
    const newSpeaker = document.createElement('div');
    newSpeaker.classList.add('row');

    // Insert the updated HTML for the new speaker slot (same structure as the existing one with names added)
    newSpeaker.innerHTML = `
        <div class="row mts">
            <div class="col-lg-12 form-row form-section">
                <h3>Speakers</h3>
                <div class="row">
                    <div class="col-md-5 mb-3 gap-2 d-flex flex-column">
                        <div class="input-group">
                            <input type="text" name="speakerName[]" class="form-control" placeholder="Speaker's Name" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 gap-2 d-flex flex-column">
                        <div class="input-group">
                            <input type="text" name="speakerJob[]" class="form-control" placeholder="Speaker's Job" required>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3 gap-2 d-flex flex-column">
                        <div class="input-group img-upload-btn">
                            <input type="file" name="speakerImage[]" id="file-upload" required/>
                            <div for="file-upload" class="file-upload-btn">
                                <i class="bi bi-card-image"></i>
                                Speaker Image
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 form-row form-section">
                <h5>Sponsor Social Link</h5>
                <div id="meetthespeakers">
                    <div class="row">
                        <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                            <div class="input-group">
                                <input type="url" name="facebookLink[]" class="form-control" placeholder="Facebook" required>
                                <i class="bi bi-facebook"></i>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                            <div class="input-group">
                                <input type="url" name="instagramLink[]" class="form-control" placeholder="Instagram" required>
                                <i class="bi bi-instagram"></i>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                            <div class="input-group">
                                <input type="url" name="youtubeLink[]" class="form-control" placeholder="YouTube" required>
                                <i class="bi bi-youtube"></i>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                            <div class="input-group">
                                <input type="url" name="twitterLink[]" class="form-control" placeholder="Twitter X" required>
                                <i class="bi bi-twitter"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3 gap-2 d-flex flex-column">
                            <button class="main-btn meetthespeakers-btn-remove">+ Remove Speaker</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Append the new speaker slot to the speakers section
    speakersSection.appendChild(newSpeaker);

    // Add an event listener for the "Remove Speaker" button
    const removeSpeakerBtn = newSpeaker.querySelector('.meetthespeakers-btn-remove');
    removeSpeakerBtn.addEventListener('click', function() {
        speakersSection.removeChild(newSpeaker); // Remove the speaker block from the section
    });
});
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const addMoreSponsorBtn = document.querySelector('.add-more-btn-sap');
    const sponsorSection = document.getElementById('socialLink-sap');

    // Event listener for Add More Sponsor button
    addMoreSponsorBtn.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default button behavior

        // Create a new div for the additional sponsor block
        const newSponsorBlock = document.createElement('div');
        newSponsorBlock.classList.add('row', 'sap');

        // HTML structure for the new sponsor block with unique names for inputs
        newSponsorBlock.innerHTML = `
            <div class="col-lg-12 form-row form-section">
                <h3>Sponsors And Partner*</h3>
                <div class="row">
                    <div class="col-md-12 mb-3 gap-2 d-flex flex-column">
                        <div class="input-group">
                            <textarea name="sponsorDescription[]" maxlength="240" rows="4" class="agenda-description" placeholder="Add General Description" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 form-row form-section">
                <h5>Add Sponsor Logo Link</h5>
                <div id="linkSponsor">
                    <div class="row">
                        <div class="col-md-6 mb-3 gap-2 d-flex flex-column">
                            <div class="input-group img-upload-btn">
                                <input type="file" name="sponsorLogo[]" id="file-upload" required/>
                                <div class="file-upload-btn">
                                    <i class="bi bi-card-image"></i> Add the Sponsor Logo
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3 gap-2 d-flex flex-column">
                            <button class="main-btn remove-btn-sap"><i class="bi bi-x-lg"></i> Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Append the new sponsor block to the sponsor section
        sponsorSection.appendChild(newSponsorBlock);

        // Add event listener for Remove Sponsor button within the newly created block
        const removeSponsorBtn = newSponsorBlock.querySelector('.remove-btn-sap');
        removeSponsorBtn.addEventListener('click', function() {
            sponsorSection.removeChild(newSponsorBlock); // Remove the sponsor block
        });
    });

    // Handle remove for initial blocks as well
    document.querySelectorAll('.remove-btn-sap').forEach(removeBtn => {
        removeBtn.addEventListener('click', function() {
            const sponsorBlock = removeBtn.closest('.row.sap');
            if (sponsorBlock) {
                sponsorBlock.remove(); // Remove the corresponding block
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Section Variables
    const addMoreFaqBtn = document.querySelector('.faq-add-more');
    const faqSection = document.getElementById('faqSection');

    // Event listener for Add More FAQ button
    addMoreFaqBtn.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default button behavior

        // Create a new div for the additional FAQ block
        const newFaqBlock = document.createElement('div');
        newFaqBlock.classList.add('row', 'faq');

        // HTML structure for the new FAQ block with unique names for inputs
        newFaqBlock.innerHTML = `
            <div class="col-md-5 mb-3 gap-2 d-flex flex-column">
                <div class="input-group">
                    <input type="text" name="faq_question[]" class="form-control" placeholder="Type question here" required>
                </div>
            </div>
            <div class="col-md-5 mb-3 gap-2 d-flex flex-column">
                <div class="input-group">
                    <input type="text" name="faq_answer[]" class="form-control" placeholder="Type Answer Here" required>
                </div>
            </div>
            <div class="col-md-2 mb-3 gap-2 d-flex flex-column">
                <div class="input-group">
                    <button class="main-btn faq-delete-btn"><i class="bi bi-x-lg"></i>Remove</button>
                </div>
            </div>
        `;

        // Append the new FAQ block to the FAQ section
        faqSection.appendChild(newFaqBlock);

        // Add event listener for Remove FAQ button within the newly created block
        const removeFaqBtn = newFaqBlock.querySelector('.faq-delete-btn');
        removeFaqBtn.addEventListener('click', function() {
            faqSection.removeChild(newFaqBlock); // Remove the FAQ block
        });
    });

    // Handle remove for initial blocks as well
    document.querySelectorAll('.faq-delete-btn').forEach(removeBtn => {
        removeBtn.addEventListener('click', function() {
            const faqBlock = removeBtn.closest('.row.faq');
            if (faqBlock) {
                faqBlock.remove(); // Remove the corresponding block
            }
        });
    });
});
$(document).ready(function () {
    // Update hidden input when category is selected from the dropdown
    $('.dropdown-menu').on('click', 'a.dropdown-item', function() {
        var selectedCategory = $(this).text();
        var selectedCategoryId = $(this).data('id');
        
        // Update the dropdown button text to show the selected category
        $(this).closest('.dropdown').find('.dropdown-toggle').text(selectedCategory);
        
        // Set the hidden input field with the selected category ID
        $('#category_id').val(selectedCategoryId);
    });

    $('#addevent').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();
    
        // Ensure the hidden category_id field has a value before submission
        var categoryId = $('#category_id').val();
        if (!categoryId) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Please select a category before submitting the form.',
            });
            return;
        }

        // Enable any potentially disabled input fields
        $('#addevent').find('input, textarea, select').prop('disabled', false);
    
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '/organizer/addevent/insert',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                // Show loading effect
                Swal.fire({
                    title: 'Saving...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response) {
                if (response.success) {
                    // Reset form fields
                    $('#addevent')[0].reset();
                    $('#eventdescription').summernote('reset');
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    }).then(() => {
                        // Redirect after successful submission
                        window.location.href = response.redirect;
                    });
                } else {
                    // Handle server-side validation errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning',
                        text: response.message || 'Please correct the highlighted fields and try again.',
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX errors
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred. Please try again later.',
                });
                console.error(xhr.responseText);
            }
        });
    });
});
</script>