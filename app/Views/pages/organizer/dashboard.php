<?=$this->include('templates/organizer/header');?>
<div class="app-container">
    <?=$this->include('templates/organizer/sidebar');?>
    <div class="app-main" id="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h4><i class="ti ti-dashboard"></i> Dashboard</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Filters for Date -->
            <div class="row">
                <div class="col-md-3">
                    <label for="date_from">From Date:</label>
                    <input type="date" id="date_from" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="date_to">To Date:</label>
                    <input type="date" id="date_to" class="form-control">
                </div>
                <div class="col-md-3 align-self-end">
                    <button id="filter" class="btn btn-primary">Filter</button>
                </div>
            </div>

            <!-- Total Sales Summary -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card card-statistics">
                        <div class="card-body">
                            <h5>Total Sales: ₱<span id="total_sales_display">0.00</span></h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table to show sales data -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <div class="card-heading">
                                <h4 class="card-title"><i class="fa fa-money"></i> Sales</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="datatable-wrapper table-responsive">
                                <table id="dashboard" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Event ID</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->include('templates/organizer/footer');?>
<script src="<?=base_url();?>assets/js/organizer/dashboard.js"></script>
