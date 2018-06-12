<?php
require_once "../config.php";
require "../database_queries.php";
error_reporting(E_ALL);

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
$edit_id = $_POST['postedit_id'];
$youth_registration = $_POST["postyouth_registration"];
$meal_package = $_POST["postmeal_package"];
$dorm_room = $_POST["postdorm_room"];
$roommate_requested = $_POST["postroommate_requested"];
$coupon = $_POST["postcoupon"];
$special_notes = $_POST["postspecial_notes"];
$total_cost = $_POST["posttotal_cost"];
$paid = $_POST["postpaid"];
$volunteer = $_POST["postvolunteer"];
$room_number = $_POST["postroom_number"];
$registration_status = $_POST["postregistration_status"];


update_registrant_data($edit_id, $first_name, $last_name, $name_tag, $address,
$city, $state, $zip_code, $phone, $email, $dance_registration, $youth_registration,
$meal_package, $dorm_room, $roommate_requested,
$coupon, $special_notes, $total_cost, $paid, $volunteer, $room_number, $registration_status);
