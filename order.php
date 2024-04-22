<?php
session_start();
include "connection.php";
if (!isset($_SESSION["id"])) {
  header("location: login.php");
}

$sesid=$_SESSION['id'];
$query= mysqli_query($link,"SELECT * FROM users WHERE id='$sesid'");
$data=mysqli_fetch_assoc($query);


$kg = $_GET['kg'];
if (isset($_POST['order'])) {
  if(!empty($_POST['name']) && !empty($_POST['contact']) && !empty($_POST['address'])){
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $total = $_POST['total'];
    $product_name = $_POST['product_name'];

    $sql = "INSERT INTO `order` (`name`, `contact`, `address`, `total`, `product_name`, `date`) 
VALUES ('$name', '$contact', '$address', '$total', '$product_name', current_timestamp());";
    if (mysqli_query($link, $sql)) {
        $_SESSION['order'] = "Order Successful!";
        header("location: index.php");
    } else {
        echo "Fail";
    }
  }else{
    $_SESSION['error'] = "Please input all data!";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=N, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,700;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
    <title>Admin</title>
    <style>
      .navbar{
        background: honeydew;
      }
        .body{
          background: url(images/background.jpg);
  background-size: cover;
  color: #000;
          display:flex;
  justify-content: center;
  display: flex;
  padding-bottom: 100px;
        }
        .wrapper {
  justify-content: center;
  margin-top: 80px;
  width: 360px;
  padding: 30px;
  background: white;
  z-index: 1;
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
          <a class="nav-link active" aria-current="page" href="index.php#product">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="body">
<div class="wrapper">
        <div class="box text-center">
        <?php 
          if(isset($_SESSION['error'])){
            echo $_SESSION['error'];
            unset($_SESSION['error']);
          }
        ?>
        <?php
            $pid = $_GET['pid'];
            $sql = "SELECT * FROM products WHERE pid = '$pid';";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_array($result);
            $total = $kg * $row['price'];
            ?>
        <h1 class="p-4" align="center">Shop Now</h1>
        <form action="" method="post" align="center">
            <table align="center" width="100%">
                <tr>
                    <th><label for="name">Name</label></th>
                    <td><input type="text" id="name" name="name" value="<?php echo $data['username'] ?>"></td>
                </tr>
                <tr>
                <th><label for="contact">Contact</label></th>
                <td><input type="number" id="contact" name="contact" value="" required value></td>
                </tr>
                <tr>
                <th><label for="address">Address</label></th>
                <td><input type="text" id="address" name="address" value=""></td>
                </tr>
            </table>
            <input type="hidden" name="kgs" value="<?php echo $kg ?>">
            <input type="hidden" name="product_name" value="<?php echo $row['name'] ?>">
            <p><strong><?php echo "Total Amount : Rs." . $total; ?></strong></p>
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <button class="btn btn-danger" name="order">Cash on Delivery</button>
        </form>
        <form action="https://uat.esewa.com.np/epay/main" method="POST">
          <input value="<?php echo $total ?>" name="tAmt" type="hidden">
          <input value="<?php echo $total -20 ?>" name="amt" type="hidden">
          <input value="0" name="txAmt" type="hidden">
          <input value="20" name="psc" type="hidden">
          <input value="0" name="pdc" type="hidden">
          <input value="EPAYTEST" name="scd" type="hidden">
          <input value="<?php echo $invoice ?>" name="pid" type="hidden">
          <input value="http://localhost/Anna/success.php?q=su" type="hidden" name="su">
          <input value="http://localhost/Anna/failed.php?q=fu" type="hidden" name="fu">
          <input class="text-center " src="images/esewa.png" type="image" width="100">
        </form>
        </div>
    </div>
</div>


</body>

</html>