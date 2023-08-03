<?php

if ($_SESSION['role'] == 0) {
    # code...
    header("Location: http://localhost/php/news-site/admin/post.php");
}

include "../config.php";

$id = $_GET['id'];

$sql = "DELETE FROM category WHERE category_id={$id}";

if (mysqli_query($conn, $sql)) {
    # code...
    header("Location: http://localhost/php/news-site/admin/category.php");
} else {
    echo "<p>Cannot delete this category</p>";
}
mysqli_close($conn);
