<?=$this->include('templates/header');?>
<section class="container-fluid banner inner-page blog-main">
        <div class="container d-flex flex-column align-items-center gap-2">
            <h3>Get Better At Events</h3>
            <h5>Explore latest insights, news and researched information on event<br> planning, marketing and ticketing. Know events better!</h5>
        </div>
    </section>
    <section class="container-fluid inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 d-flex flex-column gap-5">
                    <?php if($blogLists) : ?>
                    <?php foreach($blogLists as $list) : ?>
                    <div class="blog-item">
                        <img src="/<?=$list['blogimage'];?>">
                        <h3><?=$list['title'];?></h3>
                        <ul>
                            <li><a href="#"><?=date('F d, Y', strtotime($list['dateadded']));?></a></li>
                            <li><a href="#"><?=$list['tags'];?></a></li>
                            <li><a href="#">BY <?=$list['firstname'];?> <?=$list['lastname'];?></a></li>
                        </ul>
                        <p><?=$list['description'];?></p>
                        <button class="main-btn" onclick="window.location.href='<?=$list['sl'];?>'">
                            Continue Reading
                            <i class="bi bi-arrow-up-right"></i>
                        </button>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 col-md-12 justify-content-start ps-0 ps-lg-5 side-bar">
                    <form class="mb-5" action="/blogs" method="GET">
                        <h4>Search Blog</h4>
                        
                        <input type="text" placeholder="Type Here" class="form-control" name="title" id="title">
                        
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
                    </form>

                    <h4>Recent Post</h4>

                    <div class="blog-list">
                        <?php if($recentBlogLists) : ?>
                        <?php foreach($recentBlogLists as $list) : ?>
                        <div class="blog-list-item">
                            <img src="/<?=$list['blogimage'];?>">
                            <div class="list-item-details">
                                <h5><?=$list['title'];?></h5>
                                <ul>
                                    <li><a href="#"><?=date('F d, Y', strtotime($list['dateadded']));?></a></li>
                                    <li><a href="#">3 Min</a></li>
                                </ul>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <h4>Category</h4>

                    <div class="category-card">
                        <ul>
                            <?php if($categoryLists) : ?>
                            <?php foreach($categoryLists as $list) : ?>
                            <li>
                                <a>
                                    <i class="bi bi-play-fill"></i>
                                    <?=$list['categoryname'];?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>


                    <div class="poster-card">
                        <div class="post-image">
                            <img src="img/postImg1.webp">
                        </div>
                        <div class="p-3 post-details">
                            <div class="post-title">
                                <h5>May 27, 2024<!-- |  3 Min--></h5>
                                <h2>Why Hiring A Sourcing Agency?</h2>
                            </div>
                            <button class="post-card-btn">
                                Read More
                            </button>
                        </div>
                    </div>
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