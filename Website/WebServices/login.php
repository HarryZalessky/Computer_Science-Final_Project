<?php
session_start();
if(isset($_POST['submit'])) {
    if(filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['username'];
        $password = $_POST['password'];
        $link = openPerConn();
        if(checkUserExist('1', $email, $link) == 2) {
            $stmt = $link->prepare("SELECT * FROM users WHERE email LIKE :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if(md5(md5($password).md5($arr['salt'])) == md5($arr['passhash'].md5($arr['salt']))) {
                if($arr[must_verify] == 1) {
                    if(isset($_POST['']))
                }
            } else {
                //wrong
            }
        } else {
            //wrong
        }
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $link = openPerConn();
        if(checkUserExist($username, '1', $link) == 1) {
            
        } else {
            //wrong
        }
    }
}
?>