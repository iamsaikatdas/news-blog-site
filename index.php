<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                include "config.php";

                $limit = 3;
                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }
                $offset = ($page - 1) * $limit;

                $sql = "SELECT * FROM post 
                left join category on post.category = category.category_id 
                LEFT JOIN user on post.author = user.user_id 
                ORDER BY post_id DESC LIMIT {$offset}, {$limit}";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    # code...
                    while ($a = mysqli_fetch_assoc($result)) {
                        # code...
                ?>

                        <div class="post-container">
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php"><img src="./admin/upload/<?php echo $a['post_img'] ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php'><?php echo $a['title'] ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?php echo $a['category_id'] ?>'><?php echo $a['category_name'] ?></a>
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
                                            <p class="description">
                                                <?php echo substr($a['description'], 0, 100) . " ..." ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $a['post_id'] ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div><!-- /post-container -->
                <?php
                    }
                } else {
                    echo "<div><h1>Please, post somethings...</h1></div>";
                }
                ?>
                <?php


                $sql2 = "SELECT * FROM post";

                if ($result2 = mysqli_query($conn, $sql2)) {
                    $total_records = mysqli_num_rows($result2);


                    $total_page = ceil($total_records / $limit);

                    echo " <ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        # code...
                        echo '<li><a href="index.php?page=' . $page - 1 . '">Prev</a></li>';
                    }

                    for ($i = 1; $i <= $total_page; $i++) {
                        # code...
                        if ($total_page == 1) {
                            # code...
                        } else {

                            if ($page == $i) {
                                # code...
                                $active = "active";
                            } else {
                                $active = "";
                            }
                            echo '<li class=' . $active . ' ><a href="index.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    if ($page < $total_page) {
                        # code...
                        echo '<li><a href="index.php?page=' . $page + 1 . '">Next</a></li>';
                    }
                    echo "</ul>";
                }
                ?>
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>