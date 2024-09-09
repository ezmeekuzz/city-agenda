

//Navbar toggle

document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggleButton = document.querySelector('.navbar-toggler');
    const isClickInsideSidebar = sidebar.contains(event.target);
    const isClickOnToggleButton = sidebarToggleButton.contains(event.target);

    if (!isClickInsideSidebar && !isClickOnToggleButton && sidebar.style.width === "250px") {
        // Close the sidebar if the click is outside and the sidebar is open
        sidebar.style.width = "0";
    }
});

function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    if (sidebar.style.width === "0px" || sidebar.style.width === "") {
        sidebar.style.width = "250px"; // Adjust the width as needed
    } else {
        sidebar.style.width = "0";
    }
}


//categories section

const slider = document.querySelector('.category-slider');
let currentIndex = 0; // Start index for the slide

// Function to check if we are in mobile view
function isMobileView() {
    return window.innerWidth <= 500;
}

function slideLeft() {
    if (isMobileView()) {
        const itemsPerSlide = 2; // Two items per slide in mobile view
        const totalItems = slider.children.length;

        // Loop to end if at the beginning
        if (currentIndex <= 0) {
            currentIndex = totalItems - itemsPerSlide;
        } else {
            currentIndex -= itemsPerSlide;
        }
        updateSliderPosition();
    }
}

function slideRight() {
    if (isMobileView()) {
        const itemsPerSlide = 2; // Two items per slide in mobile view
        const totalItems = slider.children.length;

        // Loop to start if at the end
        if (currentIndex >= totalItems - itemsPerSlide) {
            currentIndex = 0;
        } else {
            currentIndex += itemsPerSlide;
        }
        updateSliderPosition();
    }
}

function updateSliderPosition() {
    if (isMobileView()) {
        const itemWidth = slider.children[0].offsetWidth; // Width of each item
        const slideDistance = currentIndex * (itemWidth + 20); // Calculate slide distance including margin
        slider.style.transform = `translateX(-${slideDistance}px)`;
    } else {
        // Reset to default position when not in mobile view
        slider.style.transform = 'translateX(0)';
        currentIndex = 0;
    }
}

// Add event listener for window resize to handle dynamically
window.addEventListener('resize', updateSliderPosition);

// Add event listener for window resize to handle dynamically
window.addEventListener('resize', updateSliderPosition);



// Event with payment Counter

let counters = [0, 0, 0, 0, 0, 0, 0];

function updateCounter(index) {
    document.getElementById('counter' + (index + 1)).innerText = counters[index];
}

function incrementCounter(index) {
    counters[index]++;
    updateCounter(index);
}

function decrementCounter(index) {
    if (counters[index] > 0) {  // Check if the counter is greater than 0
        counters[index]--;
        updateCounter(index);
    }
}



// Carousel Slider


$(document).ready(function(){



    var carouselWidth = $('.carousel-inner')[0].scrollWidth;
    var cardWidth = $('.carousel-item').width();

    var scrollPosition = 0;

    $('.carousel-control-next').on('click', function(){
        if (scrollPosition < (carouselWidth - (cardWidth * 4))){
            scrollPosition = scrollPosition + cardWidth;
        $('.carousel-inner').animate({scrollLeft: scrollPosition}, 1000);
        }
    });

    $('.carousel-control-prev').on('click', function(){
        if (scrollPosition > 0){
            scrollPosition = scrollPosition - cardWidth ;
        $('.carousel-inner').animate({scrollLeft: scrollPosition}, 1000);
        }
    });



    $('input[name="collapseGroup"]').on('click', function() {
        var selectedSection = $(this).val();
        $('.collapse').not('#' + selectedSection).slideUp(); // Hide all other sections
        $('#' + selectedSection).slideDown(); // Show the selected section
    });



    


    // Upload Section

    $('#uploadInput').change(function(e){
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#uploadBanner').css('background-image', 'url(' + e.target.result + ')');
            $('.upload-text').hide();  // Hide the upload text when an image is selected
        }
        reader.readAsDataURL(this.files[0]);
    });






    // Date Select Type Evetn

    // $('.date-button').click(function() {
    //     alert('Hey!');
    //     // Remove active class from all buttons
    //     // $('.date-button').removeClass('active-button');

    //     // Add active class to the clicked button
    //     $('.date-button').addClass('active-button');
    // });

});