<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        include 'config.php';

        $limit = 5;

        $sql = "SELECT * FROM post 
        left join category on post.category = category.category_id 
        ORDER BY post_id DESC LIMIT {$limit}";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            # code...
            while ($a = mysqli_fetch_assoc($result)) {
                # code...
        ?>

                <div class="recent-post">
                    <a class="post-img" href="">
                        <img src="./admin//upload/<?php echo $a['post_img'] ?>" alt="" />
                    </a>
                    <div class="post-content">
                        <h5><a href="single.php"><?php echo $a['title'] ?></a></h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php'><?php echo $a['category_name'] ?></a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $a['post_date'] ?>
                        </span>
                        <a class="read-more" href="single.php?id=<?php echo $a['post_id'] ?>">read more</a>
                    </div>
                </div>
        <?php }
        }

        ?>

    </div>
</div>
<!-- /recent posts box -->
</div>