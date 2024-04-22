<?php
session_start();
include "connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=N, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,700;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3518b857db.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
    <title>CART</title>
</head>

<body>
    <div class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                
                    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span styles="color:black;"><i class="fas fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="search.php">Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php/Contact">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cart.php">CART</a>
                            </li>
                            <?php 
                            if (isset($_SESSION["id"])) {?> <?php
                                $id = $_SESSION["id"];
                                $sql = "SELECT * FROM users where id = '$id'";
                                $result = mysqli_query($link, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    $_SESSION['role'] = $row['role'];
                                }
                                if ($_SESSION['role'] == 'admin') { ?>
                                    <li><a class="nav-link" href="admin-account.php"><?php echo $_SESSION["username"]; ?></a></li>
                                <?php  } else { ?>
                                   <li class="nav-item"><a class="nav-link"><?php echo $_SESSION["username"]; ?></a></li>
                                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                                <?php   }}
                                ?>
<li>

<ol>
<?php


    $name ="SELECT username FROM users where id='$id'";
    $cart = "SELECT * from orders where name='$name'";
    $cartshow = mysqli_query($link, $cart);

?>  </ol>
</li>

</body>
</html>