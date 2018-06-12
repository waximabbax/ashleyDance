<?php
require_once "../config.php";


$query = "SELECT text_box FROM admin;";
GLOBAL $con;
if($result = $con->query($query)){
  while($row = mysqli_fetch_array($result)){
    echo $row["text_box"];
  }
}
 ?>
