<?php

include("connection.php");

$user = "SELECT * FROM `users`";
$user_result = $link->query($user);
if ($user_result->num_rows > 0) {
    while ($user_row = $user_result->fetch_assoc()) {
        $username = $user_row['username'];
        $id = $user_row['id'];
        $rating = "SELECT * FROM rating WHERE uid = '$id'";
        $rating_result = $link->query($rating);
        if ($rating_result->num_rows > 0) {
            while ($rating_row = $rating_result->fetch_assoc()) {
                $pid = $rating_row['pid'];
                $hotel = "SELECT * FROM products WHERE pid = '$pid'";
                $hotel_result = $link->query($hotel);
                if ($hotel_result->num_rows > 0) {
                    while ($product_row = $hotel_result->fetch_assoc()) {
                        $p = $product_row["name"];
                        $datasets[$username][$p] = $rating_row['rating'];
                    }
                }
            }
        }
    }
}

$product = $datasets;
