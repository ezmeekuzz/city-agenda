<?=$this->include('templates/header');?>

<section class="container-fluid banner">
        <div class="container d-flex flex-column align-items-center gap-5">
           <img class="banner-img" src="img/bannerImg.png">
           <form class="container banner-form">
            <div class="d-flex gap-3 flex-column flex-md-row">
                <div class="search-input">
                    <i class="bi bi-geo-alt-fill"></i>
                    <input type="text" placeholder="Enter city name">
                </div>
                <button class="search-toggle">
                    <i class="bi bi-search"></i>
                    Explore
                </button>
            </div>
           </form>
        </div>
    </section>





    <section class="container-fluid category-sec">
        <div class="container">
            <div class="category-content">
                <h2 class="mb-4">Discover Top Categories</h2>
                <div class="d-flex category-section">
                    <a href="category-politics.html"><img src="img/politics.png" alt="img/politics.png"></a>
                    <a href="category-religions.html"><img src="img/religions.png" alt="img/religions.png"></a>
                    <a href="category-business.html"><img src="img/business.png" alt="img/business.png"></a>
                    <a href="category-sports.html"><img src="img/sports.png" alt="img/sports.png"></a>
                    <a href="caterory-education.html"><img src="img/education.png" alt="img/education.png"></a>
                    <a href="category-cultures.html"><img src="img/Cultures.png" alt="img/Cultures.png"></a>
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
                                My Location
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Action</a></li>
                              <li><a class="dropdown-item" href="#">Another action</a></li>
                              <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="drop-cards d-flex flex-column justify-content-center">
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
                    </div>
                    <div class="drop-cards d-flex flex-column justify-content-center">
                        <h4>Select Category</h4>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Category
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="category-politics.html">Politics</a></li>
                              <li><a class="dropdown-item" href="category-religions.html">Religions</a></li>
                              <li><a class="dropdown-item" href="category-business.html">Business</a></li>
                              <li><a class="dropdown-item" href="category-sports.html">Sports</a></li>
                              <li><a class="dropdown-item" href="caterory-education.html">Education</a></li>
                              <li><a class="dropdown-item" href="category-cultures.html">Cultures</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 col-">
                <div class="card" style="width: 100%;">
                    <img class="user-id" src="img/user-img.png">
                    <i class="bi bi-suit-heart-fill heartIcon"></i>
                    <img src="img/image-1.png" alt="image-1">
                    <div class="card-body">
                      <h3>California Piano Concert Events 2024</h3>
                    </div>
                    <div class="card-bottom">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill"></i>
                            <p>
                                Amsterdam <br>
                                <span>Schipol Airport</span>
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-fill"></i>
                            <p>
                                17 July 2024<br>
                                <span>6:00 Am</span>
                            </p>
                        </div>
                    </div>
                  </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="user-id" src="img/user-img.png">
                    <i class="bi bi-suit-heart-fill heartIcon"></i>
                    <img src="img/image-2.png" alt="image-1">
                    <div class="card-body">
                      <h3>California Piano Concert Events 2024</h3>
                    </div>
                    <div class="card-bottom">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill"></i>
                            <p>
                                Amsterdam <br>
                                <span>Schipol Airport</span>
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-fill"></i>
                            <p>
                                17 July 2024<br>
                                <span>6:00 Am</span>
                            </p>
                        </div>
                    </div>
                  </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="user-id" src="img/user-img.png">
                    <i class="bi bi-suit-heart-fill heartIcon"></i>
                    <img src="img/image-3.png" alt="image-1">
                    <div class="card-body">
                      <h3>California Piano Concert Events 2024</h3>
                    </div>
                    <div class="card-bottom">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill"></i>
                            <p>
                                Amsterdam <br>
                                <span>Schipol Airport</span>
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-fill"></i>
                            <p>
                                17 July 2024<br>
                                <span>6:00 Am</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="user-id" src="img/user-img.png">
                    <i class="bi bi-suit-heart-fill heartIcon"></i>
                    <img src="img/image-4.png" alt="image-1">
                    <div class="card-body">
                      <h3>California Piano Concert Events 2024</h3>
                    </div>
                    <div class="card-bottom">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill"></i>
                            <p>
                                Amsterdam <br>
                                <span>Schipol Airport</span>
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-fill"></i>
                            <p>
                                17 July 2024<br>
                                <span>6:00 Am</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="user-id" src="img/user-img.png">
                    <i class="bi bi-suit-heart-fill heartIcon"></i>
                    <img src="img/image-5.png" alt="image-1">
                    <div class="card-body">
                      <h3>California Piano Concert Events 2024</h3>
                    </div>
                    <div class="card-bottom">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill"></i>
                            <p>
                                Amsterdam <br>
                                <span>Schipol Airport</span>
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-fill"></i>
                            <p>
                                17 July 2024<br>
                                <span>6:00 Am</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="user-id" src="img/user-img.png">
                    <i class="bi bi-suit-heart-fill heartIcon"></i>
                    <img src="img/image-6.png" alt="image-1">
                    <div class="card-body">
                      <h3>California Piano Concert Events 2024</h3>
                    </div>
                    <div class="card-bottom">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill"></i>
                            <p>
                                Amsterdam <br>
                                <span>Schipol Airport</span>
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-fill"></i>
                            <p>
                                17 July 2024<br>
                                <span>6:00 Am</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="user-id" src="img/user-img.png">
                    <i class="bi bi-suit-heart-fill heartIcon"></i>
                    <img src="img/image-7.png" alt="image-1">
                    <div class="card-body">
                      <h3>California Piano Concert Events 2024</h3>
                    </div>
                    <div class="card-bottom">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill"></i>
                            <p>
                                Amsterdam <br>
                                <span>Schipol Airport</span>
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-fill"></i>
                            <p>
                                17 July 2024<br>
                                <span>6:00 Am</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="user-id" src="img/user-img.png">
                    <i class="bi bi-suit-heart-fill heartIcon"></i>
                    <img src="img/image-8.png" alt="image-1">
                    <div class="card-body">
                      <h3>California Piano Concert Events 2024</h3>
                    </div>
                    <div class="card-bottom">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill"></i>
                            <p>
                                Amsterdam <br>
                                <span>Schipol Airport</span>
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-fill"></i>
                            <p>
                                17 July 2024<br>
                                <span>6:00 Am</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="user-id" src="img/user-img.png">
                    <i class="bi bi-suit-heart-fill heartIcon"></i>
                    <img src="img/image-9.png" alt="image-1">
                    <div class="card-body">
                      <h3>California Piano Concert Events 2024</h3>
                    </div>
                    <div class="card-bottom">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill"></i>
                            <p>
                                Amsterdam <br>
                                <span>Schipol Airport</span>
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-fill"></i>
                            <p>
                                17 July 2024<br>
                                <span>6:00 Am</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="user-id" src="img/user-img.png">
                    <i class="bi bi-suit-heart-fill heartIcon"></i>
                    <img src="img/image-10.png" alt="image-1">
                    <div class="card-body">
                      <h3>California Piano Concert Events 2024</h3>
                    </div>
                    <div class="card-bottom">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill"></i>
                            <p>
                                Amsterdam <br>
                                <span>Schipol Airport</span>
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-fill"></i>
                            <p>
                                17 July 2024<br>
                                <span>6:00 Am</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="user-id" src="img/user-img.png">
                    <i class="bi bi-suit-heart-fill heartIcon"></i>
                    <img src="img/image-11.png" alt="image-1">
                    <div class="card-body">
                      <h3>California Piano Concert Events 2024</h3>
                    </div>
                    <div class="card-bottom">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill"></i>
                            <p>
                                Amsterdam <br>
                                <span>Schipol Airport</span>
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-fill"></i>
                            <p>
                                17 July 2024<br>
                                <span>6:00 Am</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card" style="width: 100%;">
                    <img class="user-id" src="img/user-img.png">
                    <i class="bi bi-suit-heart-fill heartIcon"></i>
                    <img src="img/image-12.png" alt="image-1">
                    <div class="card-body">
                      <h3>California Piano Concert Events 2024</h3>
                    </div>
                    <div class="card-bottom">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill"></i>
                            <p>
                                Amsterdam <br>
                                <span>Schipol Airport</span>
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-fill"></i>
                            <p>
                                17 July 2024<br>
                                <span>6:00 Am</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>





    <section class="container-fluid big-event-section">
        <div class="container bot-slider-sec">
            <h2>Find Big Events In Any City</h2>
            <form class="banner-form big-event-search">
                <div class="d-flex gap-3 flex-column flex-lg-row flex-md-row">
                    <div class="search-input">
                        <i class="bi bi-geo-alt-fill"></i>
                        <input type="text" placeholder="Enter city name">
                    </div>
                    <button class="search-toggle">
                        <i class="bi bi-search"></i>
                        Explore
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
    });

    </script>