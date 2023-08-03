<?php include "header.php";

$id = $_GET['id'];


?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">

                <?php
                include "../config.php";

                $id = $_GET['id'];
                $sql = "SELECT * FROM post where post_id={$id}";

                $getPostById = mysqli_query($conn, $sql);

                if (mysqli_num_rows($getPostById) > 0) {
                    # code...
                    while ($data = mysqli_fetch_assoc($getPostById)) {
                        # code...
                ?>

                        <!-- Form for show edit-->
                        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="post_id" class="form-control" value="<?php echo $data['post_id'] ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTile">Title</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $data['title'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Description</label>
                                <textarea name="postdesc" class="form-control" required rows="4"><?php echo $data['description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCategory">Category</label>
                                <select class="form-control" name="category" value="<?php echo $data['category_id'] ?>">
                                    <option value="" selected disabled>Select One</option>
                                    <?php
                                    $sql2 = "SELECT * FROM category";
                                    $category = mysqli_query($conn, $sql2) or die("Post, category query failed");


                                    if (mysqli_num_rows($category)) {
                                        while ($data2 = mysqli_fetch_assoc($category)) {
                                            if ($data['category'] == $data2["category_id"]) {
                                                $selec = "selected";
                                            } else {
                                                $selec = "";
                                            }
                                            echo "<option $selec value={$data2['category_id']} >{$data2['category_name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="old_category" value="<?php echo $data['category'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Post image</label>
                                <input type="file" name="new-image">
                                <img src="./upload/<?php echo $data['post_img'] ?>" alt="Image not found" height="150px">
                                <input type="hidden" name="old_image" value="<?php echo $data['post_img'] ?>">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                        </form>
                        <!-- Form End -->
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>