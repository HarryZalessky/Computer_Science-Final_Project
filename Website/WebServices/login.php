<?php
//require 'dbConnect.php';
require 'functions.php';
session_start();
if(isset($_POST['submit'])) {
    if(filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['username'];
        $password = $_POST['password'];
        $link = openPerConn();
        if(checkUserExist('1', $email, $link) == 2) {
            $stmt = $link->prepare("SELECT * FROM users WHERE email LIKE ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $arr = $arr[0];
            if(md5(md5($password).md5($arr['salt'])) == md5($arr['passhash'].md5($arr['salt']))) {
                if($arr['must_validate'] == 1) {
                    if(isset($_GET['verify'])) {
                        if(md5() == $_GET['verify']) {
                            $stmt = $link->prepare("UPDATE users SET must_validate=0 WHERE `id`= ?");
                            $stmt->bind_param('i',$arr['id']);
                            $stmt->execute();
                            $_SESSION['USER_ID'] = $arr['id'];
                            
                        } else {
                            header("Location: ../GUI/index.php?popup=login&username=$email&error=3");
                        }
                    } else {
                        //check if login allowed, if yes login with not verified user permissions, if no show error message
                        
                    }
                } else {
                    $_SESSION['USER_ID'] = $arr['id'];
                }
            } else {
                header("Location: ../GUI/index.php?popup=login&username=$email&error=2");
            }
        } else {
            header("Location: ../GUI/index.php?popup=login&username=$email&error=1");
        }
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $link = openPerConn();
        if(checkUserExist($username, '1', $link) == 1) {
            $stmt = $link->prepare("SELECT * FROM users WHERE username LIKE ?");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $arr = $arr[0];
            if(md5(md5($password).md5($arr['salt'])) == md5($arr['passhash'].md5($arr['salt']))) {
                if($arr['must_validate'] == 1) {
                    if(isset($_GET['verify'])) {
                        if(md5() == $_GET['verify']) {
                            $stmt = $link->prepare("UPDATE users SET must_validate=0 WHERE `id`= ?");
                            $stmt->bind_param('i',$arr['id']);
                            $stmt->execute();
                            $_SESSION['USER_ID'] = $arr['id'];
                        } else {
                            header("Location: ../GUI/index.php?popup=login&username=$username&error=3");
                        }
                    } else {
                        //check if login allowed, if yes login with not verified user permissions, if no show error message
                    }
                } else {
                    
                }
            } else {
                header("Location: ../GUI/index.php?popup=login&username=$username&error=2");
            }
        } else {
            header("Location: ../GUI/index.php?popup=login&username=$username&error=1");
        }
    }
}
closeConn($link);
header('Location: ../GUI/');
?>