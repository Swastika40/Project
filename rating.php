<?php
session_start();
include("connection.php");
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM users where id = '$id'";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $uid = $row['id'];
    }
}

if (isset($_GET['rate']) && isset($_GET['pid'])) {
    $rate = $_GET['rate'];
    if ($rate > 5 || $rate < 1) {
        die("Thank you for Hacking!");
    }
    $pid = $_GET['pid'];
    $sql = "INSERT INTO `rating` (`uid`, `rating`,`pid`) VALUES ('$uid', '$rate','$pid');";
    $result = mysqli_query($link, $sql);
}
if (isset($_GET['re']) && isset($_GET['rid'])) {
    $rate = $_GET['re'];
    if ($rate > 5 || $rate < 1) {
        die("Thank you for Hacking!");
    }
    $rid = $_GET['rid'];
    $query = "UPDATE `rating` SET
        rating = '$rate'
        WHERE rid = '$rid'
        ";
    mysqli_query($link, $query);
}
?>
<script>
    history.go(-1);
</script>