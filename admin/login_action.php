<?php
require_once "../config.php";

$email = $_POST["postemail"];
$password = $_POST["postpassword"];

$query = "SELECT user_id FROM admin WHERE email = '$email' AND password = '$password';";
GLOBAL $con;
if($result = $con->query($query)){
  if($result->num_rows > 0){
    while($row = mysqli_fetch_array($result)){
      session_start();
      $_SESSION["user_id"] = $row["user_id"];
      echo "registrants_view.php";
    }
  }else{
    echo "<strong>Login Credentials are incorrect</strong>";
  }
}

 ?>
