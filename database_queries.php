<?php
require_once "config.php";

function insert_into_dancing($first_name, $last_name, $name_tag, $address,
$city, $state, $zip_code, $phone, $email, $dance_registration, $youth_registration,
$meal_package, $dorm_room, $roommate_requested,
$coupon, $special_notes, $total_cost){
  GLOBAL $con;
  $date = date('m/d/Y h:i:s a', time());
  $paid = "no";
  $query = "INSERT INTO registrants (first_name, last_name, name_tag,
    address,city, state, zip_code, phone, email, dance_registration,
    youth_registration,meal_package, dorm_room,
     roommate_requested,coupon, special_notes, total_cost, date, paid) VALUES
     ('$first_name', '$last_name', '$name_tag', '$address','$city', '$state','$zip_code',
        '$phone', '$email', '$dance_registration', '$youth_registration',
        '$meal_package', '$dorm_room',
        '$roommate_requested', '$coupon', '$special_notes', '$total_cost','$date', '$paid');";
        
            if($con->query($query)){
              return true;
            }else{
              echo mysqli_error();
            }

      }

function get_registrant_data($id){
  GLOBAL $con;
  $query = "SELECT * FROM registrants WHERE id='$id';";
  if($result = $con->query($query)){
    if($result->num_rows > 0){
      $row = array();
      while($row[] = mysqli_fetch_array($result)){

      }
      return $row;

    }else{
      echo "No results found";
    }
  }
}

function update_registrant_data($edit_id, $first_name, $last_name, $name_tag, $address,
$city, $state, $zip_code, $phone, $email, $dance_registration, $youth_registration,
$meal_package, $dorm_room, $roommate_requested,
$coupon, $special_notes, $total_cost, $paid, $volunteer, $room_number, $registration_status){
  GLOBAL $con;
  $query = "UPDATE registrants SET first_name = '$first_name', last_name='$last_name', name_tag='$name_tag', address='$address',
  city='$city', state='$state', zip_code='$zip_code', phone='$phone', email='$email', dance_registration='$dance_registration', youth_registration='$youth_registration',
  meal_package='$meal_package', dorm_room='$dorm_room', roommate_requested='$roommate_requested',
  coupon='$coupon', special_notes='$special_notes', total_cost='$total_cost', paid='$paid', volunteer='$volunteer', room_number = '$room_number', registration_status = '$registration_status' WHERE id='$edit_id';";
  if($con->query($query)){
    echo "The registrants data has been successfully updated.You can go back to <a href='registrants_view.php'>Registrants View Page</a></br>";
  }else{
    echo mysqli_error();
  }
}

?>
