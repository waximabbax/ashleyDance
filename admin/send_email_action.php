<?php
require_once "../config.php";

$to = $_POST["postemail"];
$subject = $_POST["postsubject"];
$message = $_POST["postmessage"];
$template = $_POST["posttemplate"];
$id = $_POST["postid"];

$headers = "From: " . strip_tags("mjtaylor@cyber-key.com") . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
mail($to, $subject, $message, $headers);
if($template === "confirmregistration.html"){
  GLOBAL $con;
  $query = "UPDATE registrants SET registration_status = 'confirmed' WHERE email='$to' AND id='$id';";
  if($con->query($query)){
    echo "<em id='new_project_text'>Your Email has been sent and status has been updated of the email ID. <strong>".$to." </strong>You can go to Registrant View Page and edit the user's data if you wish to change it again</em>";
  }else{
    echo mysqli_error();
  }
}else{
  echo "true";
}

 ?>
