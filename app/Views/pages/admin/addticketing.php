<?=$this->include('templates/admin/header');?>
<div class="app-container">
    <?=$this->include('templates/admin/sidebar');?>
    <div class="app-main" id="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h4><i class="fa fa-ticket"></i> Add Ticketing</h4>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                    <a href="<?=base_url();?>admin/"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        Dashboard
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Add Ticketing</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row select-wrapper">
                <div class="col-lg-12 selects-contant">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <div class="card-heading">
                                <h4 class="card-title"><i class="fa fa-ticket"></i> Add Ticketing</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item p-4 d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column align-items-start">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fa fa-dollar me-2"></i>
                                            <strong>Paid</strong>
                                        </div>
                                        <span class="mb-0">Create A Ticket That People Have To Pay For.</span>
                                    </div>
                                    <div class="text-end">
                                        <a class="btn p-0 ms-3 text-primary open-modal-btn" style="font-size: 25px;" data-ticket-type="Paid">
                                            <i class="fa fa-plus-circle fa-lg"></i>
                                        </a>
                                    </div>
                                </li>

                                <li class="list-group-item p-4 d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column align-items-start">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fa fa-ticket me-2"></i>
                                            <strong>Free</strong>
                                        </div>
                                        <span class="mb-0">Create A Ticket That No One Has To Pay For.</span>
                                    </div>
                                    <div class="text-end">
                                        <a class="btn p-0 ms-3 text-primary open-modal-btn" style="font-size: 25px;" data-ticket-type="Free">
                                            <i class="fa fa-plus-circle fa-lg"></i>
                                        </a>
                                    </div>
                                </li>

                                <li class="list-group-item p-4 d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column align-items-start">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fa fa-handshake-o me-2"></i>
                                            <strong>Donations</strong>
                                        </div>
                                        <span class="mb-0">Let People Pay Any Amount For Their Ticket.</span>
                                    </div>
                                    <div class="text-end">
                                        <a class="btn p-0 ms-3 text-primary open-modal-btn" style="font-size: 25px;" data-ticket-type="Donations">
                                            <i class="fa fa-plus-circle fa-lg"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item p-4 d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column align-items-start">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fa fa-times-circle me-2"></i>
                                            <strong>No Tickets</strong>
                                        </div>
                                        <span class="mb-0">No Need To Pay For A Ticket.</span>
                                    </div>
                                    <div class="text-end">
                                        <a class="btn p-0 ms-3 text-primary open-modal-btn" style="font-size: 25px;" data-ticket-type="No Ticket">
                                            <i class="fa fa-plus-circle fa-lg"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketModalLabel">Ticket Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form fields will be dynamically injected here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="ticketForm">Save & Continue</button>
            </div>
        </div>
    </div>
</div>
<?=$this->include('templates/admin/footer');?>
<script>
    let event_id = <?=$event_id;?>;
</script>
<script type="text/javascript" src="<?=base_url();?>assets/js/admin/addticketing.js"></script>