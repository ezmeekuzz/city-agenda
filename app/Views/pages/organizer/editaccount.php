<?=$this->include('templates/organizer/header');?>
<style>
/* Container for cover photo */
.cover-photo-container {
    position: relative;
    width: 100%;
    height: 300px; /* Adjust height as needed */
    background-color: #f0f0f0; /* Fallback color */
    text-align: center;
    overflow: hidden;
    margin-bottom: 150px; /* Increase margin to make space for profile picture */
}

.cover-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

#coverPhotoInput {
    display: none;
}

/* Cover photo change button */
.cover-photo-btn {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.profile-picture-container {
    position: absolute;
    bottom: -75px; /* Adjust to overlap profile picture */
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    z-index: 9999;
}

.profile-picture {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
}

#profilePicture {
    display: none;
}

/* Add margin to push the form content down */
form#editaccount {
    margin-top: 80px; /* Adjust this value if necessary to avoid overlap */
}

</style>

<div class="app-container">
    <?=$this->include('templates/organizer/sidebar');?>
    <div class="app-main" id="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h4><i class="ti ti-user"></i> Account</h4>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="<?=base_url();?>organizer/"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">Dashboard</li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Edit Account</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cover Photo Section -->
            <div class="col-lg-12 text-center">
                <div class="cover-photo-container">
                    <!-- Cover Photo -->
                    <img id="coverPhotoPreview" class="cover-photo" src="<?=$coverphoto;?>" alt="Cover Photo">
                    
                    <!-- Hidden file input for cover photo -->
                    <input type="file" id="coverPhotoInput" name="coverPhoto" accept="image/*">

                    <!-- Button to change cover photo -->
                    <button type="button" id="changeCoverPhotoButton" class="cover-photo-btn">
                        <i class="fa fa-camera"></i>
                    </button>
                </div>

                <!-- Profile Picture Section -->
                <div class="profile-picture-container">
                    <img id="profilePicturePreview" class="profile-picture rounded-circle" src="<?=$image;?>" alt="Profile Picture">
                    
                    <!-- Hidden file input for profile picture -->
                    <input type="file" id="profilePicture" name="profilePicture" class="d-none" accept="image/*">

                    <!-- Button to change profile picture -->
                    <button type="button" id="changePictureButton" class="btn btn-secondary position-absolute d-flex justify-content-center align-items-center" style="bottom: 0; right: 0; background-color: rgba(0, 0, 0, 0.5); border: none; border-radius: 50%; width: 40px; height: 40px;">
                        <i class="fa fa-camera text-white"></i>
                    </button>
                </div>
            </div>

            <!-- Form Section -->
            <div class="row select-wrapper mt-4">
                <div class="col-lg-12">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <div class="card-heading">
                                <h4 class="card-title"><i class="fa fa-user"></i> Edit Account</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="editaccount" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6" hidden>
                                        <div class="form-group">
                                            <label for="user_id">User ID</label>
                                            <input type="text" value="<?=$userDetails['user_id'];?>" name="user_id" id="user_id" class="form-control" placeholder="Enter User ID">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstname">First Name</label>
                                            <input type="text" value="<?=$userDetails['firstname'];?>" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" value="<?=$userDetails['lastname'];?>" name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="jobtitle">Job Title</label>
                                            <input type="text" value="<?=$userDetails['jobtitle'];?>" name="jobtitle" id="jobtitle" class="form-control" placeholder="Enter Job Title">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="emailaddress">Email Address</label>
                                            <input type="email" readonly value="<?=$userDetails['emailaddress'];?>" name="emailaddress" id="emailaddress" class="form-control" placeholder="Enter Email Address">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phonenumber">Phone Number</label>
                                            <input type="tel" value="<?=$userDetails['phonenumber'];?>" name="phonenumber" id="phonenumber" class="form-control" placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="aboutyourself">Write About Yourself</label>
                                            <textarea name="aboutyourself" id="aboutyourself" class="form-control" rows="4" placeholder="Write something about yourself"><?=$userDetails['aboutyourself'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->include('templates/organizer/footer');?>
<script type="text/javascript" src="<?=base_url();?>assets/js/organizer/editaccount.js"></script>
