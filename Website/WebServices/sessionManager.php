<?php
    //require '../webServices/dbConnect.php';
    require '../webServices/functions.php';
    session_start();
    $link;
    $results;
    if(isset ($_SESSION["USER_ID"])) {
        if(isset($_SESSION["USERAGENT"])) {
            if($_SESSION["USERAGENT"] === $_SERVER["HTTP_USER_AGENT"]) {
                //login();
            } else {
                header('Location: '/*.session stealing error page*/);
            }
        } else {
            header('Location: '/*.session stealing error page*/);
        }
    } elseif (isset ($_COOKIE["publickey"])) {
        if(strlen($_COOKIE["publickey"]) >= 33) {
            $publickey = substr($_COOKIE["publickey"], -32);
            $userid = substr($_COOKIE["publickey"], 0, -32);
            if($results = $link->query("SELECT * FROM `autologin` WHERE `user_id` = ".$userid." AND `publickey` = '".$publickey."'")) {
                $resultArr = mysqli_fetch_all($results, MYSQLI_ASSOC);
                foreach ($resultArr["privatekey"] as $value) {
                    if($value === genPrivateString($userid)) {
                        //Login();
                    }
                }
                goto Guest;
            } else {
                goto Guest;
            }
        } else {
            goto Guest;
        }
    } else {
        goto Guest;
        Guest: {
            $link = openPerConn();
            $groupid = $link->query("SELECT id FROM `groups` WHERE `group_name` LIKE 'Guest'");
            closeConn($link);
            $_SESSION["GROUP_ID"] = $groupid;
        }
    }
?>