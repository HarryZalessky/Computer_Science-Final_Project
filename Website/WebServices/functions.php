<?php
require 'dbConnect.php';

function sessionManager() {
    session_start();
        
    $link = openPerConn();
    $results;
    if(isset ($_SESSION['USER_ID'])) {
        if(isset($_SESSION['USERAGENT'])) {
            if($_SESSION['USERAGENT'] === $_SERVER['HTTP_USER_AGENT']) {
                loginSuccessfulSetters();
                return;
            } else {
                unset($_SESSION['USER_ID']);
                unset($_SESSION['USERAGENT']);
                $_SESSION['USERAGENT'] = $_SERVER['HTTP_USER_AGENT'];
            }
        } else {
            unset($_SESSION['USER_ID']);
            $_SESSION['USERAGENT'] = $_SERVER['HTTP_USER_AGENT'];
        }
    } elseif (isset ($_COOKIE['publickey'])) {
        if(strlen($_COOKIE['publickey']) >= 33) {
            $publickey = substr($_COOKIE['publickey'], -32);
            $userid = substr($_COOKIE['publickey'], 0, -32);
            if($results = $link->query("SELECT * FROM `autologin` WHERE `user_id` = ".$userid." AND `publickey` = '".$publickey."'")) {
                $resultArr = mysqli_fetch_all($results, MYSQLI_ASSOC);
                foreach ($resultArr as $row) {
                    foreach($row['privatekey'] as $value) {
                        if($value === genPrivateString($userid)) {
                            $_SESSION["USER_ID"] = $userid;
                            $_SESSION["USERAGENT"] = $_SERVER["HTTP_USER_AGENT"];
                            loginSuccessfulSetters();
                            return;
                        }
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
            $result = $link->query("SELECT * FROM `groups` WHERE `group_name` LIKE 'Guest'");
            $arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $groupid = intval($arr[0]['id']);
            $_SESSION["GROUP_ID"] = $groupid;
        }
    }
    closeConn($link);
}
function checkUserExist($username, $email, $conn) {
    if($stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` LIKE ?")) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row_cnt=$result->num_rows;
        if($row_cnt>0) {
            return 1;
        }
        $result=NULL;
    } else {
        $error = $conn->errno . ' ' . $conn->error;
    echo $error; // 1054 Unknown column 'foo' in 'field list'
    }
    $stmt = $conn->prepare("SELECT * FROM users WHERE email LIKE ?");
    $stmt->bind_param('s', $email);
    if($stmt->execute()) {
        $result = $stmt->get_result();
        $row_cnt=$result->num_rows;
        if($row_cnt>0) {
            return 2;
        }
    } else {
        $error = $conn->errno . ' ' . $conn->error;
    echo $error; // 1054 Unknown column 'foo' in 'field list'
    }
    return 0;
}
function checkEmailBanned($email, $conn) {
    if($stmt = $conn->prepare("SELECT notes FROM `banned_emails` WHERE ? LIKE `email_regex`")) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row_cnt=$result->num_rows;
        if($row_cnt>0) {
            $error = mysqli_fetch_assoc($result)['notes'];
            return $error;
        }
    } else {
        $error = $conn->errno . ' ' . $conn->error;
    echo $error; // 1054 Unknown column 'foo' in 'field list'
    }
    return 0;
}
function genSalt($max) {
        $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
        $i = 0;
        $salt = "";
        while ($i < $max) {
            $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
            $i++;
        }
        return $salt;
};
function hashPass($password) {
    return md5($password);
}
function genHash($salt, $passHash) {
    return md5($passHash.md5($salt));
}
function insertUser($conn, $username, $email, $salt, $passHash, $regIp) {
    if($stmt = $conn->prepare("INSERT INTO `users`(`username`, `email`, `salt`, `passhash`, `reg_date`, `last_login_date`, `reg_ip`, `last_login_ip`, `must_validate`) VALUES (?,?,?,?,now(),now(),?,?, 1)")) {
        $stmt->bind_param('ssssii', $username, $email, $salt, $passHash, $regIp, $regIp);
        $result = $stmt->execute();
        if($conn->errno===0) {
            return 0;
        } else {
            return 'Couldn\'t complete the registration. please contact us at "Webmaster@devlancer.com" for further info' ;
        }
    } else {
        $error = $conn->errno . ' ' . $conn->error;
    echo $error; // 1054 Unknown column 'foo' in 'field list'
    }
}
function genPrivateKey($userid) {
    $link = openPerConn();
    $stmt = $conn->prepare("SELECT salt FROM `users` WHERE `id` = :userid");
    $stmt->bindParam(':userid', $userid);
    if($result = $stmt->execute()) {
        $result = $stmt->get_result();
        $arr = mysqli_fetch_array($result, MYSQLI_NUM);
        $salt = $arr[0];
    }
    return md5(md5($salt).md5($_SERVER['HTTP_USER_AGENT']));
}
function grabPofileImage($userid) {
    $image = '../profile_images/'.$userid.'.*';
    $res = glob($image);
    if(!empty($res)) {
        return $res[0];
    } else {
        return '../profile_images/default.jpg';
    }
    
}
function loginSuccessfulSetters() {
    $link = openPerConn();
    $stmt = $link->prepare("SELECT * FROM users WHERE id LIKE ?");
    $stmt->bind_param('i', $_SESSION['USER_ID']);
    $stmt->execute();
    $result = $stmt->get_result();
    $arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $arr = $arr[0];
    
    $_SESSION['full_name'] = $arr['full_name'];
    closeConn($link);        
}
    ?>