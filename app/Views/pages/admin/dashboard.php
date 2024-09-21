<?=$this->include('templates/admin/header');?>
<div class="app-container">
    <?=$this->include('templates/admin/sidebar');?>
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
            <div class="row">
                <div class="col-xs-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 m-b-0 bg-pink">
                        <div class="card-body">
                            <h2 class="text-white mb-0"><i class="fa fa-users"></i> <?=$usersAddedToday;?></h2>
                            <p class="text-white">New Users Today</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 m-b-0 bg-success">
                        <div class="card-body">
                            <h2 class="text-white mb-0"><i class="fa fa-users"></i> <?=$allRegisteredUsers;?></h2>
                            <p class="text-white">All Registered Users</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 m-b-0 bg-primary">
                        <div class="card-body">
                            <h2 class="text-white mb-0"><i class="fa fa-calendar"></i> <?=$eventsAddedToday;?></h2>
                            <p class="text-white">New Events Today</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 m-b-0 bg-danger">
                        <div class="card-body">
                            <h2 class="text-white mb-0"><i class="fa fa-calendar-o"></i> <?=$allEvents;?></h2>
                            <p class="text-white">All Events</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 m-b-0 bg-orange">
                        <div class="card-body">
                            <h2 class="text-white mb-0"><i class="fa fa-ticket"></i> <?=$ticketsOrderedToday;?></h2>
                            <p class="text-white">Tickets Ordered Today</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 m-b-0 bg-info">
                        <div class="card-body">
                            <h2 class="text-white mb-0">€<?=number_format($totalEarningsToday, 2);?></h2>
                            <p class="text-white">Total Earnings Today</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 m-b-0 bg-pink">
                        <div class="card-body">
                            <h2 class="text-white mb-0">€<?=number_format($overAllSales, 2);?></h2>
                            <p class="text-white">Overall Sales</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-6 m-b-30">
                    <div class="card card-statistics h-100 mb-0">
                        <div class="card-header">
                            <h4 class="card-title">Yearly Sales Report</h4>
                        </div>
                        <div class="card-body pb-0">
                            <div class="row m-b-20">
                                <div class="col-xxs-6 col-xl-4 col-xxl-4 mb-2 mb-xxl-0">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-container img-icon m-r-20 bg-light-gray rounded">
                                            <i class="fa fa-cart-plus text-primary"></i>
                                        </div>
                                        <div class="report-details">
                                            <p>Annual Sales</p>
                                            <h3>€<?=number_format($annualSales, 2);?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="apexchart-wrapper">
                                <div id="monthlySales" class="chart-fit"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 m-b-30">
                    <div class="card card-statistics h-100 mb-0">
                        <div class="card-header d-sm-flex justify-content-between align-items-center py-3">
                            <div class="card-heading mb-3 mb-sm-0">
                                <h4 class="card-title">Payout Request</h4>
                            </div>
                            <div class="dropdown">
                                <input type="text" class="form-control form-control-sm" placeholder="Search Event Organizer" />
                            </div>
                        </div>
                        <div class="card-body scrollbar scroll_dark" style="max-height: 420px;">
                            <div class="table-responsive m-t-20">
                                <table id="datatable-buttons" class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Amount Requested</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-muted">
                                        <tr>
                                            <td>1</td>
                                            <td>Smith Drake</td>
                                            <td>27/3/2014</td>
                                            <td>$1,00,000</td>
                                            <td>
                                                <label class="badge mb-0 badge-primary-inverse"> Paid</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Smith Drake</td>
                                            <td>27/3/2014</td>
                                            <td>$1,00,000</td>
                                            <td>
                                                <label class="badge mb-0 badge-warning-inverse"> Pending</label>
                                            </td>
                                        </tr>
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
<?=$this->include('templates/admin/footer');?>
<script type="text/javascript" src="<?=base_url();?>assets/js/admin/dashboard.js"></script>