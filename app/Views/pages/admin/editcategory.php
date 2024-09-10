<?=$this->include('templates/admin/header');?>
<div class="app-container">
    <?=$this->include('templates/admin/sidebar');?>
    <div class="app-main" id="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h4><i class="fa fa-list"></i> Edit Category</h4>
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
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Edit Category</li>
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
                                <h4 class="card-title"><i class="fa fa-list"></i> Edit Category</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="editcategory" enctype="multipart/form-data">
                                <div class="form-group" hidden>
                                    <label for="category_id">Category ID</label>
                                    <input type="text" value="<?=$details['category_id'];?>" name="category_id" id="category_id" class="form-control" placeholder="Enter Category ID">
                                </div>
                                <div class="form-group">
                                    <label for="categoryimage">Category Image</label>
                                    <input type="file" name="categoryimage" id="categoryimage" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="categoryname">Category Name</label>
                                    <input type="text" value="<?=$details['categoryname'];?>" name="categoryname" id="categoryname" class="form-control" placeholder="Enter Category Name">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?=$this->include('templates/admin/footer');?>
<script type="text/javascript" src="<?=base_url();?>assets/js/admin/editcategory.js"></script>