<?php
//error_reporting(0);
include "conn.php";
error_reporting(0);
$user_id = $_SESSION['choosen_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['sub']))
{
  $ch=curl_init();
  curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  $result=curl_exec($ch);
  $result=json_decode($result);
  
  if($result->status=='success'){
    // echo "Country:".$result->country.'<br/>';
    // echo "Region:".$result->regionName.'<br/>';
    // echo "City:".$result->city.'<br/>';
    // if(isset($result->lat) && isset($result->lon)){
    //   echo "Lat:".$result->lat.'<br/>';
    //   echo "Lon:".$result->lon.'<br/>';
    // }
    
    //   echo "IP:".$result->query.'<br/>';
    
  }
  $res_ip = md5($result->query);
  
   $chosen_id = $user_id;
   $message = $_POST['message'];
   $sql = "SELECT * FROM `messages` WHERE message = '$message' AND chosen_id = $user_id AND `ip` = '$res_ip'";
  $res = mysqli_query($conn,$sql);

  if(mysqli_num_rows($res))
  {
    echo'<script>alert("form has been submitted already");</script>';
  }
  else{
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $result=curl_exec($ch);
    $result=json_decode($result);
    
    if($result->status=='success'){
      echo "Country:".$result->country.'<br/>';
      echo "Region:".$result->regionName.'<br/>';
      echo "City:".$result->city.'<br/>';
      if(isset($result->lat) && isset($result->lon)){
        echo "Lat:".$result->lat.'<br/>';
        echo "Lon:".$result->lon.'<br/>';
      }
      
        echo "IP:".$result->query.'<br/>';
      
    }
    $encrypted = md5($result->query);
   $sql = "INSERT INTO `messages`(`chosen_id`, `message`,`ip`) VALUES ($chosen_id,'$message','$encrypted')";
   $res = mysqli_query($conn,$sql);
   header('Location: home.php');
  }
  
  }
 

  if(isset($_POST['up']))
  {
    $chosen_id = $user_id;
    $message2 = $_POST['message'];
    $sql = "SELECT * FROM `messages` WHERE `message` = '$message2' AND `chosen_id` = $user_id";
   $res = mysqli_query($conn,$sql);
   if(mysqli_num_rows($res))
   {
     echo'<script>alert("form is already same");</script>';
   }

   else{  
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $result=curl_exec($ch);
    $result=json_decode($result);
    
    if($result->status=='success'){
      // echo "Country:".$result->country.'<br/>';
      // echo "Region:".$result->regionName.'<br/>';
      // echo "City:".$result->city.'<br/>';
      // if(isset($result->lat) && isset($result->lon)){
      //   echo "Lat:".$result->lat.'<br/>';
      //   echo "Lon:".$result->lon.'<br/>';
      // }
      
      //   echo "IP:".$result->query.'<br/>';
      

    }
    $a = md5($result->query);
   $sql = "UPDATE `messages` SET `message`='$message2',`ip`='$a' WHERE `ip` = '$a'";
   $res = mysqli_query($conn,$sql);
   header('Location: home.php');

   
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
    <?php
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $result=curl_exec($ch);
    $result=json_decode($result);
    
    if($result->status=='success'){
      // echo "Country:".$result->country.'<br/>';
      // echo "Region:".$result->regionName.'<br/>';
      // echo "City:".$result->city.'<br/>';
      // if(isset($result->lat) && isset($result->lon)){
      //   echo "Lat:".$result->lat.'<br/>';
      //   echo "Lon:".$result->lon.'<br/>';
      // }
      
      //   echo "IP:".$result->query.'<br/>';
      

    }
    $res_ip = $result->query;
echo '<h1>'.$res_ip.'</h1>';
    ?>
    <a href="logout.php"><button class="btn btn-danger w-100">Logout</button></a>
    <form method="post">
    <div class="form-floating m-5">
      
   <textarea id = "inp"  class="form-control p-5" name="message" placeholder="Type something..." id="floatingTextarea2" style="height: 100px"><?php
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result=curl_exec($ch);
$result=json_decode($result);

if($result->status=='success'){
  // echo "Country:".$result->country.'<br/>';
  // echo "Region:".$result->regionName.'<br/>';
  // echo "City:".$result->city.'<br/>';
  // if(isset($result->lat) && isset($result->lon)){
  //   echo "Lat:".$result->lat.'<br/>';
  //   echo "Lon:".$result->lon.'<br/>';
  // }
  
    // echo "IP:".$result->query.'<br/>';
  
}
$a = md5($result->query);
$sql = "SELECT * FROM `messages` WHERE chosen_id = $user_id AND `ip` = '$a'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
if(mysqli_num_rows($res)  > 0)
{
echo $row['message'];
}

else
{
  echo "";
}

?></textarea>
  <label for="floatingTextarea2 ">Text</label>
    <br>
    <?php
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $result=curl_exec($ch);
    $result=json_decode($result);
    
    if($result->status=='success'){
      // echo "Country:".$result->country.'<br/>';
      // echo "Region:".$result->regionName.'<br/>';
      // echo "City:".$result->city.'<br/>';
      // if(isset($result->lat) && isset($result->lon)){
      //   echo "Lat:".$result->lat.'<br/>';
      //   echo "Lon:".$result->lon.'<br/>';
      // }
      
        // echo "IP:".$result->query.'<br/>';
      
    }
    $a = md5($result->query);
$sql = "SELECT * FROM `messages` WHERE `ip` ='$a'";
$res = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($res);
if($row['message'] == "")
{
  echo '<button id="btn"  
  name="sub" type="submit" class="btn btn-outline-dark btn-lg  w-100">Save</button>
  <br><br>';
}
else{
  echo '<button id="btn"  
  name="up" type="submit" class="btn btn-outline-dark btn-lg  w-100">Update</button>
  <br><br>';
}

?>
  
  </div>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script>

var a = document.getElementById('inp');
var b ="f"


    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>
  </body>
</html>