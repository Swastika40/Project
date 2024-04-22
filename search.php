<?php
session_start();
include "connection.php";

if (isset($_SESSION['order'])) { ?>
    <div class="text-center bg-dark" style="color: white;"><?php echo $_SESSION['order']; ?></div>
<?php
unset($_SESSION['order']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=N, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,700;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3518b857db.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
    <title>Anna</title>
</head>

<body>
    <div class="header">
        <div class="container">
        <nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href=""><img src="images/logo2.png" width="100px"></a>
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
          <a class="nav-link" href="index.php#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php#contact">Contact</a>
        </li>
        <?php
        if (isset($_SESSION["id"])) {
            $id = $_SESSION["id"];
            $sql = "SELECT * FROM users where id = '$id'";
            $result = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($result)){
                $_SESSION['role']= $row['role'];
            }
            if($_SESSION['role'] =='admin'){ ?>
        <li><a class="nav-link" href="admin-account.php"><?php echo $_SESSION["username"]; ?></a></li>
          <?php  }else{ ?>
            <li class="nav-item"><a class="nav-link"><?php echo $_SESSION["username"]; ?></a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
         <?php   }
        ?>
        <?php
        } else {
        ?>
        <li><a class="nav-link" href="login.php">Account</a></li>
        <?php
        }
        ?>
        <li class="nav-item">
            <form action="search.php" method="get">
                <input type="text" name="search" id="search">
                <button type="submit">Search</button>
            </form>
        </li>
      </ul>
    </div>
  </div>
    </div>
    </div>
        <h1 class="text-center"><?php if(isset($_GET['search'])){ echo "Search";}else{ echo "Products";} ?></h1>
        <div id="product" class="container text-center">
            <div class="tit">
            </div>
            <div class="row">
                <?php
                if(isset($_GET['search'])){
                    $search = $_GET['search'];
                    $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
                    $result = mysqli_query($link, $sql);
                }else{
                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($link, $sql);
                }
                if($result){
                 while ($row = mysqli_fetch_array($result)) { ?>
                 
                <div class="card col-md-4 text-center">
                    <a href="desc.php?pid=<?php echo $row['pid']; ?>">
                        <img src="upload/<?php echo $row['location']; ?>" alt="soyabean" width="300px" height="230px">
                        <h4 class="pb-3"><?php echo $row['name']; ?></h4>
                        <p class="box">Rating: 
                        <?php
                          $rate = 0;
                          $pid = $row['pid'];
                          $ssql = "SELECT * FROM rating WHERE pid = '$pid'";
                          $rresult = mysqli_query($link, $ssql);
                          $reviews = mysqli_num_rows($rresult);
                          if ($reviews > 0) {
                            while ($rrow = mysqli_fetch_array($rresult)) {
                              $rate += $rrow['rating'];
                            }
                            $rate = $rate / $reviews;
                            $rate =  number_format($rate, 1);
                            echo $rate;
                          } else {
                            echo 0;
                          }
                        ?></p>
                    </a>
                </div>
                <?php }}
                if(mysqli_num_rows($result) < 1){ ?>
                    <h3 class="text-center">No Item Found</h3>
                <?php
                }
                ?>
            </div>
        </div>
</body>

</html>