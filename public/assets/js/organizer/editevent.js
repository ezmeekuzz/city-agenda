const fileSelectBtn = document.getElementById('fileSelectBtn');
const eventBanner = document.getElementById('eventbanner');
const uploadArea = document.getElementById('uploadArea');

// Trigger file input on button click
fileSelectBtn.addEventListener('click', () => {
    eventBanner.click();
});

// Handle file selection
eventBanner.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Set the selected image as the background
            uploadArea.style.backgroundImage = `url(${e.target.result})`;
            uploadArea.style.backgroundSize = 'cover';
            uploadArea.style.backgroundPosition = 'center';
            uploadArea.style.backgroundRepeat = 'no-repeat';
        };
        reader.readAsDataURL(file);
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const singleEventRadio = document.getElementById('singleEvent');
    const recurringEventRadio = document.getElementById('recurringEvent');
    const recurrenceOptions = document.getElementById('recurrenceOptions');

    const dateField = document.getElementById('dateField');
    const startTimeField = document.getElementById('startTimeField');
    const endTimeField = document.getElementById('endTimeField');

    function toggleRecurrenceOptions() {
        if (recurringEventRadio.checked) {
            recurrenceOptions.style.display = 'block';
            dateField.classList.replace('col-md-4', 'col-md-3');
            startTimeField.classList.replace('col-md-4', 'col-md-3');
            endTimeField.classList.replace('col-md-4', 'col-md-3');
        } else {
            recurrenceOptions.style.display = 'none';
            dateField.classList.replace('col-md-3', 'col-md-4');
            startTimeField.classList.replace('col-md-3', 'col-md-4');
            endTimeField.classList.replace('col-md-3', 'col-md-4');
        }
    }

    singleEventRadio.addEventListener('change', toggleRecurrenceOptions);
    recurringEventRadio.addEventListener('change', toggleRecurrenceOptions);

    // Initialize the display based on the default selected option
    toggleRecurrenceOptions();

    $('#eventdescription').summernote({
        toolbar: [
            ['style', ['style']],
            ['fontsize', ['fontsize']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['picture', 'hr']],
            ['table', ['table']]
        ],
        tabsize: 2,
        height: 250,
        fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
        followingToolbar: false
    });
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
    document.getElementById('addSlotBtn').addEventListener('click', function() {
        const slotContainer = document.getElementById('slotsContainer');
        const slotCount = slotContainer.children.length + 1;
    
        const slotItem = document.createElement('div');
        slotItem.classList.add('slot-item', 'mt-3');
    
        slotItem.innerHTML = `
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
            <button type="button" class="btn btn-danger btn-sm mt-2 remove-slot">Delete Slot</button>
        `;
    
        slotContainer.appendChild(slotItem);
    
        slotItem.querySelector('.remove-slot').addEventListener('click', function() {
            slotItem.remove();
        });
    });
    
    document.getElementById('addSpeakerBtn').addEventListener('click', function() {
        const speakersContainer = document.getElementById('speakersContainer');
        const speakerItem = document.createElement('div');
        speakerItem.classList.add('speaker-item', 'mt-3');
        speakerItem.innerHTML = `
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
                <input type="file" name="speakerImage[]" class="form-control">
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
            <button type="button" class="btn btn-danger btn-sm mt-2 remove-speaker">Delete Speaker</button>
        `;
        speakersContainer.appendChild(speakerItem);
    
        speakerItem.querySelector('.remove-speaker').addEventListener('click', function() {
            speakerItem.remove();
        });
    });
    
    document.getElementById('addSponsorBtn').addEventListener('click', function() {
        const sponsorsContainer = document.getElementById('sponsorsContainer');
        const sponsorItem = document.createElement('div');
        sponsorItem.classList.add('sponsor-item', 'mt-3');
        sponsorItem.innerHTML = `
            <div class="form-group">
                <label for="sponsorDescription">General Description</label>
                <textarea name="sponsorDescription[]" class="form-control" placeholder="Enter General Description"></textarea>
            </div>
            <div class="form-group">
                <label for="sponsorLogo">Sponsor Logo</label>
                <input type="file" name="sponsorLogo[]" class="form-control">
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-2 remove-sponsor">Delete Sponsor</button>
        `;
        sponsorsContainer.appendChild(sponsorItem);
    
        sponsorItem.querySelector('.remove-sponsor').addEventListener('click', function() {
            sponsorItem.remove();
        });
    });
    
    document.getElementById('addFaqBtn').addEventListener('click', function() {
        const faqContainer = document.getElementById('faqContainer');
        const faqItem = document.createElement('div');
        faqItem.classList.add('faq-item', 'mt-3');
        faqItem.innerHTML = `
            <div class="form-group">
                <label for="question">Question</label>
                <input type="text" name="question[]" class="form-control" placeholder="Enter Question">
            </div>
            <div class="form-group">
                <label for="answer">Answer</label>
                <textarea name="answer[]" class="form-control" placeholder="Enter Answer"></textarea>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-2 remove-faq">Delete FAQ</button>
        `;
        faqContainer.appendChild(faqItem);
    
        faqItem.querySelector('.remove-faq').addEventListener('click', function() {
            faqItem.remove();
        });
    });     
});
let map;
let marker;
let geocoder;

function initMap() {
    // Initialize the map centered on a default location
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 13,
        center: { lat: 40.712776, lng: -74.005974 } // Default to New York City
    });

    // Initialize the marker
    marker = new google.maps.Marker({
        map: map,
        draggable: true
    });

    // Initialize the geocoder
    geocoder = new google.maps.Geocoder();

    // Add an event listener for the location input
    document.getElementById("locationname").addEventListener("input", function () {
        let address = this.value;
        if (address.length > 3) { // Start searching after typing more than 3 characters
            geocodeAddress(geocoder, map, marker, address);
        }
    });

    // Automatically geocode the address if the input has a value on page load
    const address = document.getElementById('locationname').value;
    if(address !== null && address !== "") {
        geocodeAddress(geocoder, map, marker, address);
    }

    // Add event listener to update the map on marker drag
    google.maps.event.addListener(marker, 'dragend', function () {
        map.panTo(marker.getPosition());
    });
}

// Function to geocode an address and place a marker on the map
function geocodeAddress(geocoder, resultsMap, marker, address) {
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            marker.setPosition(results[0].geometry.location);
        } else {
            console.log('Geocode was not successful for the following reason: ' + status);
        }
    });
}

// Initialize the map when the window loads
window.onload = function() {
    initMap();
};
$(document).ready(function () {
    $('#addevent').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();
    
        // Enable any potentially disabled input fields
        $('#addevent').find('input, textarea, select').prop('disabled', false);
    
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '/organizer/editevent/update',
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
                        window.location.reload();
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
