<?php
    session_start();
    if(isset($_SESSION["loggedin"]) && isset($_SESSION["id"]) && isset($_SESSION["username"])){
        unset($_SESSION["loggedin"]);
        unset($_SESSION["id"]);
        unset($_SESSION["username"]);
    }
    header("location: login.php");
?>