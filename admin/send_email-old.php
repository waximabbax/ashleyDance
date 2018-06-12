<?php
ob_start();
session_start();
require_once "../config.php";
if (!isset($_SESSION["user_id"]) && $_SESSION["user_id"] == "") {
  // user already logged in the site
  header("location:" . "login.html");
  die();
}
error_reporting(0);
$email = array();
if($id = $_GET["id"]){
  $query = "SELECT email FROM registrants WHERE id='$id';";

  if($result =$con->query($query)){
    if($result->num_rows >0){
      while($row = mysqli_fetch_array($result)){
       array_push($email, $row['email']);
      }
    }
  }
}

if($notify = $_GET['notify']){
  array_push($email, $notify);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'  type='text/css'>


    <!--<link href="css/animate.css" rel="stylesheet">-->
    <link type = 'text/css' href="../css/style.css" rel="stylesheet">

    <script src="../js/jquery-2.1.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript">

    function send_email(){
      var subject = $("#subject").val().trim();
      var email = $("#email").find(":selected").text().trim();
      var message = $("#message").val().trim();
      var template = $("#templates").val().trim();


      if(subject === "" || email === "" || message === ""){
        $("#output").html("<strong>Please make sure you've entered the subject and filled in all the fields!</strong>");
      }else{
        $("#output").empty();
        $.post("send_email_action.php", {
          postsubject : subject,
          postemail : email,
          postmessage : message,
          posttemplate : template


        }, function(data){
          if(data.trim() === "true"){
            $("#output").html("<em id='new_project_text'>You email has been sent!</em>");
          }else{
            $("#output").html(data);
          }
        })
      }
    }

    function pull_template(){
      var template = $("#templates").val();
      if(template === "confirmregistration.html"){

        $("#subject").val("Registration Confirmed"); //This is where you can change subject line of confirmation email
      }
      if(template === ""){
        $("#message").empty();
        $("#output").empty()
      }
      if(template != ""){

      var email = $("#email").val().trim();
      if(email === ""){
        $("#output").html("<strong> Please select the email of the registrants, so system could pull the registrant's data too along with the template!");
      }else{
        $("#message").html("").load("templates/"+template);
        $.post("pull_template.php", {
          postemail : email,
          posttemplate : template
        }, function(data){
          $("#message").text($("#message").text().trim()+data);
        })
      }
    }
  }
  function modify_template(){
    var email = $("#email").val().trim();
    if(email === ""){
      $("#message").empty();
    }else{
      $("#output").empty();
      pull_template();
    }
  }
  function add_template(){
    if($("#notify").val().trim() === "yes"){
      $("#templates").val("confirmregistration.html");
      pull_template();
    }
  }

</script>
</head>
<body onload="add_template()"></br>
 <div class="navbar-header">
   <input type="hidden" id = "notify" value="<?php echo $email[1]; ?>"/>
   <!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
 </br>
   <a class=" btn btn-warning" href="registrants_view.php">Registrants View Page</a>
   <a class=" btn btn-warning" href="send_email.php">Send Email</a>
 </div></br></br>
 </br> </br>
  <div class="main">
    <div class="row">
      <em id="new_project_text" class="col-md-offset-3">You can edit <strong>Status, Room number and Volunteer </strong>Fields of the user by going to Registrant View Page clicking the edit Button</em></br></br>
      <form class="form-group col-sm-12 col-md-offset-1" >
        <input type="text" class="form-control" id="subject" placeholder="Enter Your Subject Here"/></br>
        <em id="new_project_text">Please select the Email ID of the Person</em></br>
        <?php
         GLOBAL $con;
         $query = "SELECT email, id FROM registrants";
         if($results = $con->query($query)){
           ?>
           <select type="text" class="form-control" id="email"  onclick="modify_template();"/></br>
           <?php
           if($email[0] != ""){?>
             <option value="<?php echo $_GET["id"]; ?>"><?php echo $email[0]; ?></option>
             <?php
           }else{?>
             <option value="">Select Email</option><?php
           }
           if($results->num_rows >0){
             while($row = mysqli_fetch_array($results)){
              ?>
               <option value="<?php echo $row["id"]; ?>"><?php echo $row["email"]; ?></option>
              <?php
            } ?>
          </select>

            <?php

           }else{
             ?>
             <input type="text" id="email" placeholder="Enter Email"/>
             <?php
           }
         }
        ?>
      </br>
      <em id="new_project_text">Available templates</em></br>
      <select id="templates" class="form-control" onclick="pull_template();">
        <option value="">No Template</option>
        <?php
        $list =  scandir("templates");
        foreach($list as $val){
          if($val != "." && $val != ".."){
          echo "<option>".$val."</option>";
          echo $val;
        }
        }
        ?>
      </select></br>
      <textarea id="message" rows="20" cols="150"></textarea></br></br>
      <div id="output"></div></br>
      <input type="button" class="btn btn-success form-control" value="Send Email" onclick="send_email();"/>

      </form>

    </div>
  </div>
</body>
</html>
