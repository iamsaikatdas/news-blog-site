<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->

                <?php
                include 'config.php';

                $id = $_GET['id'];


                $sql = "SELECT * FROM post 
                left join category on post.category = category.category_id 
                LEFT JOIN user on post.author = user.user_id WHERE post_id={$id}";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    # code...
                    while ($a = mysqli_fetch_assoc($result)) {
                        # code...
                ?>
                        <div class="post-container">
                            <div class="post-content single-post">
                                <h3><?php echo $a['title'] ?></h3>
                                <div class="post-information">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        <?php echo $a['category_name'] ?>
                                    </span>
                                    <span>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <a href='author.php?aid=<?php echo $a['user_id'] ?>'><?php echo $a['username'] ?></a>
                                    </span>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?php echo $a['post_date'] ?>
                                    </span>
                                </div>
                                <img class="single-feature-image" src="./admin//upload/<?php echo $a['post_img'] ?>" alt="" />
                                <p class="description">
                                    <?php echo $a['description'] ?>
                                </p>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>