<?php
require_once '../WebServices/sessionManager.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/style.css">
        <title>DevLancer - Developer jobs for freelancers</title>
    </head>
    <body>
        <?php 
            if(isset($_SESSION["USER_ID"])){
                require_once '../includes/header_signed-in.php';
            } else {
                require_once '../includes/header.php';
            }
        ?>
        <script type="text/javascript" src="/scripts.js"></script>
    </body>
</html>