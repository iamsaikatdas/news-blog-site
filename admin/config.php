    <?

    if ($_SESSION['role'] == 0) {
        # code...
        header("Location: http://localhost/php/news-site/admin/post.php");
    }
    ?>