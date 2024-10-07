<?=$this->include('templates/header');?>
<style>
    .aboutyourself h2 {
        color: #741774;
        font-weight: bold;
        font-family: 'General Sans' !important;
    }
    .aboutyourself p {
        text-align: justify;
        font-size: 25px !important;
        font-family: 'General Sans' !important;
    }
    .past_upcoming_events .btn-group .btn {
        height: 60px;
        background-color: white;
        color: #741774;
        border: none;
        font-family: 'General Sans' !important;
    }

    .past_upcoming_events .btn-group .btn.active {
        background-color: #741774;
        font-family: 'General Sans' !important;
        color: white;
    }

    .past_upcoming_events .btn-group .btn:hover {
        background-color: #5c1260;
        color: white;
        font-family: 'General Sans' !important;
    }
    p, h3, h2, button {
        font-family: 'General Sans' !important;
    }

    /* Mobile styling */
    @media (max-width: 768px) {
        .profile-info-container {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .profile-info-container .text-start {
            text-align: center;
        }
        .profile-info-container .btn-follow {
            margin-top: 10px;
            width: 100%;
        }

        /* Center the past/upcoming events buttons */
        .past_upcoming_events .btn-group {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .past_upcoming_events .btn-group .btn {
            width: 100%; /* Make buttons take full width */
            margin-bottom: 10px; /* Add space between buttons */
        }

        /* Ensure the card takes full width in mobile */
        .event-card {
            width: 100% !important;
            margin: 0 auto;
        }

        /* Full-width columns for mobile */
        .col-md-6, .col-lg-6 {
            width: 100%;
        }
    }

    /* Ensure cards fill the width of the container in all views */
    .card {
        width: 100%;
    }

    /* See More button styling */
    #see-more {
        background-color: white;
        color: #741774;
        border: 2px solid #741774;
        transition: background-color 0.3s, color 0.3s;
        padding: 10px 20px;
    }

    #see-more:hover {
        background-color: #741774;
        color: white;
    }
    .edit-icon {
    font-size: 16px;
    color: #741774;
    background-color: white;
    border: 2px solid #741774;
    border-radius: 50%; /* Makes it a perfect circle */
    width: 32px; /* Set width and height to the same value */
    height: 32px;
    display: flex; /* Aligns the icon in the center */
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s, color 0.3s;
    margin-left: 10px;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.edit-icon:hover {
    background-color: #741774;
    color: white;
    border-color: white;
}

</style>

<section class="container mt-5" style="max-width: 1200px;">
    <!-- Cover Photo Section -->
    <div class="cover-photo position-relative mb-5">
        <img src="<?=$coverPhoto;?>" class="img-fluid w-100 rounded-4" alt="Cover Photo" style="height: 500px; object-fit: cover;">
        <?php if ($condID == 'edit'): ?>
            <div class="edit-icon-container position-absolute top-0 end-0 p-2">
                <a href="#" class="edit-icon" id="editCoverPhoto">
                    <i class="fa fa-edit"></i>
                </a>
                <input type="file" id="coverPhotoInput" accept="image/*" class="d-none">
            </div>
        <?php endif; ?>
        
        <!-- Profile Picture -->
        <div class="profile-picture-container position-absolute top-100 start-50 translate-middle">
            <img src="<?=$image;?>" class="rounded-circle border border-white" alt="Profile Picture" style="width: 250px; height: 250px; object-fit: cover;">
            <?php if ($condID == 'edit'): ?>
                <div class="edit-icon-container position-absolute top-0 end-0 p-2">
                    <a href="#" class="edit-icon" id="editProfilePicture">
                        <i class="fa fa-edit"></i>
                    </a>
                    <input type="file" id="profilePictureInput" accept="image/*" class="d-none">
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Profile Info and Follow Button -->
    <div class="mt-5 p-5 profile-info-container d-flex justify-content-between align-items-center">
    <!-- Name on the left (or centered on mobile) -->
    <div class="text-start">
        <h2 class="text-black fw-bold mt-4 d-flex">
            <span id="first-last-name">
                <?=$userDetails['firstname'] . ' ' . $userDetails['lastname'];?>
            </span>

            <!-- Edit icon button -->
            <?php if ($condID == 'edit'): ?>
                <a id="edit-fullname-btn" class="edit-icon" id="edit-fullname-btn">
                    <i class="fa fa-edit"></i>
                </a>
            <?php endif; ?>
        </h2>
        <!-- Input fields for editing, hidden initially -->
        <div id="edit-name-fields" class="d-none w-100">
            <input type="text" id="firstname" class="form-control mb-1" value="<?=$userDetails['firstname']?>">
            <input type="text" id="lastname" class="form-control" value="<?=$userDetails['lastname']?>">
        </div>
        <p class="text-black fw-bold d-flex align-items-center">
            <?=$userDetails['jobtitle'];?> | 23 Followers
            <!--<?php if ($condID == 'edit'): ?>
                <a href="/profile/editJobTitle/<?= $userDetails['user_id'] ?>" class="edit-icon" style="margin-left: 10px;">
                    <i class="fa fa-edit"></i>
                </a>
            <?php endif; ?>-->
        </p>
    </div>
    <!-- Follow Button (positioned below name on mobile) -->
    <div>
        <button class="btn btn-follow rounded-pill" style="background-color: #741774; color: white; height: 50px; padding: 10px 20px;">
            <i class="fas fa-user-plus"></i> Follow
        </button>
    </div>
</div>
</section>

<section class="container" style="max-width: 1200px;">
    <div class="row">
        <div class="col-lg-6">
            <div class="aboutyourself text-center">
                <h2 class="position-relative">
                    About <?=$userDetails['firstname'] . ' ' . $userDetails['lastname'];?>
                    <?php if ($condID == 'edit'): ?>
                        <a href="javascript:void(0);" class="edit-icon position-absolute top-0 end-0" style="margin-left: 10px;" id="edit-about-btn">
                            <i class="fa fa-edit"></i>
                        </a>
                    <?php endif; ?>
                </h2>
                <p id="about-text">
                    <?=$userDetails['aboutyourself'];?>
                </p>
                <!-- Hidden Textarea for Editing -->
                <textarea id="edit-about-textarea" class="form-control d-none"><?=$userDetails['aboutyourself'];?></textarea>
            </div>
        </div>
        <div class="col-lg-6 past_upcoming_events">
            <!-- Event buttons -->
            <div class="w-100 text-end">
                <div class="btn-group w-75" role="group" aria-label="Event buttons">
                    <button type="button" class="btn btn-outline-primary active fs-5 fw-bold" id="past-events" data-filter="past">
                        <?php if($pastEventsCount > 0) : ?>
                            <?=$pastEventsCount;?> Past Event(s)
                        <?php else : ?>
                            No Past Event(s)
                        <?php endif; ?>
                    </button>
                    <button type="button" class="btn btn-outline-primary fs-5 fw-bold" id="upcoming-events" data-filter="upcoming">
                        <?php if($upcomingEventsCount > 0) : ?>
                            <?=$upcomingEventsCount;?> Upcoming Event(s)
                        <?php else : ?>
                            No Upcoming Event(s)
                        <?php endif; ?>
                    </button>
                </div>
            </div>

            <!-- Event cards -->
            <div class="w-100">
                <div class="row justify-content-end">
                    <div class="col-lg-9 col-sm-12 mb-4 mt-4">
                        <!-- Example event card -->
                        <div id="eventsList">
                            
                        </div>

                        <!-- See More Button -->
                        <div class="text-center mt-4">
                            <button id="see-more" class="btn rounded-pill btn-outline-primary fw-bold">
                                See More
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?=$this->include('templates/footer');?>

<script>
    // JavaScript to toggle active button
    document.querySelectorAll('.btn-group button').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelector('.btn-group .active').classList.remove('active');
            this.classList.add('active');
        });
    });
    
    // Function to load events based on the filter (past/upcoming)
    let currentPage = 1; // Track the current page of events being loaded
    let isFetching = false; // Prevent multiple requests during loading

    // Modified loadEvents function with pagination
    function loadEvents(filter = 'past', page = 1) {
        if (isFetching) return; // Exit if already fetching

        isFetching = true; // Set fetching to true to prevent multiple clicks

        $.ajax({
            url: `/profile/getEvents?filter=${filter}&page=${page}&userId=<?=$userID?>`, // Send page number as query parameter
            method: 'GET',
            success: function(response) {
                let eventsContainer = $('#eventsList');
                if (page === 1) {
                    eventsContainer.empty();  // Clear the previous events only on the first page load
                }

                if (response.length === 0 && page === 1) {
                    // No events found on the first page
                    eventsContainer.html('<center><img src="img/page-not-found.png" alt=""></center><center><h1 style="color: #741774;">No Events Found</h1></center>');
                    $('#see-more').hide(); // Hide the "See More" button
                    isFetching = false;  // Reset fetching status
                    return;
                } else if (response.length === 0 && page > 1) {
                    // No more events to load
                    $('#see-more').hide(); // Hide the "See More" button
                    isFetching = false;  // Reset fetching status
                    return;
                }

                // Loop through the response and create HTML for each event
                response.forEach(function(event) {
                    const isFavoritedClass = event.is_favorited ? 'active' : '';

                    let eventHTML = `
                        <div class="card">
                            <!-- User image -->
                            <img class="user-id img-fluid" src="/${event.image}" alt="User" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; margin: 10px;">
                            <!-- Event banner -->
                            <img src="/${event.eventbanner}" class="img-fluid" style="max-height: 250px; object-fit: cover;" alt="${event.eventname}">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <a href="/${event.slug}" style="text-decoration: none; color: black; flex-grow: 1;">
                                        <h4 style="font-size: 1.2rem;">${event.eventname}</h4>
                                    </a>
                                    <!-- Heart icon -->
                                    <button class="heart-button ml-auto" onclick="toggleFavorite(this, ${event.event_id})" style="border: none; background: transparent;">
                                        <i class="bi bi-suit-heart-fill heartIcon ${isFavoritedClass}" style="font-size: 1.5rem; color: red;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-bottom p-2">
                                <div class="d-flex align-items-center">
                                    <p class="ml-2">${event.city}<br><span>${event.locationname}</span></p>
                                </div>
                                <hr>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-clock-fill"></i>
                                    <p class="ml-2">${formatDate(event.eventdate)}<br><span>${formatTime(event.eventstartingtime)}</span></p>
                                </div>
                            </div>
                        </div>`;

                    eventsContainer.append(eventHTML);  // Append each event's HTML to the container
                });

                currentPage++; // Increment the page number for the next "See More" click
                isFetching = false; // Reset fetching status
                $('#see-more').show(); // Make sure the "See More" button is visible
            },
            error: function() {
                $('#eventsList').html('<p>Error loading events</p>');  // Show error message
                isFetching = false; // Reset fetching status in case of an error
            }
        });
    }

    // Event listener for the "See More" button
    document.getElementById('see-more').addEventListener('click', function() {
        let filter = document.querySelector('.btn-group .active').dataset.filter; // Get active filter
        loadEvents(filter, currentPage);  // Load the next page of events
    });

    // Event listener for filter buttons
    $('.btn-group button').on('click', function() {
        let filter = $(this).data('filter');  // Get the filter type from the button
        $('.btn-group button').removeClass('active');  // Remove active class from all buttons
        $(this).addClass('active');  // Add active class to the clicked button
        currentPage = 1;  // Reset to the first page when the filter changes
        $('#see-more').show(); // Show the "See More" button again if hidden
        loadEvents(filter);  // Load events based on the new filter
    });

    // Initial load of events
    loadEvents();

    function formatDateToYMD(dateStr) {
        const [month, day, year] = dateStr.split('/');
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
    }

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
    $(document).ready(function () {
        // Trigger cover photo file input
        $('#editCoverPhoto').click(function (e) {
            e.preventDefault();
            $('#coverPhotoInput').click();
        });

        // Handle cover photo upload
        $('#coverPhotoInput').change(function () {
            const coverPhotoInput = this.files[0];
            if (coverPhotoInput) {
                const formData = new FormData();
                formData.append('cover_photo', coverPhotoInput);
                formData.append('user_id', '<?= $userDetails['user_id']; ?>'); // Include user ID for server processing

                // Read the image and preview it immediately before uploading
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Update the cover photo with the selected image preview
                    $('img.img-fluid').attr('src', e.target.result);
                };
                reader.readAsDataURL(coverPhotoInput);

                // Perform the actual upload via AJAX
                $.ajax({
                    url: '/profile/updateCoverPhoto', // Your server-side upload handler
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (!response.success) {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function () {
                        alert('Failed to upload cover photo. Please try again.');
                    }
                });
            } else {
                alert('Please select a file to upload.');
            }
        });

        // Trigger profile picture file input
        $('#editProfilePicture').click(function (e) {
            e.preventDefault();
            $('#profilePictureInput').click();
        });

        // Handle profile picture upload
        $('#profilePictureInput').change(function () {
            const profilePictureInput = this.files[0];
            if (profilePictureInput) {
                const formData = new FormData();
                formData.append('profile_picture', profilePictureInput);
                formData.append('user_id', '<?= $userDetails['user_id']; ?>'); // Include user ID for server processing

                // Read the image and preview it immediately before uploading
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Update the profile picture with the selected image preview
                    $('img.rounded-circle').attr('src', e.target.result);
                };
                reader.readAsDataURL(profilePictureInput);

                // Perform the actual upload via AJAX
                $.ajax({
                    url: '/profile/updateProfilePicture', // Your server-side upload handler
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (!response.success) {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function () {
                        alert('Failed to upload profile picture. Please try again.');
                    }
                });
            } else {
                alert('Please select a file to upload.');
            }
        });
    });
    $('#edit-about-btn').on('click', function() {
        const aboutText = $('#about-text');
        const textarea = $('#edit-about-textarea');
        const editIcon = $(this).find('i'); // Icon inside the button
        
        if (editIcon.hasClass('fa-edit')) {
            // Switch to Edit Mode: Hide <p> and show <textarea>
            aboutText.addClass('d-none');
            textarea.removeClass('d-none');
            textarea.val(aboutText.text().trim()); // Set textarea content
            editIcon.removeClass('fa-edit').addClass('fa-save'); // Change icon to save
        } else {
            // Switch to Save Mode: Hide <textarea> and show <p>
            aboutText.text(textarea.val()); // Update the <p> with new content
            aboutText.removeClass('d-none');
            textarea.addClass('d-none');
            editIcon.removeClass('fa-save').addClass('fa-edit'); // Change icon back to edit

            // AJAX call to save the updated "About" section
            const updatedAbout = textarea.val();
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/profile/updateAbout',
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify({
                    user_id: <?= $userDetails['user_id'] ?>,
                    aboutyourself: updatedAbout
                }),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.success) {
                        console.log('About section updated successfully!');
                    } else {
                        console.log('Error updating the about section.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
    $('#edit-fullname-btn').on('click', function() {
        const fullnameText = $('#first-last-name');
        const fullnameInput = $('#edit-name-fields');
        const editIcon = $(this).find('i'); // Icon inside the button
        
        if (editIcon.hasClass('fa-edit')) {
            // Switch to Edit Mode: Hide <p> and show <textarea>
            fullnameText.addClass('d-none');
            fullnameInput.removeClass('d-none');
            editIcon.removeClass('fa-edit').addClass('fa-save'); // Change icon to save
        } else {
            fullnameText.removeClass('d-none');
            fullnameInput.addClass('d-none');
            editIcon.removeClass('fa-save').addClass('fa-edit'); // Change icon back to edit

            // AJAX call to save the updated "About" section
            const updatedFirstname = $('#firstname').val();
            const updatedLastname = $('#lastname').val();
            fullnameText.text(updatedFirstname + ' ' + updatedLastname); // Update the <p> with new content
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/profile/updateFullName',
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify({
                    firstName: updatedFirstname,
                    lastName: updatedLastname,
                    user_id: <?= $userDetails['user_id'] ?>,
                }),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.success) {
                        console.log('About section updated successfully!');
                    } else {
                        console.log('Error updating the about section.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
</script>
