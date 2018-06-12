<?php error_reporting(0);?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'  type='text/css'>


    <!--<link href="css/animate.css" rel="stylesheet">-->
    <link type = 'text/css' href="css/style.css" rel="stylesheet">

    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <body id="landing_page">
      <div class="col-md-9 col-md-offset-1">
        <img src="img/bg1.jpg" alt="Smiley face" height="500px" width="100%">
      </div>
      <div class="col-md-6 col-md-offset-3"></br></br>

      <p style="font-size:15px" id='payment_cancel'></p></br></br>
  <em id="new_green_header"> Your Order: <?php echo $_GET["amt"]; ?></em><hr style='border-top: 2px solid green;'></hr></br></br>
  <em id="new_green_header"> Payment Status: <?php echo $_GET["st"]; ?></em><hr style='border-top: 2px solid green;'></hr></br></br>

      </div>
      <script type='text/javascript'>
      $("#payment_cancel").load("admin/templates/payment_cancel.html");

      </script>
    </body>
    </html>
