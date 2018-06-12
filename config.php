<?php
error_reporting(0);
$con = new mysqli("localhost", "mj_taererrylor", "password", "dancingerer");
if(!$con){
		echo "couldn't connect to the database";
    die();
	}

$dance_registration_price = 120;
$youth_registration_price = 95;
$meal_package_price = 60;
$single_dorm_room_price = 120;
$share_dorm_room_price = 60;
