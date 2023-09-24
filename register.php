<?php

include "conn.php";

if(isset($_POST['sub']))
{
    $chose_id = $_POST['id'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM `users` WHERE chosen_id = '$chose_id' && Pass = '$pass'";
    $res1 = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res1))
    {
        echo "<script>alert('User already exists');</script>";
    }
    else{
    $sql = "INSERT INTO `users`(`chosen_id`, `Pass`) VALUES ($chose_id,'$pass')";
    $result = mysqli_query($conn,$sql);
    header('Location: login.php');
    }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Air For Share Clown</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
  <br>
    <a href="login.php"><button class="btn btn-danger w-100">Login</button></a>
    <form method="post" class="m-5">
  <div class="mb-3">
    <input type="number" min="0" name = "id" required name="" placeholder="Choose id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <input type="password" required name="pass" class="form-control" id="exampleInputPassword1">
  </div>

  <button name="sub" type="submit" class="btn btn-primary w-100">Submit</button>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>