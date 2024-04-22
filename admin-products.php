<?php
session_start();
include "connection.php";
if(isset($_SESSION['id'])){
  if($_SESSION['role'] == 'user'){
   // header("location: index.php");
  }
}else{
   //  header("location: index.php");
}
?>
<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if file was uploaded without errors
  if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["photo"]["name"];
    $filetype = $_FILES["photo"]["type"];
    $filesize = $_FILES["photo"]["size"];

    // Verify file extension
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

    // Verify file size - 5MB maximum
    $maxsize = 5 * 1024 * 1024;
    if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

    // Verify MYME type of the file
    if (in_array($filetype, $allowed)) {
      // Check whether file exists before uploading it
      if (file_exists("upload/" . $filename)) {
        echo $filename . " is already exists.";
      }
    } else {
      echo "Error: There was a problem uploading your file. Please try again.";
    }
  } else {
    echo "Please upload image!";
  }
  $filename = rand(0, 9) . $filename;

  // database name upload

  $name = $_POST['name'];
  $location = $filename;
  $price = $_POST['price'];

  $sql = "INSERT INTO `products` (`name`, `location`, `price`) VALUES ('$name', '$location', '$price');";
  if (mysqli_query($link, $sql)) {
    move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $filename);
    echo "Upload Sucessfully";
  } else {
    echo "Fail";
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
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,700;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
  </script>
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
            <a class="nav-link active" href="admin-products.php">Products</a>
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
    <form action="" method="post" enctype="multipart/form-data">
      <h2>Upload File</h2>
      Product Name :
      <input type="text" name="name" required><br>
      Price:
      <input type="number" name="price" required><br>
      <label for="fileSelect">Filename:</label>
      <input type="file" name="photo" id="fileSelect" required><br>
      <input type="submit" name="submit" value="Upload"><br>
      <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</p>
    </form><br><br>
    <h1>Products</h1>
    <?php
    // Attempt select query execution
    $sql = "SELECT * FROM products";
    if ($result = mysqli_query($link, $sql)) {
      if (mysqli_num_rows($result) > 0) {
    ?>
        <table border="1">
          <tr>
            <th>SN</th>
            <th>Prodcuts Name</th>
            <th>Price</th>
            <th>Image</th>
            <th></th>
          </tr>
          <?php
          $sn = 1;
          while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $sn++ . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . "Rs." . $row['price'] . "</td>";
            echo "<td>" ?> <img src="upload/<?php echo $row['location'] ?>" alt="image" width="200px"> <?php echo "</td>";
                                                                                          echo "<td>" ?> <a href="delete.php?pid=<?php echo $row['pid'] ?> ">Delete</a>
      <?php "</td>";
            echo "</tr>";
          }
          echo "</table>";
          // Free result set
          mysqli_free_result($result);
        } else {
          echo "No records matching your query were found.";
        }
      } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
      ?>
  </div>
</body>
</head>