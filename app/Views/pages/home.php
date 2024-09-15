<?=$this->include('templates/header');?>

<section class="container-fluid banner">
    <div class="container d-flex flex-column align-items-center gap-5">
        <img class="banner-img" src="img/bannerImg.png">
        <form class="container banner-form">
            <div class="d-flex gap-3  flex-md-row">
                <div class="search-input">
                    <i class="bi bi-geo-alt-fill"></i>
                    <input type="text" placeholder="Enter city name">
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
                    <h3> New York </h3><img src="img/note-Icon.png">
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
                <!--<div class="drop-cards d-flex flex-column justify-content-center">
                    <h4>Select Date</h4>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-justify-left"></i>
                            Any Date
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>-->
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
        <form class="container banner-form big-event-search">
            <div class="d-flex gap-3  flex-md-row">
                <div class="search-input">
                    <i class="bi bi-geo-alt-fill"></i>
                    <input type="text" placeholder="Enter city name">
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

        // Handle category selection
        $('#category-dropdown a').on('click', function() {
            selectedCategory = $(this).data('category');
            $(this).closest('.dropdown').find('.dropdown-toggle').text(selectedCategory);
            loadEvents();
        });

        // Handle location selection
        $('#location-dropdown a').on('click', function() {
            selectedLocation = $(this).data('location');
            $('#selected-location').text(selectedLocation);
            loadEvents();
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
            $.ajax({
                url: '/getEvents',
                method: 'GET',
                data: {
                    category: selectedCategory,
                    location: selectedLocation
                },
                success: function(response) {
                    let eventsContainer = $('#events-container');
                    eventsContainer.empty();

                    if (response.length === 0) {
                        eventsContainer.html('<p>No events found</p>');
                        return;
                    }

                    response.forEach(function(event) {
                        let eventHTML = `
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card" style="width: 100%;">
                                <img class="user-id" src="${event.image}" alt="User">
                                <i class="bi bi-suit-heart-fill heartIcon"></i>
                                <img src="${event.eventbanner}" alt="${event.eventname}">
                                <div class="card-body">
                                    <h3>${event.eventname}</h3>
                                </div>
                                <div class="card-bottom">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-geo-alt-fill"></i>
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
                    `;
                        eventsContainer.append(eventHTML);
                    });
                },
                error: function() {
                    $('#events-container').html('<p>Error loading events</p>');
                }
            });
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
</script>