<?php
require_once "../config.php";

GLOBAL $con;
$email = $_POST["postemail"];
$template = $_POST["posttemplate"];

$query = "SELECT * FROM registrants WHERE id='$email';";
$row = array();
if($result = $con->query($query)){
  if($result->num_rows > 0){

    while($row[] = mysqli_fetch_array($result)){

    }
  }
}
$row = $row[0];
if($template == "confirmregistration.html"){
$header = "\n\n<h3 style='color:green'>Registration Status: Confirmed</h3></br>\n";
}else{
$header = "\n\n<h3 style='color:green'>Registration Status: ".$row['registration_status']."</h3></br>\n";
}
$default_template =  $header.


"<div style='width: 500px; padding: 5px 5px;'>First Name: <strong>".$row["first_name"]." </strong></div>\n".
"<div style='width: 500px; padding: 5px 5px; background: #ebebeb;'>Last Name:  <strong>".$row["last_name"]." </strong></div>\n".
"<div style='width: 500px; padding: 5px 5px;'>Nickname:  <strong>".$row["name_tag"]." </strong></div>\n".
"<div style='width: 500px; padding: 5px 5px; background: #ebebeb;'>Email:  <strong>".$row["email"]." </strong></div>\n".
"<div style='width: 500px; padding: 5px 5px;'>Address:  <strong>".$row["address"]." </strong></div>\n".
"<div style='width: 500px; padding: 5px 5px; background: #ebebeb;'>City:  <strong>".$row["city"]." </strong></div>\n".
"<div style='width: 500px; padding: 5px 5px;'>State:  <strong>".$row["state"]." </strong></div>\n".
"<div style='width: 500px; padding: 5px 5px; background: #ebebeb;'>Zip Code:  <strong>".$row["zip_code"]." </strong></div>\n".
"<div style='width: 500px; padding: 5px 5px;'>Phone:  <strong>".$row["phone"]." </strong></div></br>\n".
"<div style='width: 500px; padding: 5px 5px; background: #ebebeb;'>Special Notes:  <strong>".$row["special_notes"]." </strong></div>\n".
"<div style='width: 500px; padding: 5px 5px;'>Roommate Requested:  <strong>".$row["roommate_requested"]." </strong></div>\n".
"<div style='width: 500px; padding: 5px 5px; background: #ebebeb;'>Registration Submitted On:  <strong>".$row["date"]." </strong></div>\n\n\n".

//Options
"<h3 style='color:green'>Your Order</h3><hr style='border-top: 2px solid green;'></hr></br>\n\n\n".

"<div style='width: 500px; padding: 5px 5px; background: #ebebeb;'>Dance Registration@$120: <strong>".$row["dance_registration"]."</strong></div>\n".
"<div style='width: 500px; padding: 5px 5px;'>Youth (under 25) Dance Only@$95: <strong>".$row["youth_registration"]."</strong></div>\n".
"<div style='width: 500px; padding: 5px 5px; background: #ebebeb;'>Meal Package @$60: <strong>".$row["meal_package"]."</strong></div>\n".
"<div style='width: 500px; padding: 5px 5px;'>Dorm Room for two nights @$120 for single or @$60 for Shared : <strong>".$row["dorm_room"]."</strong></div>\n\n\n".
"<div style='width: 500px; padding: 5px 5px; background: #ebebeb;'>Your Total Invoice: <strong>".$row["total_cost"]."</strong></div>\n";

echo $default_template;


 ?>
