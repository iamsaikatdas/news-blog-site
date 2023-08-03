
<?php
session_start();
session_unset();
session_destroy();

header("Location: http://localhost/php/news-site/admin");

?>