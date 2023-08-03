<?php
include "config.php";

$page_title =  basename($_SERVER['PHP_SELF']);
// echo $page_title;

switch ($page_title) {
    case 'index.php':
        $page_title = "Home: News";
        break;

    case 'category.php':
        $page_title = "Category: News";
        break;

    case 'author.php':
        $page_title = "Author: News";
        break;

    case 'search.php':
        $page_title = "Search: News";
        break;

    default:
        # code...
        break;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <a href="index.php" id="logo"><img src="images/news.jpg"></a>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class='menu'>
                        <li><a href='./index.php'>Home</a></li>
                        <?php
                        include "config.php";
                        $sql = "SELECT * FROM category WHERE post > 0";
                        $result = mysqli_query($conn, $sql);
                        $active = "";

                        if (isset($_GET['cid'])) {
                            # code...
                            $cat_id = $_GET['cid'];
                        }

                        if (mysqli_num_rows($result) > 0) {
                            # code...
                            while ($a  = mysqli_fetch_assoc($result)) {
                                # code...
                                if (isset($_GET['cid'])) {
                                    if ($a['category_id'] == $cat_id) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                }


                                echo "<li><a class='{$active}' href='category.php?cid={$a['category_id']}'>{$a['category_name']}</a></li>";
                            }
                        }

                        session_start();
                        if (isset($_SESSION['user_id'])) { ?>
                            <li><a href='./admin/logout.php'>Logout</a></li>
                        <?php
                        } else { ?>
                            <li><a href='./admin/post.php'>Login</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->