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
          <a class="nav-link active" aria-current="page" href="admin-account.php">Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin-products.php">Products</a>
        </li>
        <li class="nav-item">
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
  <h1>Accounts</h1>
  <a class="btn btn-primary" href="add-admin.php">Add Admin</a><br><br>
<?php
// Attempt select query execution
$sql = "SELECT * FROM users";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      ?>
        <table border="1">
          <tr>
            <th>SN</th>
            <th>Role</th>
              <th>Username</th>
              <th>Password</th>
              <th></th>
          </tr>
          <?php
          $sn=1;
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $sn++ . "</td>";
            echo "<td>" . $row['role'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
              echo "<td>" ?> <a href="delete.php?id=<?php echo $row['id'] ?> ">Delete</a> <?php "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>
</div>
</body>
</head>