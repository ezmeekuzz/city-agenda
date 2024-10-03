<?=$this->include('templates/header');?>
<section class="container mt-5" style="max-width: 1200px;">
    <!-- Cover Photo Section -->
    <div class="cover-photo position-relative">
        <img src="https://via.placeholder.com/400" class="img-fluid w-100 rounded-4" alt="Cover Photo" style="height: 500px; object-fit: cover;">
        
        <!-- Profile Picture -->
        <div class="profile-picture-container position-absolute start-0 translate-middle ms-5">
            <img src="https://via.placeholder.com/150" class="rounded-circle border border-white" alt="Profile Picture" style="width: 250px; height: 250px; object-fit: cover;">
        </div>
    </div>

    <!-- Profile Information Section -->
    <div class="container mt-5 text-center">
        <h3 class="fw-bold">John Doe</h3>
        <p class="text-muted">Web Developer | Musician | Traveler</p>
    </div>
</section>
<?=$this->include('templates/footer');?>