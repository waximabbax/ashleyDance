<?php
require_once "../config.php";
GLOBAL $con;

$id = $_POST['postid'];
$query = "DELETE FROM registrants WHERE id='$id';";

if($con->query($query)){
  echo "The registrant has been deleted";
}else{
  echo "There was a problem in deleting the registrant. Please try again later";
}

 ?>
