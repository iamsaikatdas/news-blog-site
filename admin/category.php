<?php include "header.php";

if ($_SESSION['role'] == 0) {
    # code...
    header("Location: http://localhost/php/news-site/admin/post.php");
} ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <?php

                    include "../config.php";

                    // for pagination
                    $limit = 5;
                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }
                    $offset = ($page - 1) * $limit;

                    $sql = "SELECT * FROM category  ORDER BY category_id DESC LIMIT {$offset}, {$limit}";
                    $getAllCategory = mysqli_query($conn, $sql) or die("Get all category failed query");

                    if (mysqli_num_rows($getAllCategory) > 0) {
                        # code...
                        while ($data = mysqli_fetch_assoc($getAllCategory)) {
                            # code...
                    ?>
                            <tbody>
                                <tr>
                                    <td class='id'><?php echo $data['category_id'] ?></td>
                                    <td><?php echo $data['category_name'] ?></td>
                                    <td><?php echo $data['post'] ?></td>
                                    <td class='edit'><a href='update-category.php?id=<?php echo $data['category_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-category.php?id=<?php echo $data['category_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            </tbody>
                    <?php
                        }
                    }

                    ?>
                </table>
                <?php
                $sql2 = "SELECT * FROM category";
                if ($result = mysqli_query($conn, $sql2)) {
                    $total_records = mysqli_num_rows($result);


                    $total_page = ceil($total_records / $limit);

                    echo " <ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        # code...
                        echo '<li><a href="category.php?page=' . $page - 1 . '">Prev</a></li>';
                    }

                    for ($i = 1; $i <= $total_page; $i++) {
                        # code...
                        if ($page == $i) {
                            # code...
                            $active = "active";
                        } else {
                            $active = "";
                        }
                        echo '<li class=' . $active . ' ><a href="category.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                    if ($page < $total_page) {
                        # code...
                        echo '<li><a href="category.php?page=' . $page + 1 . '">Next</a></li>';
                    }
                    echo "</ul>";
                }
                ?>

                <!-- <li class="active"><a>1</a></li> -->

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>