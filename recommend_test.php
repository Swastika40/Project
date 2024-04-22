<?php

require_once("connection.php");
require_once("recommend.php");
require_once("sample_list.php");

if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM users where id = '$id'";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $_SESSION['username'] = $row['username'];
    }
}
$username = $_SESSION['username'];
// print_r($books);

$re = new Recommend();
$array = $re->getRecommendations($product, $username);
$recommend_list = array_slice($array, 0, 4);

// print_r($recommend_list);