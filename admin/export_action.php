<?php
require "../config.php";
require 'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
require 'PHPExcel-1.8/Classes/PHPExcel.php';

error_reporting(E_ALL);
GLOBAL $con;

$query_option = $_POST["postquery_option"];

if($query_option == "all"){
  $query = "SELECT * FROM registrants;";
}else if($query_option == "paid"){
  $query = "SELECT * FROM registrants WHERE paid='yes' || paid='Yes';";
}else if($query_option == "unpaid"){
  $query = "SELECT * FROM registrants WHERE paid='no' || paid='No';";
}else if($query_option == "meal_package"){
  $query = "SELECT * FROM registrants WHERE meal_package='Reg';";
}else if($query_option == "meal_package_vegetarian"){
  $query = "SELECT * FROM registrants WHERE meal_package='Veg';";
}else if($query_option == "dorm_room_single"){
  $query = "SELECT * FROM registrants WHERE dorm_room='Single';";
}else if($query_option == "dorm_room_shared"){
  $query = "SELECT * FROM registrants WHERE dorm_room='Shared';";
}else if($query_option == "dorm_room"){
  $query = "SELECT * FROM registrants WHERE dorm_room='Shared' OR dorm_room='Single';";
}else if($query_option == "meal"){
  $query = "SELECT * FROM registrants WHERE meal_package='Veg' OR meal_package='Reg';";
}

$excel2 = PHPExcel_IOFactory::createReader('Excel2007');
$excel2 = $excel2->load('sample.xlsx'); // Empty Sheet

if($result = $con->query($query)){
  if($result->num_rows>0){
    $row_num = 2;
    $excel2->setActiveSheetIndex(0);
    $excel2->getActiveSheet()->getStyle("F1:G1")->getFont()->setSize(13);
    while($row = mysqli_fetch_array($result)){

      $excel2->getActiveSheet()->setCellValue('A'.$row_num, $row['last_name'])
      ->setCellValue('B'.$row_num, $row['first_name'])
      ->setCellValue('C'.$row_num, $row['email'])
      ->setCellValue('D'.$row_num, $row['name_tag'])
      ->setCellValue('E'.$row_num, $row['dance_registration'])
      ->setCellValue('F'.$row_num, $row['youth_registration'])
      ->setCellValue('G'.$row_num, $row['meal_package'])
      ->setCellValue('H'.$row_num, $row['dorm_room'])
      ->setCellValue('I'.$row_num, $row['roommate_requested'])
      ->setCellValue('J'.$row_num, $row['date'])
      ->setCellValue('K'.$row_num, $row['special_notes'])
      ->setCellValue('L'.$row_num, $row['coupon'])
      ->setCellValue('M'.$row_num, $row['total_cost'])
      ->setCellValue('N'.$row_num, $row['paid'])
      ->setCellValue('O'.$row_num, $row['room_number']);
      $row_num++;
    }
  }else{

  }
}
$directory = "exported_file".uniqid().".xlsx";
$objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
$objWriter->save($directory);
echo "<a href='".$directory."' class='btn btn-success'>Download</a>"
?>
