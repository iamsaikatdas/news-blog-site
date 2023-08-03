<?php

include "../config.php";

if (isset($_POST['submit'])) {
    # code...

    if (isset($_FILES['fileToUpload'])) {
        # code...
        $error = array();

        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $file_type = $_FILES['fileToUpload']['type'];
        $find_file_ext = explode('.', $file_name);

        $file_ext = strtolower(end($find_file_ext));
        $extentions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extentions) === false) {
            $error[] = "This extentions file not allowed, Please choose a JPG, JPEG or PNG type";
        }
        if ($file_size > 2097152) {
            $error[] = "File size must be 2mb or lower";
        }


        if (empty($error) == true) {
            move_uploaded_file($file_tmp, "./upload/" . $file_name);
        } else {
            print_r($error);
            die();
        }

        $title = mysqli_real_escape_string($conn, $_POST['post_title']);
        $desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);

        // date auto 
        session_start();
        $author = $_SESSION['user_id'];


        $sql = "INSERT INTO post(title, description, category, author, post_img)
            VALUES('{$title}', '{$desc}', '{$category}', '{$author}','{$file_name}' )";


        if (mysqli_query($conn, $sql)) {
            # code...

            $sql2 = "UPDATE category SET post = post + 1 WHERE category_id ={$category}";

            if (mysqli_query($conn, $sql2)) {

                header("Location: http://localhost/php/news-site/admin/post.php");
            }
        }
    }


    mysqli_close($conn);
}
