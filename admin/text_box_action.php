<?php
require_once "../config.php";
$text_box = $_POST["posttext_box"];

$query = "UPDATE admin SET text_box='$text_box';";
GLOBAL $con;
if($con->query($query)){
  echo "Content for the Text Box has been saved!";
}
 ?>
