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
    .city-banner {
        width: 100%;
        height: 100vh   ; /* Adjust height as needed */
        background-image: url('img/citybanner.png'); /* Use the provided image path */
        background-position: center;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }
    .city-banner h1 {
        color: white;
        font-size: 48px;
        position: absolute;
        font-family: 'Copperplate Gothic Bold', serif;
        font-size: 90px !important;
        background: linear-gradient(45deg, #DAA520, #FFD700, #b8860b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        /* text-shadow: 2px 2px 4px rgba(0,0,0,0.4), -1px -1px 4px rgba(255,255,255,0.2); */
        letter-spacing: 2px;
    }
</style>
<div class="city-banner">
    <div class="overlay"></div>
    <h1 class="hello"><?=$city;?></h1>
</div>
<section class="container-fluid politics-grid-section main-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 gap-4 d-flex flex-column mb-2 mb-lg-0">
                <h2>Events in <?=$city?> </h2>
                <div class="col-lg-7 col-md-12 row">
                    <div class="col-md-6 drop-cards d-flex flex-column justify-content-center gap-2 mb-4 mb-lg-0">
                        <h4>Select Date</h4>
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
            <div class="col-lg-3 col-md-12 pt-lg-0 pt-md-4 gap-3 d-flex justify-content-around align-items-end align-items-lg-center flex-column">
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
<?=$this->include('templates/footer');?>
<script>
    $(document).ready(function(){
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',  // Ensure the format matches the backend's expected format
            autoclose: true
        }).on('changeDate', function(e) {
            // Get the selected date value when date changes
            selectedDate = $('#datepicker').datepicker('getFormattedDate');
            loadEvents();  // Load events based on the selected date
        });
    });
    function loadEvents() {
        // Get the selected date from datepicker, if set
        let selectedDate = $('#datepicker').datepicker('getFormattedDate') || '';
        let location = "<?=$city;?>";
        
        if (selectedDate) {
            selectedDate = formatDateToYMD(selectedDate);  // Convert to yyyy-mm-dd
        }

        // Show loading spinner or message
        let eventsContainer = $('#events-container');
        eventsContainer.html('<center> <img src="img/page-not-found.png" alt=""></center><center><h1 style="color: #741774;">Loading Events...</h1></center>');

        $.ajax({
            url: '/getEvents',  // Endpoint to get events
            method: 'GET',
            data: {
                location: location,  // Pass selected location
                date: selectedDate   // Pass selected date
            },
            success: function(response) {
                eventsContainer.empty();  // Clear previous events

                if (response.length > 0) {
                    // Loop through the events and create HTML for each one
                    response.forEach(function(event) {
                        const isFavoritedClass = event.is_favorited ? 'active' : '';

                        let eventHTML = `
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card" style="width: 100%;">
                                <img class="user-id" src="${event.image || 'img/user-img.png'}" alt="User">
                                <i class="bi bi-suit-heart-fill heartIcon ${isFavoritedClass}"></i>
                                <img src="${event.eventbanner || 'img/bird-thumbnail.jpg'}" style="height: 382px; object-fit: cover;" alt="${event.eventname}">
                                <div class="card-body">
                                    <a href="${event.slug}" style="text-decoration: none; color: black;">
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
                        eventsContainer.append(eventHTML);  // Append event HTML
                    });
                } else {
                    // Display a message if no events are found
                    eventsContainer.html(`
                        <center><img src="img/page-not-found.png" alt="No Events Found"></center>
                        <center><h1 style="color: #741774;">No Events Found</h1></center>
                    `);
                }
            },
            error: function() {
                eventsContainer.html('<p>Error loading events</p>');  // Error message
            }
        });
    }

    // Call the function to load events on page load or based on user input
    loadEvents();
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
    function formatDateToYMD(dateStr) {
        const [month, day, year] = dateStr.split('/');
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
    }
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