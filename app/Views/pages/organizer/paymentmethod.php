<?=$this->include('templates/organizer/header');?>
<div class="app-container">
    <?=$this->include('templates/organizer/sidebar');?>
    <div class="app-main" id="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h4><i class="ti ti-money"></i> Payment Method</h4>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="<?=base_url();?>organizer/"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">Dashboard</li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Payment Method</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card card-statistics">
                        <div class="card-body text-center">
                            <h4 class="d-flex justify-content-center align-items-center">
                                <a href="#" data-toggle="modal" data-target="#addPaymentMethodModal">
                                    <i class="fa fa-plus-circle" style="font-size: 24px; margin-right: 8px;"></i>
                                    Add New Payment Method
                                </a>
                            </h4>
                            <p>Choose payment method or add a new one if not already added.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <div class="card-heading">
                                <h4 class="card-title"><i class="fa fa-bank"></i> Bank Accounts</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="datatable-wrapper table-responsive">
                                <table id="bankAccountTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Account Name</th>
                                            <th>Swift/BIC</th>
                                            <th>IBAN</th>
                                            <th>Active Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card card-statistics mt-4">
                        <div class="card-header">
                            <div class="card-heading">
                                <h4 class="card-title"><i class="fa fa-credit-card"></i> Credit Cards</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="datatable-wrapper table-responsive">
                                <table id="creditCardTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Card Number</th>
                                            <th>Expiration Date</th>
                                            <th>CVV</th>
                                            <th>Card Status</th>
                                            <th>Actions</th>
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
<div class="modal fade" id="addPaymentMethodModal" tabindex="-1" role="dialog" aria-labelledby="addPaymentMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentMethodModalLabel">Add Payment Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addPaymentMethodForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="paymentType">Payment Type</label>
                        <select class="form-control" id="paymentType" name="paymentType" onchange="togglePaymentFields()">
                            <option value="" disabled selected>Select Payment Type</option>
                            <option value="bank">Bank Account</option>
                            <option value="credit">Credit Card</option>
                        </select>
                    </div>
                    <div id="bankFields" style="display:none;">
                        <div class="form-group">
                            <label for="accountName">Account Name</label>
                            <input type="text" class="form-control" id="accountName" name="accountName">
                        </div>
                        <div class="form-group">
                            <label for="swift">Swift/BIC</label>
                            <input type="text" class="form-control" id="swift" name="swift">
                        </div>
                        <div class="form-group">
                            <label for="iban">IBAN</label>
                            <input type="text" class="form-control" id="iban" name="iban">
                        </div>
                    </div>
                    <div id="creditCardFields" style="display:none;">
                        <div class="form-group">
                            <label for="cardNumber">Card Number</label>
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber">
                        </div>
                        <div class="form-group">
                            <label for="expirationDate">Expiration Date</label>
                            <input type="text" class="form-control" id="expirationDate" name="expirationDate" placeholder="MM/YY" maxlength="5">
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Payment Method</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?=$this->include('templates/organizer/footer');?>
<script src="<?=base_url();?>assets/js/organizer/paymentmethod.js"></script>
