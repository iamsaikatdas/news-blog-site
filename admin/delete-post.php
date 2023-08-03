<?php
include "../config.php";

$id = $_GET['id'];
$cat_id = $_GET['catid'];

$sql2 = "SELECT * FROM post WHERE post_id={$id}";
$result = mysqli_query($conn, $sql2);
$data = mysqli_fetch_assoc($result);

// remove the photo
unlink("upload/" . $data['post_img']);


$sql = "DELETE FROM post WHERE post_id={$id};";
$sql .= "UPDATE category SET post = post - 1 WHERE category_id ={$cat_id}";

if (mysqli_multi_query($conn, $sql)) {
    # code...
    header("Location: http://localhost/php/news-site/admin/post.php");
} else {
    echo "Query failed";
}
