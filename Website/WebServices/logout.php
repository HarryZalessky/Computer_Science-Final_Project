<?php
session_start();
if(isset($_SESSION["USER_ID"])) {
    unset($_SESSION["USER_ID"]);
}
if(isset($_COOKIE["publickey"])) {
    unset($_COOKIE["publickey"]);
}
header("location:../GUI");
?>