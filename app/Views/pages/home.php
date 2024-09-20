<?=$this->include('templates/header');?>

<section class="container-fluid banner">
    <div class="container d-flex flex-column align-items-center gap-5">
        <img class="banner-img" src="img/bannerImg.png">
        <form class="container banner-form" method="GET" action="/events">
            <div class="d-flex gap-3  flex-md-row">
                <div class="search-input">
                    <i class="bi bi-geo-alt-fill"></i>
                    <input type="text" placeholder="Enter city name" name="city">
                </div>
                <button class="search-toggle">
                    <i class="bi bi-search"></i>
                    <span class="search-text">Explore</span>
                </button>
            </div>
        </form>
    </div>
</section>
<section class="container-fluid category-sec">
    <div class="container">
        <div class="category-content">
            <h2 class="mb-4">Discover Top Categories</h2>
            <div class="position-relative">
                <div class="category-section d-flex overflow-hidden">
                    <div class="category-slider d-flex">
                        <?php if($topCategories) : ?>
                        <?php foreach($topCategories as $list) : ?>
                        <a href="<?=$list['slug'];?>"><img src="/<?=$list['categoryimage'];?>" alt="<?=$list['categoryimage'];?>"></a>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="slider-controls d-flex justify-content-center mt-3">     
                    <button class="slider-nav slider-nav-left  bi-arrow-left-short" onclick="slideLeft()"></button>
                    <button class="slider-nav slider-nav-right  bi-arrow-right-short" onclick="slideRight()"></button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid event-section justify-content-center">
    <div class="container">
        <div class="row mb-5 container-fluid m-auto p-0">
            <div class="col-lg-4 col-md-12 event-title col-sm-12">
                <h2>Popular Events In </h2>
                <div class="d-flex gap-4 subs-title align-items-center">
                    <h3></h3><img src="img/note-Icon.png">
                </div>
            </div>
            <div class="col-lg-8 col-md-12 mt-4 mt-lg-0 d-flex gap-4 flex-column flex-md-row">
                <div class="drop-cards d-flex flex-column justify-content-center">
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
                <div class="drop-cards d-flex flex-column justify-content-center">
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
                <div class="drop-cards d-flex flex-column justify-content-center">
                    <h4>Select Category</h4>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </button>
                        <ul class="dropdown-menu" id="category-dropdown">
                        <?php if($categoryList) : ?>
                        <?php foreach($categoryList as $list) : ?>
                            <li><a class="dropdown-item" data-category="<?=$list['categoryname'];?>"><?=$list['categoryname'];?></a></li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="events-container">
        
    </div>
</section>
<section class="container-fluid big-event-section">
    <div class="container bot-slider-sec">
        <h2>Find Big Events In Any City</h2>
        <form class="container banner-form big-event-search" method="GET" action="/events">
            <div class="d-flex gap-3  flex-md-row">
                <div class="search-input">
                    <i class="bi bi-geo-alt-fill"></i>
                    <input type="text" placeholder="Enter city name" name="city">
                </div>
                <button class="search-toggle">
                    <i class="bi bi-search"></i>
                    <span class="search-text">Explore</span>
                </button>
            </div>
        </form>
        <div class="slider-section bottom-slider-sec">
            <div class="slider">
                <div class="slide" data-city="Denver">
                    <img src="img/denver.png" alt="Denver">
                    <h3>Denver</h3>
                </div>
                <div class="slide" data-city="Baltimore">
                    <img src="img/baltimore.png" alt="Baltimore">
                    <h3>Baltimore</h3>
                </div>
                <div class="slide" data-city="Austin">
                    <img src="img/austin.png" alt="Austin">
                    <h3>Austin</h3>
                </div>
                <div class="slide" data-city="Jacksonville">
                    <img src="img/jacksonville.png" alt="Jacksonville">
                    <h3>Jacksonville</h3>
                </div>
                <div class="slide" data-city="San Antonio">
                    <img src="img/san-antonio.png" alt="San Antonio">
                    <h3>San Antonio</h3>
                </div>
                <div class="slide" data-city="Denver">
                    <img src="img/denver.png" alt="Denver">
                    <h3>Denver</h3>
                </div>
                <div class="slide" data-city="Baltimore">
                    <img src="img/baltimore.png" alt="Baltimore">
                    <h3>Baltimore</h3>
                </div>
                <div class="slide" data-city="Austin">
                    <img src="img/austin.png" alt="Austin">
                    <h3>Austin</h3>
                </div>
                <div class="slide" data-city="Jacksonville">
                    <img src="img/jacksonville.png" alt="Jacksonville">
                    <h3>Jacksonville</h3>
                </div>
                <div class="slide" data-city="San Antonio">
                    <img src="img/san-antonio.png" alt="San Antonio">
                    <h3>San Antonio</h3>
                </div>
            </div>
        </div>
        <button class="prev"><i class="bi bi-arrow-left-short"></i></button>
        <button class="next"><i class="bi bi-arrow-right-short"></i></button>
    </div>
</section>
<?=$this->include('templates/footer');?>
<script>
    $(document).ready(function() {
        var selectedCategory = '';
        var selectedLocation = '';
        var selectedDate = '';

        // Initialize datepicker with the correct format and attach the change event
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',  // Ensure the format matches the backend's expected format
            autoclose: true
        }).on('changeDate', function(e) {
            // Get the selected date value when date changes
            selectedDate = $('#datepicker').datepicker('getFormattedDate');
            loadEvents();  // Load events based on the selected date
        });
        // Handle category selection
        $('#category-dropdown a').on('click', function() {
            selectedCategory = $(this).data('category');  // Update the selected category
            $(this).closest('.dropdown').find('.dropdown-toggle').text($(this).text());  // Set the dropdown button text
            loadEvents();  // Reload events based on the new category
        });

        // Handle location selection
        $('#location-dropdown a').on('click', function() {
            selectedLocation = $(this).data('location');  // Update the selected location
            $('#selected-location').text($(this).text());  // Update location text

            if (selectedLocation) {
                $('.event-title h3').text(selectedLocation);  // Update the event title with city name
                $('.event-title').show();  // Show the Popular Events section
            } else {
                $('.event-title').hide();  // Hide if no location is selected
            }
            loadEvents();  // Reload events based on the new location
        });

        var slider = $('.slider');
        var slides = $('.slide');
        var totalSlides = slides.length;
        var currentIndex = 0;

        function getVisibleItems() {
            if (window.innerWidth <= 768) {
                return 1;  // Mobile: 1 item visible
            } else if (window.innerWidth <= 1024) {
                return 3;  // Tablet: 3 items visible
            } else {
                return 5;  // Default: 5 items visible
            }
        }

        var visibleItems = getVisibleItems();
        currentIndex = visibleItems;  // Start after the first duplicated set

        // Clone the first and last few slides to make it seamless
        slides.slice(0, visibleItems).clone().appendTo(slider);  // Clone first few slides and add to the end
        slides.slice(-visibleItems).clone().prependTo(slider);  // Clone last few slides and add to the beginning

        // Update total slides count after cloning
        totalSlides = $('.slide').length;

        function updateSliderPosition(instant = false) {
            var offset = -currentIndex * (100 / visibleItems); // Adjust offset based on visible items
            slider.css('transition', instant ? 'none' : 'transform 0.5s ease');
            slider.css('transform', 'translateX(' + offset + '%)');
            setActiveClass();
        }

        function setActiveClass() {
            $('.slide').removeClass('active next-to-active prev-to-active');
            var centerIndex = currentIndex + Math.floor(visibleItems / 2);
            var prevIndex = centerIndex - 1;
            var nextIndex = centerIndex + 1;

            // Add classes to active and adjacent items
            $($('.slide')[centerIndex]).addClass('active');
            if (prevIndex >= 0) {
                $($('.slide')[prevIndex]).addClass('prev-to-active');
            }
            if (nextIndex < totalSlides) {
                $($('.slide')[nextIndex]).addClass('next-to-active');
            }
        }

        $('.next').click(function() {
            currentIndex++;
            updateSliderPosition();

            if (currentIndex === totalSlides - visibleItems) {
                // If we've reached the end of the cloned slides, jump back to the original start
                setTimeout(function() {
                    currentIndex = visibleItems; // Jump to the first real slide
                    updateSliderPosition(true);  // Instant transition
                }, 500);  // Same duration as the CSS transition
            }
        });

        $('.prev').click(function() {
            currentIndex--;
            updateSliderPosition();

            if (currentIndex === 0) {
                // If we've reached the start of the cloned slides, jump to the original end
                setTimeout(function() {
                    currentIndex = totalSlides - (2 * visibleItems); // Jump to the last real slide
                    updateSliderPosition(true);  // Instant transition
                }, 500);  // Same duration as the CSS transition
            }
        });

        // Update slider position on resize
        $(window).resize(function() {
            visibleItems = getVisibleItems();
            currentIndex = visibleItems;  // Reset the index when resizing
            updateSliderPosition(true);  // Instant transition to the correct position
        });

        // Initialize
        updateSliderPosition(true);  // Start with an instant transition to avoid animation on page load

        function loadEvents() {
            // Get the selected date from datepicker, if not already set
            let selectedDate = $('#datepicker').datepicker('getFormattedDate') || '';
            if (selectedDate) {
                selectedDate = formatDateToYMD(selectedDate);  // Convert to yyyy-mm-dd
            }
            $.ajax({
                url: '/getEvents',  // Endpoint to get events
                method: 'GET',
                data: {
                    category: selectedCategory,  // Pass selected category
                    location: selectedLocation,  // Pass selected location
                    date: selectedDate           // Pass selected date
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
                            <div class="card" style="width: 100%;">
                                <img class="user-id" src="${event.image}" alt="User">
                                <i class="bi bi-suit-heart-fill heartIcon ${isFavoritedClass}"></i>
                                <img src="${event.eventbanner}" style="height: 382px; object-fit: cover;" alt="${event.eventname}">
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
                        eventsContainer.append(eventHTML);  // Append the event HTML to the container
                    });
                },
                error: function() {
                    $('#events-container').html('<p>Error loading events</p>');  // Show error message
                }
            });
        }
        function formatDateToYMD(dateStr) {
            const [month, day, year] = dateStr.split('/');
            return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
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