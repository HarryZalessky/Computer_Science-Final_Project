<?php
require 'dbConnect.php';
function checkUserExist($username, $email, $conn) {
    if($result = $conn->query("SELECT * FROM users WHERE username LIKE '" . $username . "'")) {
        $row_cnt=$result->num_rows;
        if($row_cnt>0) {
            return 1;
        }
        $result=NULL;
    }
    if($result = $conn->query("SELECT * FROM users WHERE email LIKE '" . $email . "'")) {
        $row_cnt=$result->num_rows;
        if($row_cnt>0) {
            return 2;
        }
    }
    return 0;
}
function checkEmailBanned($email, $conn) {
    $result = $conn->query("SELECT notes FROM `banned_emails` WHERE '" .$email. "' LIKE `email_regex`");
    $row_cnt=$result->num_rows;
    if($row_cnt>0) {
        $error = mysqli_fetch_assoc($result)['notes'];
        return $error;
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
    $result = $conn->query("INSERT INTO `users`(`username`, `email`, `salt`, `passhash`, `reg_date`, `last_login_date`, `reg_ip`, `last_login_ip`) VALUES ('".$username."','".$email."','".$salt."','".$passHash."',now(),now(),".$regIp.",".$regIp.")");
    if($conn->errno===0) {
        return 0;
    } else {
        return 'Couldn\'t complete the registration. please contact us at "Webmaster@devlancer.com" for further info' ;
    }
}
    ?>