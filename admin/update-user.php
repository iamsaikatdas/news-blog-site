<?php include "header.php";


if ($_SESSION['role'] == 0) {
    # code...
    header("Location: http://localhost/php/news-site/admin/post.php");
}

// update data
include "../config.php";

if (isset($_POST['submit'])) {

    $id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fName = mysqli_real_escape_string($conn, $_POST['fName']);
    $lName = mysqli_real_escape_string($conn, $_POST['lName']);
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    # code...
    $sql1 = "UPDATE user 
    SET first_name='{$fName}', last_name='{$lName}', username='{$user}', 
    role='{$role}' WHERE user_id={$id}";

    $updateUserById = mysqli_query($conn, $sql1) or die("Update by user id faile query");
    header("Location: http://localhost/php/news-site/admin/users.php");
}
mysqli_close($conn);

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <?php
                    $id = $_GET['id'];

                    include "../config.php";
                    $sql = "SELECT * FROM user WHERE user_id={$id}";

                    $getUsreById = mysqli_query($conn, $sql) or die("Get user By id update user query error");

                    if (mysqli_num_rows($getUsreById) > 0) {
                        # code...
                        while ($data = mysqli_fetch_assoc($getUsreById)) {
                            # code...

                    ?>

                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $data['user_id'] ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="fName" class="form-control" value="<?php echo $data['first_name'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lName" class="form-control" value="<?php echo $data['last_name'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $data['username'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role" value="<?php echo $data['role']; ?>">

                                    <?php

                                    if ($data['role'] == 1) {
                                        echo "<option value='0'>normal User</option>
                                              <option value='1' selected >Admin</option>";
                                    } else {
                                        echo "<option value='0' selected> normal User</option>
                                              <option value='1'>Admin</option>";
                                    }

                                    ?>

                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                </form>
                <!-- /Form -->
        <?php
                        }
                    }

                    mysqli_close($conn);
        ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>