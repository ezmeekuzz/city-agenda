<?=$this->include('templates/admin/header');?>
<div class="app-container">
    <?=$this->include('templates/admin/sidebar');?>
    <div class="app-main" id="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h1>Add Blog</h1>
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
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Add Blog</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <form id="addblog" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card card-statistics">
                            <div class="card-header">
                                <div class="card-heading">
                                    <h4 class="card-title float-left"><i class="ti ti-pin2"></i> Blog</h4>
                                    <div class="float-right">
                                        <div class="form-group">
                                            <div class="checkbox checbox-switch switch-success">
                                                <label>
                                                    <input type="checkbox" value = "Yes" name="publishstatus" />
                                                    <span></span>
                                                    Publish
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter Description" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" name="content" id="content" placeholder="Enter Content"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-statistics">
                            <div class="card-header">
                                <div class="card-heading">
                                    <h4 class="card-title float-left"><i class="ti ti-tag"></i> Category & Tags</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Search Category</label>
                                    <input type="text" id="searchcategory" name="searchcategory" onkeyup="filter();" class="form-control" placeholder="Enter Title">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="categorylist"> Category List</label>
                                    <div class="catList" style="max-height: 220px !important; overflow: auto;">
                                        <ul class="list-group" id="categorylist">
                                            <?php if($categories) : ?>
                                            <?php foreach($categories as $list) : ?>
                                                <li class="list-group-item">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="category_id<?=$list['category_id'];?>" value = "<?=$list['category_id'];?>" name = "category_id[]">
                                                        <label class="form-check-label" for="category_id<?=$list['category_id'];?>"><?=$list['categoryname'];?></label>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="blogimage">Blog Image</label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="blogimage">Choose file</label>
                                        <input type="file" class="custom-file-input" id="blogimage" name="blogimage" accept="image/png, image/gif, image/jpeg">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12 selects-contant-boots">
                                        <label for="tags">Tags</label>
                                        <div class="form-group mb-2 bs-select-1">
                                            <input type="text" class="bs-input" name="tags" id="tags" data-role="tagsinput" />
                                        </div>
                                    </div>
                                    <button type="submit" id="submit" class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?=$this->include('templates/admin/footer');?>
<script type="text/javascript" src="<?=base_url();?>assets/js/admin/addblog.js"></script>