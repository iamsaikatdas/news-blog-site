<?php include "header.php";

if ($_SESSION['role'] == 0) {
    # code...
    header("Location: http://localhost/php/news-site/admin/post.php");
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <?php
                    // connection string
                    include "../config.php";

                    // for pagination
                    $limit = 5;

                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }
                    $offset = ($page - 1) * $limit;


                    $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit}";

                    $fetchUser = mysqli_query($conn, $sql) or die("Get all user query stoped");

                    if (mysqli_num_rows($fetchUser) > 0) {
                        # code...
                        while ($data = mysqli_fetch_assoc($fetchUser)) {
                            # code...
                    ?>
                            <tbody>

                                <tr>
                                    <td class='id'><?php echo $data['user_id'] ?></td>
                                    <td><?php echo $data['first_name'] . " " . $data["last_name"] ?></td>
                                    <td><?php echo $data['username'] ?></td>
                                    <td><?php if ($data['role'] == 0) {
                                            echo "Normal";
                                        } else {
                                            echo "Admin";
                                        } ?></td>
                                    <td class='edit'><a href="update-user.php?id=<?php echo $data['user_id'] ?>"><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href="delete-user.php?id=<?php echo $data['user_id'] ?>"><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            </tbody>
                    <?php
                        }
                    } else {
                        echo "<p>No user found.</p>";
                    }
                    ?>
                </table>
                <?php
                $sql2 = 'select * from user';
                if ($result = mysqli_query($conn, $sql2)) {

                    $total_records = mysqli_num_rows($result);
                    $total_pages = ceil($total_records / $limit);

                    echo " <ul class='pagination admin-pagination'>";

                    if ($page > 1) {
                        echo '<li><a href="users.php?page=' . ($page - 1) . '">Prev</a></li>';
                    }


                    for ($i = 1; $i <= $total_pages; $i++) {
                        # code...
                        if ($i == $page) {
                            # code...
                            $active = "active";
                        } else {
                            $active = "";
                        }
                        echo '<li class="' . $active . '"><a href="users.php?page=' . $i . '" >' . $i . '</a></li>';
                    }
                    if ($total_pages > $page) {
                        echo '<li><a href="users.php?page=' . ($page + 1) . '">Next</a></li>';
                    }

                    echo "</ul>";
                }
                mysqli_close($conn);

                ?>

                <!-- <li class="active"><a>1</a></li> -->
            </div>
        </div>
    </div>
</div>
<?php include "header.php"; ?>