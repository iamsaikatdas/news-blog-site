<?php
include "../config.php";

if (isset($_POST['submit'])) {
    # code...
    if (empty($_FILES['new-image']['name'])) {
        # code...
        $file_name = $_POST['old_image'];
    } else {

        $error = array();

        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_tmp = $_FILES['new-image']['tmp_name'];
        $file_type = $_FILES['new-image']['type'];
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
    }
    $id = mysqli_real_escape_string($conn, $_POST['post_id']);
    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);



    $sql = "UPDATE post SET title='{$title}', description='{$desc}', category='{$category}', post_img='{$file_name}' 
                WHERE post_id='{$id}'";

    $getPost = "SELECT * FROM post WHERE post_id={$id}";
    if ($result = mysqli_query($conn, $getPost)) {
        # code...
        while ($a = mysqli_fetch_assoc($result)) {
            # code...
            if ($a['category'] == $category) {
                # code...
                mysqli_query($conn, $sql);
                header("Location: http://localhost/php/news-site/admin/post.php");
            } else {
                mysqli_query($conn, $sql);
                $sql5 = "UPDATE category SET post = post + 1 WHERE category_id ={$category} ;";
                $sql5 .= "UPDATE category SET post = post - 1 WHERE category_id ={$_POST['old_category']}";


                if (mysqli_multi_query($conn, $sql5)) {
                    header("Location: http://localhost/php/news-site/admin/post.php");
                }
            }
        }
    }
}
