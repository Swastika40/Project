<?php
// Include config file
include "connection.php";
if(isset($_SESSION['id'])){
    if($_SESSION['role'] == 'user'){
      header("location: index.php");
    }
  }
  if(isset($_GET['id'])){
$id = $_GET['id'];
$sql = "SELECT * FROM users where id='$id'";
if($result = mysqli_query($link, $sql)){
while($row = mysqli_fetch_array($result)){
  $username = $row['username'];
  $role = $row['role'];
}
}
}
 
  if(isset($_POST['update'])){
    $username = $_POST['username'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET
     username = '$username',
     role = '$role',
     password = 'fa'
    WHERE id='$id';";
    if(mysqli_query($link,$sql)){
        header("location: admin-account.php");
    }else{
        die("error");
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Update</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                <input type="hidden" value="">
            </div>
            Role:
            <select name="role" id="role">
                <option value="admin" <?php if(isset($role)){if($role=='admin'){ echo "selected";}}?>>Admin</option>
                <option value="user" <?php if(isset($role)){if($role=='user'){ echo "selected";}}?>>User</option>
            </select> 
            <br><br>
            <div class="form-group">
            <div class="form-group">
                <input type="submit" name="update" class="btn btn-primary" value="Update">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>