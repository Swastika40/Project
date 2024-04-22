<?php
include "connection.php";
// Attempt delete query execution
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id='$id'";
    if(mysqli_query($link, $sql)){
        header("location: admin-account.php");
    }
}

if(isset($_GET['pid'])){
    $pid = $_GET['pid'];
    $sql = "DELETE FROM products WHERE pid='$pid'";
    if(mysqli_query($link, $sql)){
        header("location: admin-products.php");
    }
}

if(isset($_GET['oid'])){
    $oid = $_GET['oid'];
    $sql = "DELETE FROM `order` WHERE `order`.`oid` = '$oid'";
    if(mysqli_query($link, $sql)){
        header("location: admin-order.php");
    }
}

?>