<?=$this->include('templates/header');?>
<style>
    i.bi.bi-arrow-left-short, i.bi.bi-arrow-right-short{
        font-size: 50px;
        height: auto!important;
        width: auto!important;
        vertical-align: -10px!important;
    }
    .carousel-control-section{
        position: relative;
        width: 170px;
        display: flex;
        justify-content: space-between;
    }
    .card-bottom div p {
        margin: 0px!important;
    }
    .card-bottom div i{
        height: 1.8em!important;
    }
    .carousel-control-next, .carousel-control-prev{
        background-color: #741774;
        height: 70px;
        width: 70px;
        position: relative!important;
        border-radius: 50px;
    }
    .politics-grid-section .carousel{
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    @media screen and (min-width:576px) {
        .carousel-inner{
            display:flex;
        }
        .carousel-item{
            display: block;
            margin-right:0;
            flex: 0 0 calc(100%/3);
        } 
    }
    .card{
    box-shadow: 0px 0px 5px #0000003b;
    border: 0px;
    margin: 0 10px;
    width: 95%;
    }
    .card-img{
        width: 100%;
    }
</style>
<section class="container-fluid banner business">
    <div class="container d-flex flex-column align-items-center gap-5">
        <img class="banner-img" src="<?=$categoryDetails['categoryimage'];?>">
    </div>
</section>
    <section class="container-fluid politics-grid-section main-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 gap-3 d-flex flex-column mb-4 mb-lg-0">
                    <h2>Popular <?=$category;?> Events <span class="locationFilter"></span>  </h2>
                    <div class="col-lg-7 col-md-12 row">
                        <div class="col-md-6 drop-cards d-flex flex-column justify-content-center gap-2 mb-4 mb-lg-0">
                            <h4>Search City</h4>
                            <div class="dropdown">
                                <div class="input-group">
                                    <input style="box-shadow: 0px 0px 5px #00000056 !important; height: 60px;" type="text" class="form-control" placeholder="Search City" id="city">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 drop-cards d-flex flex-column justify-content-center gap-2 mb-4 mb-lg-0">
                            <h4>Select Date</h4>
                            <div class="dropdown">
                                <div class="input-group date" id="datepicker">
                                    <input style="box-shadow: 0px 0px 5px #00000056 !important" type="text" class="form-control" placeholder="Select Date">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">
                                            <i class="bi bi-calendar-event"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 pt-lg-0 pt-md-4 gap-3 d-flex justify-content-around align-items-start align-items-lg-center flex-column">
                    <a href="mailto:" class="email-btn">
                        <i class="bi bi-envelope-fill"></i>
                        Get updated by email
                    </a>
                    <div class="carousel-control-section">
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <i class="bi bi-arrow-left-short"></i>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <i class="bi bi-arrow-right-short"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="events-container">
            
        </div>
    </section>



    <section class="container-fluid find-free-political-section main-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 gap-4 d-flex align-items-center">
                    <h2>Find Free <?=$category;?> Events <span class="locationFilter"></span></h2>
                </div>
                <div class="col-lg-3 col-md-12 pt-lg-0 pt-md-4 gap-3 d-flex justify-content-around align-items-lg-end align-items-start flex-column">
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
        <div class="row" id="free-events-container">
            
        </div>
    </section>




    <section class="container-fluid event-formats-section main-section">
        <div class="container">
            <h2>Explore <?=$category;?> Event Formats</h2>
            <div class="row event-formats-cats mt-5">
                <div class="col-lg-3 col-md-4 col-sm-12 p-3">
                    <img src="img/eb-event-img.png">
                    <a href="#" class="catLink">Conference</a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12  p-3">
                    <img src="img/eb-event-img1.png">
                    <a href="#" class="catLink">Seminars</a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12  p-3">
                    <img src="img/eb-event-img2.png">
                    <a href="#" class="catLink">Expos</a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12  p-3">
                    <img src="img/eb-event-img3.png">
                    <a href="#" class="catLink">Conventions</a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12  p-3">
                    <img src="img/eb-event-img4.png">
                    <a href="#" class="catLink">Festivals</a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12  p-3">
                    <img src="img/eb-event-img5.png">
                    <a href="#" class="catLink">Performance</a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12  p-3">
                    <img src="img/eb-event-img6.png">
                    <a href="#" class="catLink">Screenings</a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12  p-3">
                    <img src="img/eb-event-img7.png">
                    <a href="#" class="catLink">Galas</a>
                </div>
            </div>
        </div>
    </section>





    <section class="container-fluid miss-out-popular-section main-section">
        <div class="container">
            <div class="row">
                <div class="col-md-9 gap-4 d-flex align-items-center">
                    <h2>Don’t Miss Out Popular Events <span class="locationFilter"></span> </h2>
                </div>
                <div class="col-lg-3 col-md-12 pt-lg-0 pt-md-4 gap-3 d-flex justify-content-around align-items-lg-end align-items-start flex-column">
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
        <div class="row" id="popular-events-container">
            
        </div>
    </section>


    <section class="container-fluid category-sec">
        <div class="container">
            <div class="category-content">
                <h2 class="mb-4">Discover Top Categories</h2>
                <div class="d-flex category-section">
                    <?php if($topCategories) : ?>
                    <?php foreach($topCategories as $list) : ?>
                    <a href="<?=$list['slug'];?>"><img src="/<?=$list['categoryimage'];?>" alt="<?=$list['categoryimage'];?>"></a>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?=$this->include('templates/footer');?>
<script>
    $(document).ready(function() {
        var selectedCategory = "<?=$category;?>";
        var selectedLocation = '';
        var selectedDate = '';

        // Initialize datepicker with the correct format
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',  // Ensure this format is 'yyyy-mm-dd'
            autoclose: true
        }).on('changeDate', function(e) {
            // Get the selected date in the proper format
            selectedDate = $('#datepicker').datepicker('getFormattedDate');
            console.log("Selected Date: ", selectedDate);  // Add logging for debugging
            loadEvents();  // Load events based on the selected date
        });

        // Handle location selection
        $('#city').on('input', function() {
            selectedLocation = $(this).val();  // Get the city name from the input field
            updateCityAndEvents(selectedLocation);
        });

        // Initialize Google Places Autocomplete and trigger events when a city is selected
        function initAutocomplete() {
            // Initialize Google Places Autocomplete with restrictions to cities
            const autocomplete = new google.maps.places.Autocomplete(
                document.getElementById('city'),  // Ensure the input field ID matches
                { types: ['(cities)'] } // Restrict to cities only
            );

            // Add event listener when a place is selected
            autocomplete.addListener('place_changed', function () {
                const place = autocomplete.getPlace();

                // Loop through address components to extract only the city (locality)
                const addressComponents = place.address_components;
                let city = '';

                for (let i = 0; i < addressComponents.length; i++) {
                    const component = addressComponents[i];
                    if (component.types.includes('locality')) {
                        city = component.long_name; // Extract the city name
                        break; // Stop once we get the city
                    }
                }

                // Set the city in the input field
                if (city) {
                    document.getElementById('city').value = city;
                    // Trigger the search function manually after selecting a city from autocomplete
                    updateCityAndEvents(city);  
                } else {
                    document.getElementById('city').value = ''; // Clear if no city found
                    alert("Please select a valid city.");
                }
            });
        }

        // Function to update the city and load events
        function updateCityAndEvents(city) {
            $('#selected-location').text(city);  // Update the selected location text
            $('.locationFilter').text('In ' + city);  // Update the filter label with the city name

            // Reload the events based on the new city
            loadEvents();          // Regular events
            loadEvents('free');    // Free events
            loadEvents('popular'); // Popular events
        }

        // Initialize autocomplete when the page loads
        window.onload = initAutocomplete;
        function loadEvents(type = '') {
            let url = '/events/getEvents'; // Endpoint to get events
            let data = {
                category: selectedCategory,
                location: selectedLocation,
                date: selectedDate
            };

            // Add a ticket filter for free or popular events if necessary
            if (type === 'free') {
                data.ticket = "Free";
            }

            let containerId = '#events-container'; // Default container

            // Adjust container based on event type
            if (type === 'free') {
                containerId = '#free-events-container';
            } else if (type === 'popular') {
                containerId = '#popular-events-container';
            }

            $.ajax({
                url: url,
                method: 'GET',
                data: data,
                success: function(response) {
                    let container = $(containerId);
                    container.empty();  // Clear previous events

                    if (response.status === 'success') {
                        let events = response.data;
                        
                        // Show message if no events are found
                        if (events.length === 0) {
                            container.html(`
                                <center><img src="img/page-not-found.png" alt="No Events Found"></center>
                                <center><h1 style="color: #741774;">No ${type ? type.charAt(0).toUpperCase() + type.slice(1) : ''} Events Found</h1></center>
                            `);
                            return;
                        }

                        // Loop through events and generate HTML
                        events.forEach(function(event) {
                            const isFavoritedClass = event.is_favorited ? 'active' : '';
                            let eventHTML = `
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card">
                                    <a href="/profile/${event.user_id}">
                                        <img class="user-id img-fluid" src="${event.image}" alt="User" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; margin: 10px;">
                                    </a>
                                    <img src="${event.eventbanner}" class="img-fluid" style="max-height: 250px; object-fit: cover;" alt="${event.eventname}">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <a href="${event.slug}" style="text-decoration: none; color: black; flex-grow: 1;">
                                                <h4 style="font-size: 1.2rem;">${event.eventname}</h4>
                                            </a>
                                            <button class="heart-button ml-auto" onclick="toggleFavorite(this, ${event.event_id})" style="border: none; background: transparent;">
                                                <i class="bi bi-suit-heart-fill heartIcon ${isFavoritedClass}" style="font-size: 1.5rem; color: red;"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-bottom p-2">
                                        <div class="d-flex align-items-center">
                                            <p class="ml-2">${event.city} <br><span>${event.locationname}</span></p>
                                        </div>
                                        <hr>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clock-fill"></i>
                                            <p class="ml-2">${formatDate(event.eventdate)}<br><span>${formatTime(event.eventstartingtime)}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            container.append(eventHTML);
                        });
                    } else {
                        // Show error message if needed
                        container.html(`
                            <center><img src="img/page-not-found.png" alt="No Events Found"></center>
                            <center><h1 style="color: #741774;">No Events Found</h1></center>
                        `);
                    }
                },
                error: function() {
                    $(containerId).html('<p>Error loading events</p>');
                }
            });
        }

        // Initial load calls for different event types
        loadEvents(); // Regular events
        loadEvents('free'); // Free events
        loadEvents('popular'); // Popular events

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