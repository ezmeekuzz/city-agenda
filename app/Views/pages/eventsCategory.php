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
                            <h4>Select Location</h4>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span id="selected-location">My Location</span>
                                </button>
                                <ul class="dropdown-menu" id="location-dropdown">
                                <?php if($cityList) : ?>
                                <?php foreach($cityList as $list) : ?>
                                    <li><a class="dropdown-item" data-location="<?=$list['cityname'];?>"><?=$list['cityname'];?></a></li>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                </ul>
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
        $('#location-dropdown a').on('click', function() {
            selectedLocation = $(this).data('location');  // Update the selected location
            $('#selected-location').text($(this).text());  // Update location text
            $('.locationFilter').text('In ' + $(this).text());  // Update location text
            loadEvents();  // Reload events based on the new location
            loadFreeEvents();  // Reload events based on the new location
            loadPopularEvents();
        });

        function loadEvents() {
            // Pass the selected date, category, and location directly via AJAX
            $.ajax({
                url: '/events/getEvents',  // Endpoint to get events
                method: 'GET',
                data: {
                    category: selectedCategory,  // Pass selected category
                    location: selectedLocation,  // Pass selected location
                    date: selectedDate,          // Pass selected date
                },
                success: function(response) {
                    let eventsContainer = $('#events-container');
                    eventsContainer.empty();  // Clear the previous events

                    // Check if the response was successful
                    if (response.status === 'success') {
                        // Get event data
                        let events = response.data;

                        // If no events found, show a message
                        if (events.length === 0) {
                            eventsContainer.html(`
                                <center><img src="img/page-not-found.png" alt=""></center>
                                <center><h1 style="color: #741774;">No Events Found</h1></center>
                            `);
                            return;
                        }

                        // Loop through the events and create HTML for each one
                        events.forEach(function(event) {
                            const isFavoritedClass = event.is_favorited ? 'active' : '';
                            let eventHTML = `
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card" style="width: 100%;">
                                    <img class="user-id" src="${event.image}" alt="User">
                                    <i class="bi bi-suit-heart-fill heartIcon ${isFavoritedClass}"></i>
                                    <img src="${event.eventbanner}" style="height: 382px; object-fit: cover;" alt="${event.eventname}">
                                    <div class="card-body">
                                        <a href="${event.sl}" style="text-decoration: none; color: black;">
                                            <h3>${event.eventname}</h3>
                                        </a>
                                    </div>
                                    <div class="card-bottom">
                                        <div class="d-flex align-items-center">
                                            <button class="heart-button" onclick="toggleFavorite(this, ${event.event_id})">
                                                <i class="bi bi-suit-heart-fill heartIcon ${isFavoritedClass}"></i>
                                            </button>
                                            <p>
                                                ${event.cityname} <br>
                                                <span>${event.locationname}</span>
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clock-fill"></i>
                                            <p>
                                                ${formatDate(event.eventdate)}<br>
                                                <span>${formatTime(event.eventstartingtime)}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            eventsContainer.append(eventHTML);
                        });
                    } else {
                        // If no events found or error status, display an error message
                        eventsContainer.html(`
                            <center><img src="img/page-not-found.png" alt=""></center>
                            <center><h1 style="color: #741774;">No Events Found</h1></center>
                        `);
                    }
                },
                error: function() {
                    $('#events-container').html('<p>Error loading events</p>');
                }
            });
        }

        // Initial load of events
        loadEvents();
    
        function loadFreeEvents() {
            $.ajax({
                url: '/events/getEvents',  // Endpoint to get events
                method: 'GET',
                data: {
                    category: selectedCategory,  // Pass selected category
                    location: selectedLocation,  // Pass selected location
                    date: selectedDate,          // Pass selected date
                    ticket: "Free"               // Only load free events
                },
                success: function(response) {
                    let eventsFreeContainer = $('#free-events-container');
                    eventsFreeContainer.empty();  // Clear previous events

                    // Check if the response was successful
                    if (response.status === 'success') {
                        let events = response.data;

                        // If no events are found, display a message
                        if (events.length === 0) {
                            eventsFreeContainer.html(`
                                <center><img src="img/page-not-found.png" alt="No Events Found"></center>
                                <center><h1 style="color: #741774;">No Free Events Found</h1></center>
                            `);
                            return;
                        }

                        // Loop through the events and create HTML for each one
                        events.forEach(function(event) {
                            const isFavoritedClassFree = event.is_favorited ? 'active' : '';
                            let eventFreeHTML = `
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card" style="width: 100%;">
                                    <img class="user-id" src="${event.image}" alt="User">
                                    <i class="bi bi-suit-heart-fill heartIcon ${isFavoritedClassFree}"></i>
                                    <img src="${event.eventbanner}" style="height: 382px; object-fit: cover;" alt="${event.eventname}">
                                    <div class="card-body">
                                        <a href="${event.slug}" style="text-decoration: none; color: black;">
                                            <h3>${event.eventname}</h3>
                                        </a>
                                    </div>
                                    <div class="card-bottom">
                                        <div class="d-flex align-items-center">
                                            <button class="heart-button" onclick="toggleFavorite(this, ${event.event_id})">
                                                <i class="bi bi-suit-heart-fill heartIcon ${isFavoritedClassFree}"></i>
                                            </button>
                                            <p>
                                                ${event.cityname} <br>
                                                <span>${event.locationname}</span>
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clock-fill"></i>
                                            <p>
                                                ${formatDate(event.eventdate)}<br>
                                                <span>${formatTime(event.eventstartingtime)}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            eventsFreeContainer.append(eventFreeHTML);
                        });
                    } else {
                        // If no free events found, show a default message
                        eventsFreeContainer.html(`
                            <center><img src="img/page-not-found.png" alt="No Free Events Found"></center>
                            <center><h1 style="color: #741774;">No Free Events Found</h1></center>
                        `);
                    }
                },
                error: function() {
                    $('#free-events-container').html('<p>Error loading free events</p>');
                }
            });
        }

        // Initial load of free events
        loadFreeEvents();
        
        function loadPopularEvents() {
            $.ajax({
                url: '/events/getEvents',  // Endpoint to get events
                method: 'GET',
                data: {
                    category: selectedCategory,  // Pass selected category
                    location: selectedLocation,  // Pass selected location
                    date: selectedDate
                },
                success: function(response) {
                    let eventsPopularContainer = $('#popular-events-container');
                    eventsPopularContainer.empty();  // Clear previous events

                    // Check if the response was successful
                    if (response.status === 'success') {
                        let events = response.data;

                        // If no events are found, display a message
                        if (events.length === 0) {
                            eventsPopularContainer.html(`
                                <center><img src="img/page-not-found.png" alt="No Events Found"></center>
                                <center><h1 style="color: #741774;">No Popular Events Found</h1></center>
                            `);
                            return;
                        }

                        // Loop through the events and create HTML for each one
                        events.forEach(function(event) {
                            const isFavoritedClassPopular = event.is_favorited ? 'active' : '';
                            let eventPopularHTML = `
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card" style="width: 100%;">
                                    <img class="user-id" src="${event.image}" alt="User">
                                    <i class="bi bi-suit-heart-fill heartIcon ${isFavoritedClassPopular}"></i>
                                    <img src="${event.eventbanner}" style="height: 382px; object-fit: cover;" alt="${event.eventname}">
                                    <div class="card-body">
                                        <a href="${event.slug}" style="text-decoration: none; color: black;">
                                            <h3>${event.eventname}</h3>
                                        </a>
                                    </div>
                                    <div class="card-bottom">
                                        <div class="d-flex align-items-center">
                                            <button class="heart-button" onclick="toggleFavorite(this, ${event.event_id})">
                                                <i class="bi bi-suit-heart-fill heartIcon ${isFavoritedClassPopular}"></i>
                                            </button>
                                            <p>
                                                ${event.cityname} <br>
                                                <span>${event.locationname}</span>
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clock-fill"></i>
                                            <p>
                                                ${formatDate(event.eventdate)}<br>
                                                <span>${formatTime(event.eventstartingtime)}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            eventsPopularContainer.append(eventPopularHTML);
                        });
                    } else {
                        // If no free events found, show a default message
                        eventsPopularContainer.html(`
                            <center><img src="img/page-not-found.png" alt="No Popular Events Found"></center>
                            <center><h1 style="color: #741774;">No Popular Events Found</h1></center>
                        `);
                    }
                },
                error: function() {
                    $('#popular-events-container').html('<p>Error loading popular events</p>');
                }
            });
        }

        // Initial load of free events
        loadPopularEvents();

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