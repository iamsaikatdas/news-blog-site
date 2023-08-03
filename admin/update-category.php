<?php include "header.php";


if ($_SESSION['role'] == 0) {
    # code...
    header("Location: http://localhost/php/news-site/admin/post.php");
}


// update category;
include "../config.php";

if (isset($_POST['submit'])) {
    # code...
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $cName = mysqli_real_escape_string($conn, $_POST['cat_name']);


    $sql1 = "UPDATE category SET category_name='{$cName}' WHERE category_id='{$id}'";

    if (mysqli_query($conn, $sql1)) {
        # code...
        header("Location: http://localhost/php/news-site/admin/category.php");
    }
}


?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- get category by id -->
                <?php

                $sql = "SELECT * FROM category where category_id='{$_GET['id']}'";
                $getCatgoryById = mysqli_query($conn, $sql) or die("Update category failed");
                # code...
                if (mysqli_num_rows($getCatgoryById) > 0) {
                    # code...
                    while ($data = mysqli_fetch_assoc($getCatgoryById)) {
                        # code...
                ?>

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="cat_id" class="form-control" value="<?php echo $data['category_id'] ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="cat_name" class="form-control" value="<?php echo $data['category_name'] ?>" placeholder="" required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                <?php
                    }
                } else {
                    echo "<p>Category not found</p>";
                }


                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>