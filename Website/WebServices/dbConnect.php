<?php
error_reporting(E_ERROR | E_PARSE);
require_once 'psl-config.php';


    function openConn() {
        $conn = new mysqli(HOST, USER, PASS, DBNAME);
        if($conn->connect_error) {
            die("Couldn't connect");
            return -1;
        }
        return $conn;
    }
    function openPerConn() {
        $conn = mysqli_connect('p:' . HOST, USER, PASS, DBNAME);
        if($conn->connect_error) {
            die("Couldn't connect");
            return -1;
        }
        return $conn;
    }
    function closeConn($conn) {
        mysqli_close($conn);
    }
