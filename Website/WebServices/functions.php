<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'dbConnect.php';
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
    ?>