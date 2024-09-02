







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