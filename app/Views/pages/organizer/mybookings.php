<?=$this->include('templates/organizer/header');?>
<style>
/* Ensure the modal backdrop is behind the lightbox */
.modal-backdrop {
    z-index: 1049; /* Below lightbox */
}

/* Magnific Popup background */
.mfp-bg {
    z-index: 1060; /* Ensure it's above modal backdrop */
}

/* Magnific Popup wrapper */
.mfp-wrap {
    z-index: 1061; /* Ensure the lightbox appears above the modal */
}

/* Magnific Popup content (image and body shadow) */
.mfp-content {
    z-index: 1062; /* Ensure the content and shadows appear above everything */
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.7); /* Adjust shadow for depth */
}

/* Body shadow or backdrop */
body.mfp-active {
    z-index: 1063; /* Ensure body has a higher z-index */
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.8); /* Apply shadow if needed */
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
                            <h1><i class="fa fa-calendar"></i> My Bookings</h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="<?=base_url();?>organizer/"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        Dashboard
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">My Bookings</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <div class="card-heading">
                                <h4 class="card-title"><i class="fa fa-calendar"></i> My Bookings</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="datatable-wrapper table-responsive">
                                <table id="mybookings" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Event ID</th>
                                            <th>Event Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total Paid</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="qrcodesModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="qrCodes"></div>
            </div>
        </div>
    </div>
</div>
<?=$this->include('templates/organizer/footer');?>
<script src="<?=base_url();?>assets/js/organizer/mybookings.js"></script>