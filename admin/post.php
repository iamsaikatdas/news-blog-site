<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <?php
                    include "../config.php";

                    $limit = 5;
                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }
                    $offset = ($page - 1) * $limit;

                    if ($_SESSION['role'] == 1) {
                        # code...
                        $sql = "SELECT * FROM `post` 
                    left join category on post.category = category.category_id 
                    LEFT JOIN user on post.author = user.user_id 
                    ORDER BY post_id DESC LIMIT {$offset}, {$limit}";
                    } else {
                        $sql = "SELECT * FROM `post` 
                        left join category on post.category = category.category_id 
                        LEFT JOIN user on post.author = user.user_id 
                        WHERE post.author = {$_SESSION['user_id']}
                        ORDER BY post_id DESC LIMIT {$offset}, {$limit}";
                    }

                    $getAllPost = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($getAllPost)) {
                        # code...
                        while ($data = mysqli_fetch_assoc($getAllPost)) {
                            # code...
                    ?>

                            <tbody>
                                <tr>
                                    <td class='id'><?php echo $data['post_id'] ?></td>
                                    <td><?php echo $data['title'] ?></td>
                                    <td><?php echo $data['category_name'] ?></td>
                                    <td><?php echo $data['post_date'] ?></td>
                                    <td><?php echo $data['username'] ?></td>
                                    <td class='edit'><a href='update-post.php?id=<?php echo $data['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-post.php?id=<?php echo $data['post_id']; ?>&catid=<?php echo $data['category'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            </tbody>
                    <?php
                        }
                    }

                    ?>
                </table>
                <?php
                if ($_SESSION['role'] == 1) {
                    $sql2 = "SELECT * FROM post";
                } else {
                    $sql2 = "SELECT * FROM post  WHERE post.author = {$_SESSION['user_id']}";
                }
                if ($result = mysqli_query($conn, $sql2)) {
                    $total_records = mysqli_num_rows($result);


                    $total_page = ceil($total_records / $limit);

                    echo " <ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        # code...
                        echo '<li><a href="post.php?page=' . $page - 1 . '">Prev</a></li>';
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
                            echo '<li class=' . $active . ' ><a href="post.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    if ($page < $total_page) {
                        # code...
                        echo '<li><a href="post.php?page=' . $page + 1 . '">Next</a></li>';
                    }
                    echo "</ul>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>