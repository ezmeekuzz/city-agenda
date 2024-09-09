<?=$this->include('templates/header');?>
<section class="container-fluid banner inner-page blog-inner">
        <div class="container d-flex flex-column align-items-center gap-5">
            <div class="row">
                <div class="col-md-8">
                    <h3><?=$blogDetails['title'];?></h3>
                    <ul>
                        <li><a href="#"><?=date('F d, Y', strtotime($blogDetails['dateadded']));?></a></li>
                        <li><a href="#"><?=$blogDetails['tags'];?></a></li>
                        <li><a href="#">BY <?=$blogDetails['firstname'] . ' ' . $blogDetails['lastname'];?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>



    <section class="container-fluid inner-section">
        <div class="container">
            <div class="row flex-lg-row flex-md-column">
                <div class="col-lg-8 col-md-12 d-flex flex-column gap-5">
                    <div class="blog-item">
                        <img src="<?=base_url() . $blogDetails['blogimage'];?>">
                        <?= $blogDetails['content'] ; ?>
                    </div>
                    <!--<div class="prev-next-sect">
                        <button class="main-btn">
                            Newer Post
                            <i class="bi bi-arrow-up-right"></i>
                        </button>
                        <button class="main-btn">
                            Older Post
                            <i class="bi bi-arrow-up-right"></i>
                        </button>
                    </div>-->
                </div>
                <div class="col-lg-4 col-md-12 justify-content-start ps-lg-5 ps-md-0 pt-md-5 pt-lg-0 side-bar">

                    <div class="poster-card blog-inner-post">
                        <div class="post-image">
                            <img src="<?=base_url();?>img/postImg1.webp">
                        </div>
                        <div class="p-3 post-details">
                            <div class="post-title">
                                <h5>May 27, 2024 |  3 Min</h5>
                                <h2>Why Hiring A Sourcing Agency?</h2>
                            </div>
                            <button class="post-card-btn">
                                Read More
                            </button>
                        </div>
                    </div>

                    <h4>Recent Post</h4>

                    <div class="blog-list">
                        <?php if($recentBlogLists) : ?>
                        <?php foreach($recentBlogLists as $list) : ?>
                        <div class="blog-list-item">
                            <img src="<?=base_url() . $list['blogimage'];?>">
                            <div class="list-item-details">
                                <h5><?=$list['title'];?></h5>
                                <ul>
                                    <li><a href="#"><?=date('F d, Y', strtotime($list['dateadded']));?></a></li>
                                    <!--<li><a href="#">3 Min</a></li>-->
                                </ul>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif;?>
                    </div>

                    <h4>Select Category</h4>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        All Categories
                        </button>
                        <ul class="dropdown-menu">
                            <?php if($categoryLists) : ?>
                            <?php foreach($categoryLists as $list) : ?>
                            <li><a class="dropdown-item" href="/blogs?category=<?=$list['categoryname'];?>"><?=$list['categoryname'];?></a></li>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="container-fluid banner blog-inner-section">
        <div class="container d-flex flex-column align-items-center gap-5">
            <div class="row flex-lg-row flex-column-reverse">
                <div class="col-lg-4 col-md-12">
                    <img src="<?=base_url();?>img/blog-inner-sec.webp">
                </div>
                <div class="col-lg-8 col-md-12 d-flex flex-column justify-content-center align-items-end testimonial-sec">
                    <p>Online Entrepreneur And Marketing Expert, Passionate About All Aspects Of Online Business And Always Looking For Innovative Solutions. </p>
                    <h5>- Author Name</h5>
                </div>
            </div>
        </div>
    </section>




    <section class="container-fluid inner-section section-gray">
        <div class="container">
            <h3>Related Post</h3>
            <div class="row mt-5">
                <?php if($blogLists) : ?>
                <?php foreach($blogLists as $list) : ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-lg-0 mb-md-0 mb-5 d-flex gap-3 flex-column related-card">
                    <img src="<?=base_url() . $list['blogimage'];?>">
                    <h5><?=$list['title'];?></h5>
                    <ul>
                        <li><a href="#"><?=date('F d, Y', strtotime($list['dateadded']));?></a></li>
                        <li><a href="#"><?=$list['tags'];?></a></li>
                    </ul>
                    <p><?=$list['description'];?></p>
                    <button class="main-btn" onclick="window.location.href='/<?=$list['slug'];?>'">
                        Continue Reading
                    </button>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?=$this->include('templates/footer');?>