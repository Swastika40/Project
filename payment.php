<?php
session_start();
include "connection.php";
if (!isset($_SESSION["id"])) {
  header("location: login.php");
}

$sesid=$_SESSION['id'];
$query= mysqli_query($link,"SELECT * FROM users WHERE id='$sesid'");
$data=mysqli_fetch_assoc($query);
$invoice=$_SESSION['id'].time();

$name = $_POST['name'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$total = $_POST['total'];
$product_name = $_POST['product_name'];
$kg = $_POST['kgs'];
if (isset($_POST['order'])) {
  if(!empty($_POST['name']) && !empty($_POST['contact']) && !empty($_POST['address'])){



    $sql = "INSERT INTO `order` (`name`, `contact`, `address`, `total`, `product_name`, `date`) 
    VALUES ('$name', '$contact', '$address', '$total', '$product_name', current_timestamp());";
    if (mysqli_query($link, $sql)) {
        //echo "Success";

        $_SESSION['order'] = "Order Successful!";
        header("location: index.php");
        die;
    } else {
        echo "Fail";
    }
  }else{
    $_SESSION['error'] = "Please input all data!";
  }
}
// if (isset($_POST['order'])) {
  // if(!empty($_POST['name']) && !empty($_POST['contact']) && !empty($_POST['address'])){
  //   $name = $_POST['name'];
  //   $contact = $_POST['contact'];
  //   $address = $_POST['address'];
  //   $total = $_POST['total'];
  //   $product_name = $_POST['product_name'];
  //   $kg = $_POST['kgs'];


  //   $sql = "INSERT INTO `order` (`name`, `contact`, `address`, `total`, `product_name`, `date`) 
  //   VALUES ('$name', '$contact', '$address', '$total', '$product_name', current_timestamp());";
  //   if (mysqli_query($link, $sql)) {
  //       //echo "Success";

  //       $_SESSION['order'] = "Order Successful!";
  //       header("location: index.php");
  //   } else {
  //       echo "Fail";
  //   }
  // }else{
  //   $_SESSION['error'] = "Please input all data!";
  // }
// }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Payment</title>
</head>
<body>
    <h2 class="text-primary">Payment Methods</h2>

<div class="d-flex container">
    <a href="success.php" class="btn btn-secondary text-light px-3 py-0">Cash on Delivery</a>
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
</body>
</html>
