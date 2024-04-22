<?php
session_start();
include "connection.php";
if(isset($_SESSION['id'])){
  if($_SESSION['role'] == 'user'){
    header("location: index.php");
  }
}else{
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=N, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,700;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  <title>Admin</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Anna</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="admin-account.php">Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin-products.php">Products</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="admin-order.php">Order</a>
          </li>
          <li class="nav-item">
          <a styles="color:red;" class="nav-link" href="logout.php">Logout</a>
        </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <h1>Orders</h1>
        <table border="1">
          <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Total</th>
            <th>Product Name</th>
            <th>Date</th>
            <th>Order</th>
          </tr>
          <?php
          $sn = 1;
          $sql = "SELECT * FROM `order`";
          $result = mysqli_query($link, $sql);
                  while($row = mysqli_fetch_array($result)){
                      echo "<tr>";
                          echo "<td>" . $sn++ . "</td>";
                          echo "<td>" . $row['name'] . "</td>";
                          echo "<td>" . $row['contact'] . "</td>";
                          echo "<td>" . $row['address'] . "</td>";
                          echo "<td>" ."Rs.". $row['total'] . "</td>";
                          echo "<td>" . $row['product_name'] . "</td>";
                          echo "<td>" . $row['date'] . "</td>";
                          echo "<td>"?> <a href="delete.php?oid=<?php echo $row['oid']; ?>">Delete</a> <?php "</td>";
                      echo "</tr>";
                  }
                  echo "</table>";      
?>
  </div>
</body>
</head>