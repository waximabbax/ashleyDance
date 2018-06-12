<?php
require_once "../config.php";
GLOBAL $con;
$query = "SELECT * FROM registrants ORDER BY last_name;";
if($result = $con->query($query)){
  if($result->num_rows > 0){
    $row = array();
    while($row[] = mysqli_fetch_array($result)){

    }
  echo json_encode($row);
  }else{
    echo "<strong> There are no registrants yet</strong>";
  }
}

 ?>
