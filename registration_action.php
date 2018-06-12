<?php
require_once "config.php";
require "database_queries.php";

$first_name = $_POST["postfirst_name"];
$last_name = $_POST["postlast_name"];
$name_tag = $_POST["postname_tag"];
$address = $_POST["postaddress"];
$city = $_POST["postcity"];
$state = $_POST["poststate"];
$zip_code = $_POST["postzip_code"];
$phone = $_POST["postphone"];
$email = $_POST["postemail"];
$dance_registration = $_POST["postdance_registration"];
$youth_registration = $_POST["postyouth_registration"];
$meal_package = $_POST["postmeal_package"];
$dorm_room = $_POST["postdorm_room"];
$roommate_requested = $_POST["postroommate_requested"];
$coupon = $_POST["postcoupon"];
$special_notes = $_POST["postspecial_notes"];
$total_cost = $_POST["posttotal_cost"];

if(insert_into_dancing($first_name, $last_name, $name_tag, $address,
$city, $state, $zip_code, $phone, $email, $dance_registration, $youth_registration,
$meal_package, $dorm_room, $roommate_requested,
$coupon, $special_notes, $total_cost) == true){
  if($total_cost == 0){


    $query = "SELECT * FROM registrants WHERE email='$email' ORDER BY id DESC LIMIT 1;";
    $row = array();
    if($result = $con->query($query)){
      if($result->num_rows > 0){

        while($row[] = mysqli_fetch_array($result)){

        }
      }
    }
    $row = $row[0];
    $default_template =

    "<h3 style='color:green'>Registration Status: ".$row['registration_status']."</h3><hr style='border-top: 2px solid green;'></hr></br></br>\n".

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

    $new_registration_template = "Thank you for submitting your registration for Summer Soiree!
    We will process registrations and send you an email when your place is confirmed. We EXPECT to send out the first confirmation letters no later than May 12, 2017. You will receive two emails with your registration details, but you are NOT Confirmed until you get the confirmation email.\n

    Please double check to ensure that Paypal completed payment - you should get a confirmation email FROM Paypal in addition to ours.\n
    Thank you so much for registering!\n

    Happy Feet, Happy Heart,\n
    MJ\n\n\n";


    //sending email
    $to = $email;
    $subject = $row["name_tag"]." ".$row["last_name"]." =>> New Registration";
    $message = $new_registration_template.$default_template;

    $headers = "From: " . strip_tags("mjtaylor@cyber-key.com") . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";


    mail($to, $subject, $message, $headers);
    mail("mjtaylor@cyber-key.com", $subject, $default_template, $headers);


  echo "done";
}else{

  $query = "SELECT * FROM registrants WHERE email='$email' ORDER BY id DESC LIMIT 1;";
  $row = array();
  if($result = $con->query($query)){
    if($result->num_rows > 0){

      while($row[] = mysqli_fetch_array($result)){

      }
    }
  }
  $row = $row[0];
  $default_template =

  "<h3 style='color:green'>Registration Status: ".$row['registration_status']."</h3><hr style='border-top: 2px solid green;'></hr></br></br>\n".

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

  $new_registration_template = "Thank you for submitting your registration for Summer Soiree!
  We will process registrations and send you an email when your place is confirmed. We EXPECT to send out the first confirmation letters no later than May 12, 2017. You will receive two emails with your registration details, but you are NOT Confirmed until you get the confirmation email.\n

  Please double check to ensure that Paypal completed payment - you should get a confirmation email FROM Paypal in addition to ours.\n
  Thank you so much for registering!\n

  Happy Feet, Happy Heart,\n
  MJ\n\n\n";


  //sending email
  $to = $email;
  $subject = $row["name_tag"]." ".$row["last_name"]." =>> New Registration";
  $message = $new_registration_template.$default_template;

  $headers = "From: " . strip_tags("mjtaylor@cyber-key.com") . "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";


  mail($to, $subject, $message, $headers);
  mail("mjtaylor@cyber-key.com", $subject, $default_template, $headers);
  echo "Saved";
}
}else{
  echo "<strong> There was a problem. Please try again later</strong>";
  die();
}
// send_email


 ?>
