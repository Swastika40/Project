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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,700;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3518b857db.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
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
                                <a class="nav-link" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="search.php">Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contact">Contact</a>
                            </li>
                            <?php
                            if (isset($_SESSION["id"])) {
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
            </nav>
            <div class="row">
                <div class="col">
                    <h1>For us<br> For the Nation</h1>
                    <p>Nepal is richly endowed with agro-biodiversity.<br> Rice, maize, millet, wheat, barley and
                        buckwheat are the major staple food<br>
                        crops. Similarly, oilseeds, potato, tobacco, sugarcane, jute and cotton are<br>
                        the important cash crops whereas lentil, gram, pigeon pea, blackgram, horsegram and <br>soyben
                        are the important pulse crops.</p>
                    <a href="search.php" class="btn">Explore Now &#8594;</a>
                </div>
            </div>
        </div>

        <!-- Images -->

        <div class="row text-center sample">
            <div class="col-lg-4 col-md-6 py-4">
                <img src="images/sample.jpg" height="250px" width="300PX">
            </div>
            <div class="col-lg-4 col-md-6 py-4">
                <img src="images/sample2.jpg" height="250px" width="300PX">
            </div>
            <div class="col-lg-4 col-md-12 py-4">
                <img src="images/sample3.jpg" height="250px" width="300PX">
            </div>
        </div>

        <!----Featured Catogories-->
        <div class="catogories">
            <img src="images/grains.jpg" class="center">
        </div>

        <!-- Products -->
        <h1 class="text-center p-4">Featured Products</h1>
        <div class="row">
        <?php
                $sql = "SELECT * FROM products LIMIT 3";
                $result = mysqli_query($link, $sql);
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
                <?php }
                ?>
        </div>

        <!----Recommend products-->
        <?php
        if (isset($_SESSION["id"])) {
            $id = $_SESSION["id"];
            $sql = "SELECT * FROM users where id = '$id'";
            $result = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
            }
            $sql = "SELECT * FROM rating WHERE uid = '$id'";
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) > 0) {
        ?>
                <div class="small-container text-center">
                    <div class="tit">
                        <span class="title">Recommend Products</span>
                    </div>
                    <div class="row">
                        <?php
                        include("recommend_test.php");

                        foreach ($recommend_list as $key => $value) {

                            $sql = "SELECT * FROM products WHERE name = '$key'";
                            $result = mysqli_query($link, $sql);
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <div class="col-md-6 text-center">
                                    <a href="desc.php?pid=<?php echo $row['pid']; ?>">
                                        <img src="upload/<?php echo $row['location']; ?>" alt="soyabean" width="300px" height="230px">
                                        <h4 class="pb-3"><?php echo $row['name']; ?></h4>
                                        <p >Rating: 
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
                <?php
                            }
                        }
                    }
                }
                ?>
                    </div>
                </div>

                <!--Featured-->
                <div id="about" class="featured">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="text">
                            <h1>Exclusive</h1>
                            <h3><b>Importance of its</b></h3><br>Wheat is a grass widely cultivated for its seed,
                            a cereal grain which is a<br> worldwide staple food.The many species of wheat
                            together make up <br>the genus Triticum; the most widely grown is common
                            wheat<br> (T. aestivum).</p>
                        </div>
                    </div>
                </div>


                <!-- Services -->
                <div class="services text-center">
                    <h1 class="pb-4">Our Services</h1>
                    <div class="row text-center">
                        <div class="col-md-6">
                            <h3><i class="fas fa-truck"></i></h3>
                            <h2>Home Delivery</h2>
                        </div>
                        <div class="col-md-6">
                            <h3><i class="fas fa-hand-holding-usd"></i></h3>
                            <h2>Cash on Delivery</h2>
                        </div>
                    </div>
                </div>

                <!---Footer-->
                <div id="contact" class="footer text-center">
                    <img src="images/logo2.png" alt="" width="120px">
                    <div class="row text-center pb-2">
                        <div class="col-md-6 py-4">
                            <h2><i class="fas fa-map-marked-alt"></i></h2>
                            <h5><a href="https://www.google.com/maps/place/Saugal+Sthan+Ganesh/@27
                    .6708969,85.3246045,17z/data=!3m1!4b1!4m5!3m4!1s0x0:0x70272af29d7b9aae!8m2!3d27.
                    6709049!4d85.3267764"> Address : Saugal,Lalitpur</a></h5>
                        </div>
                        <div class="col-md-6 py-4">
                            <h2><i class="fas fa-mobile-alt"></i></h2>
                            <h5><a href="tel:9807327271"> Contact : 9807327271</a></h5>
                        </div>
                    </div>
                    <h3>Experience our Service</h3>
                    <a href="https://www.facebook.com/" target="blank"><i class="fab fa-facebook fa-2x px-2" title="Facebook"></i></a>
                    <a href="https://www.instagram.com/" target="blank"><i class="fab fa-instagram fa-2x px-2" title="Instagram"></i></a>
                    <a href="https://www.whatsapp.com/" target="blank"><i class="fab fa-whatsapp fa-2x px-2" title="Whatsapp"></i></i></a>
                </div>

</body>

</html>