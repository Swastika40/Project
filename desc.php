<?php
session_start();
require_once "connection.php";

$pid = $_GET['pid'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=N, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="rating.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,700;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
  </script>
  <!-- Fontawesome css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- Fontawesome js -->
  <script src="https://kit.fontawesome.com/caa7c84843.js" crossorigin="anonymous"></script>
  <title>Anna</title>
  <style>
    body {
      background: honeydew;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="images/logo2.png" width="10px"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="search.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container text-center py-2">
    <p><?php
        if (isset($_SESSION['error'])) {
          echo $_SESSION['error'];
          unset($_SESSION['error']);
        }
        ?>
    </p>
    <?php
    $sql = "SELECT * FROM products WHERE pid = '$pid';";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    ?>
    <img src=" upload/<?php echo $row['location']; ?>" width="400">
    <h1><?php echo $row['name']; ?></h1>
    <h2>1kg = Rs.<?php echo $row['price']; ?></h2>
    <form action="order.php" method="GET">
      <input type="hidden" name="pid" value="<?php echo $pid; ?>">
      <input type="number" id="kg" name="kg" min="1" required>
      <button type="shop">Shop Now</button>
    </form>
    <div class="rating">
      <!-- Rating -->

      <div class="rated">
        <h2 style="color : red">User Rating</h2>
        <p class="b text-center px">
          <?php
          $rate = 0;
          $pid = $_GET['pid'];
          $sql = "SELECT * FROM rating WHERE pid = '$pid'";
          $result = mysqli_query($link, $sql);
          $reviews = mysqli_num_rows($result);
          if ($reviews > 0) {
            while ($row = mysqli_fetch_array($result)) {
              $rate += $row['rating'];
            }
            $rate = $rate / $reviews;
            $rate =  number_format($rate, 1);
            echo $rate;
          } else {
            echo 0;
          }
          ?>
        </p>
        <p>based on <?php echo $reviews; ?> reviews.</p>
      </div>
      <?php
      if (isset($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $sql = "SELECT * FROM users where id = '$id'";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_array($result)) {
          $uid = $row['username'];
        }
        $sql = "SELECT * FROM rating WHERE uid = '$id' AND pid = '$pid'";
        $result = mysqli_query($link, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
          $rating = mysqli_fetch_array($result);
          $rid = $rating['rid'];
          $rate = $rating['rating'];
      ?>
          <div class="star-wrapper">
            <p class="px">Your Review</p>
            <a href="rating.php?re=5&rid=<?php echo $rid; ?>" class="fas fa-star s1" onclick="return confirm('Are you sure want to update rate?')" title="5"></a>
            <a href="rating.php?re=4&rid=<?php echo $rid; ?>" class="fas fa-star s2" onclick="return confirm('Are you sure want to update rate?')" title="4"></a>
            <a href="rating.php?re=3&rid=<?php echo $rid; ?>" class="fas fa-star s3" onclick="return confirm('Are you sure want to update rate?')" title="3"></a>
            <a href="rating.php?re=2&rid=<?php echo $rid; ?>" class="fas fa-star s4" onclick="return confirm('Are you sure want to update rate?')" title="2"></a>
            <a href="rating.php?re=1&rid=<?php echo $rid; ?>" class="fas fa-star s5" onclick="return confirm('Are you sure want to update rate?')" title="1"></a>
          </div>
          <script>
            <?php

            while ($rate >= 1) {
            ?>
              document.getElementsByClassName('s<?php echo 6 - $rate; ?>')[0].style.color = "yellow";
            <?php
              $rate--;
            }
            ?>
          </script>
        <?php } else {
        ?>
          <div class="star-wrapper">
            <p class="px">Please Give Your Review</p>
            <a href="rating.php?rate=5&pid=<?php echo $pid; ?>" class="fas fa-star s1" onclick="return confirm('Are you sure want to rate?')" title="5"></a>
            <a href="rating.php?rate=4&pid=<?php echo $pid; ?>" class="fas fa-star s2" onclick="return confirm('Are you sure want to rate?')" title="4"></a>
            <a href="rating.php?rate=3&pid=<?php echo $pid; ?>" class="fas fa-star s3" onclick="return confirm('Are you sure want to rate?')" title="3"></a>
            <a href="rating.php?rate=2&pid=<?php echo $pid; ?>" class="fas fa-star s4" onclick="return confirm('Are you sure want to rate?')" title="2"></a>
            <a href="rating.php?rate=1&pid=<?php echo $pid; ?>" class="fas fa-star s5" onclick="return confirm('Are you sure want to rate?')" title="1"></a>
          </div>
      <?php }
      }
      ?>
      <!-- End of Rating -->
    </div>
  </div>
</body>

</html>