<?php
require "../database_queries.php";
if(!$_GET["id"]){
  header("Location:registrants_view.php");
}
$edit_id = $_GET["id"];
$row = get_registrant_data($edit_id);
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

    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript">
    var total_cost = 0;
    function calculate_cost(){
      var dance_registration =  $("#dance_registration").val().trim();
      var youth_registration =  $("#youth_registration").val().trim();

      if(dance_registration != "0" && youth_registration != "0"){
        alert("You can't select Adult Dance Registration and Youth Registration both at the same time");
        $("#output").empty();
        $("#output").html("You can't select Adult Dance Registration and Youth Registration both at the same time");
      }else{
        $("#output").empty();
    var total_cost = Number($("#dance_registration").val()) + Number($("#youth_registration").val()) + Number($("#meal_package").val()) + Number($("#dorm_room").val());
    $("#total_cost").empty().html("Total : " + total_cost);
  }
  }
  //phone validation
  function valid_phone(phone)
{
  var phoneno = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
  if(phone.match(phoneno))
        {
      return true;
        }
      else
        {
        return false;
        }
}
//zip code validation
function zip_code_validation(zip_code){
  var check = /(^\d{5}$)|(^\d{5}-\d{4}$)/;
  if(zip_code.match(check))
        {
      return true;
        }
      else
        {
        return false;
        }
}
//email ID validation

//zip code validation
function valid_email(email){
  var check = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(email.match(check))
        {
      return true;
        }
      else
        {
        return false;
        }
}


  function register(){
  var edit_id = $("#edit_id").val().trim();
  var first_name = $("#first_name").val().trim();
  var last_name = $("#last_name").val().trim();
  var name_tag =  $("#name_tag").val().trim();
  var address =  $("#address").val().trim();
  var city =  $("#city").val().trim();
  var state =  $("#state").val().trim();
  var zip_code =  $("#zip_code").val().trim();
  var phone =  $("#phone").val().trim();
  var email =  $("#email").val().trim();
  var dance_registration =  $("#dance_registration").val().trim();
  var youth_registration =  $("#youth_registration").val().trim();
  var meal_package =  $("#meal_package").val().trim();
  var dorm_room =  $("#dorm_room").val().trim();
  var roommate_requested = $("#roommate_requested").val().trim();
  var coupon =  $("#coupon").val().trim();
  var special_notes =  $("#special_notes").val().trim();
  var total_cost = Number($("#dance_registration").val()) + Number($("#youth_registration").val()) + Number($("#meal_package").val())  + Number($("#dorm_room").val());
  var paid = $("#paid").val().trim();
  var volunteer = $("#volunteer").val().trim();
  var room_number = $("#room_number").val().trim();
  var registration_status = $("#registration_status").val().trim();

  if(first_name === "" || last_name === "" || name_tag  === "" || address  === "" || city === "" || zip_code === "" || phone === "" || email === ""){
     $("#output").empty();
     $("#output").html("Please fill in all the fields!");
   }else if(isNaN(first_name) === false || isNaN(last_name) === false){
     $("#output").empty();
     $("#output").html("Your first and Last Name can't be number");
   }else if(valid_phone(phone) === false){
     $("#output").empty();
     $("#output").html("Please Enter a valid phone number!");
   }else if(zip_code_validation(zip_code) === false){
     $("#output").empty();
     $("#output").html("Please Enter a valid Zip Code!");
   }else if(valid_email(email) === false){
     $("#output").empty();
     $("#output").html("Please Enter a valid Email ID!");
   }else if(dance_registration != "0" && youth_registration != "0"){
     $("#output").empty();
     $("#output").html("You can't select Adult Dance Registration and Youth Registration both at the same time");
   }else{
     $("#output").empty();

     dance_registration = $("#dance_registration option:selected").text().trim();
     youth_registration = $("#youth_registration option:selected").text().trim();
     meal_package = $("#meal_package option:selected").text().trim();
     dorm_room = $("#dorm_room option:selected").text().trim();

     $.post("edit_registrant_action.php",{
       postregistration_status: registration_status,
       postfirst_name: first_name,
       postlast_name: last_name,
       postname_tag: name_tag,
       postaddress: address,
       postcity: city,
       poststate: state,
       postzip_code: zip_code,
       postphone: phone,
       postemail: email,
       postdance_registration: dance_registration,
       postyouth_registration: youth_registration,
       postmeal_package: meal_package,
       postdorm_room: dorm_room,
       postroommate_requested: roommate_requested,
       postcoupon: coupon,
       postspecial_notes: special_notes,
       posttotal_cost: total_cost,
       postpaid : paid,
       postedit_id : edit_id,
       postvolunteer : volunteer,
       postroom_number : room_number
     },function(data){
       $("#output").html(data);
     });
   }

}
    </script>




  </head>
  <body>
  </br></br>
  <div class="navbar-header">

    <!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
  </br>
    <a class=" btn btn-warning" href="registrants_view.php">Registrants View Page</a>
    <a class=" btn btn-warning" href="send_email.php">Send Email</a>
  </div></br>
    <input type="hidden" value="<?php echo $edit_id; ?>" id="edit_id"/>

    <form class="form-horizontal  col-sm-12 col-md-offset-4">
      <h5 class="logo-name" style="color: #f08080"> &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp Edit Registrants Data</h5>

      <!--first name-->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> First Name: &nbsp  &nbsp  &nbsp </em></label>
      <div >
        <input type="text" class="form-control" id="first_name" placeholder="First Name" maxlength="35" value="<?php echo $row[0]["first_name"]; ?>">
      </div>
    </div></br>

    <!--last name-->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Last Name: &nbsp  &nbsp  &nbsp </em></label>
      <div>
        <input type="text" class="form-control" id="last_name" placeholder="Last Name" maxlength="35" value="<?php echo $row[0]["last_name"]; ?>">
      </div>
    </div></br>

    <!--Name Tag-->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> What name do you &nbsp  &nbsp  &nbsp want on your name  &nbsp  &nbsp  &nbsp tag? &nbsp  &nbsp  &nbsp </em></label>
    </br>
      <div>
        <input type="text" class="form-control" id="name_tag" placeholder="Name Tag" maxlength="35" value="<?php echo $row[0]["name_tag"]; ?>">
      </div>
    </div></br>
    <!-- Address -->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Address: &nbsp  &nbsp  &nbsp </em></label>
      <div >
        <input type="text" class="form-control" id="address" placeholder="Max Length 35 Characters" maxlength="35" value="<?php echo $row[0]["address"]; ?>">
      </div>
    </div></br>

    <!--City-->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> City: &nbsp  &nbsp  &nbsp </em></label>
      <div>
        <input type="text" class="form-control" id="city" placeholder="Max Length 35 Characters" maxlength="35" value="<?php echo $row[0]["city"]; ?>">
      </div>
    </div></br>
    <!-- state -->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> State: &nbsp  &nbsp  &nbsp </em></label>
      <div>
        <input type="text" class="form-control" id="state" placeholder="Ex: NY, CA" maxlength="35" value="<?php echo $row[0]["state"]; ?>">
      </div>
    </div></br>

    <!--zip code-->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Zip Code: &nbsp  &nbsp  &nbsp </em></label>
      <div>
        <input type="text" class="form-control"  id="zip_code" placeholder="Ex: 38980, 83900-8789" maxlength="35" value="<?php echo $row[0]["zip_code"]; ?>">
      </div>
    </div></br>

    <!--Phone -->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Phone: &nbsp  &nbsp  &nbsp </em></label>

        <input type="text" class="form-control" id="phone" placeholder="Ex: 308-154-7894" maxlength="35" value="<?php echo $row[0]["phone"]; ?>">

    </div></br>

    <!--Email-->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Email: &nbsp  &nbsp  &nbsp </em></label>

        <input type="email" class="form-control" id="email" placeholder="Ex: larry123@gmail.com " maxlength="35" value="<?php echo $row[0]["email"]; ?>">

    </div></br>
    <!--options -->
    <h5 class="logo-name" style="font-weight:lighter"> &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp Options</h5>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Dance Registration (@ $120): &nbsp  &nbsp  &nbsp </em></label>
      <select class="col-md-3 form-control cost" onclick="calculate_cost()" id="dance_registration">
        <option  value="<?php echo 120*$row[0]["dance_registration"]; ?>"><?php echo $row[0]["dance_registration"]; ?></option>
        <option value=0>0</option>
        <option value=120>1</option>
      </select>
    </div></br>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Youth Registration (@ $95): &nbsp  &nbsp  &nbsp </em></label>
      <select class="col-md-3 form-control cost" id="youth_registration" onclick="calculate_cost()">
        <option value="<?php echo 95*$row[0]["youth_registration"]; ?>"><?php echo $row[0]["youth_registration"]; ?></option>
        <option value=0>0</option>
        <option value=95>1</option>
      </select>
    </div>
    <div class='form-group'><label class="col-md-3"><strong>(25 and under: limited to 20% of total, must register withing first week of registration.)</strong></label></div>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Meal Package (@ $60): &nbsp  &nbsp  &nbsp </em></label>
      <select class="col-md-3 form-control cost" id="meal_package" onclick="calculate_cost()">
        <option  value="<?php if($row[0]["meal_package"] == '0'){echo 0; }else {echo 60;} ?>"><?php echo $row[0]["meal_package"]; ?></option>
        <option value=0>0</option>
        <option value=60>Reg</option>
        <option value=60>Veg</option>
      </select>
    </div>
    <div class='form-group'><label class="col-md-3"><strong>(Breakfast on Saturday and Sunday morning and lunch in the college cafeteria, Saturday night catered dinner and Sunday sandwich for lunch)</strong></label></div>


    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Dorm Room for Two nights: &nbsp  &nbsp  &nbsp </em></label>
      <select class="col-md-3 form-control" id="dorm_room" onclick="calculate_cost()">
        <option value="<?php if($row[0]["dorm_room"] == 'Single'){echo 120; }else if($row[0]["dorm_room"] == "Shared"){echo 60;}else {echo 0;} ?>"><?php echo $row[0]["dorm_room"]; ?></option>
        <option value=0>No</option>
        <option value=120>Single</option>
        <option value=60>Shared</option>
      </select>
    </div></br>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Paid: &nbsp  &nbsp  &nbsp </em></label>
      <select class="col-md-3 form-control" id="paid">
        <option value="<?php echo $row[0]["paid"]; ?>"><?php echo $row[0]["paid"]; ?></option>
        <option>no</option>
        <option>yes</option>
      </select>
    </div></br>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Volunteer: &nbsp  &nbsp  &nbsp </em></label>
      <select class="col-md-3 form-control" id="volunteer">
        <option value="<?php echo $row[0]["volunteer"]; ?>"><?php echo $row[0]["volunteer"]; ?></option>
        <option>No</option>
        <option>Yes</option>
      </select>
    </div></br>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Registration Status: &nbsp  &nbsp  &nbsp </em></label>
      <select class="col-md-3 form-control" id="registration_status">
        <option value="<?php echo $row[0]["registration_status"]; ?>"><?php echo $row[0]["registration_status"]; ?></option>
        <option>Pending</option>
        <option>Confirmed</option>
        <option>Cancelled</option>
      </select>
    </div></br>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Room number: &nbsp  &nbsp  &nbsp </em></label>
      <div>
        <input type="text" class="form-control"  id="room_number" maxlength="35" value="<?php echo $row[0]["room_number"]; ?>">
      </div>
    </div></br>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Roommate Requested: &nbsp  &nbsp  &nbsp </em></label>
      <div>
        <input type="text" class="form-control"  id="roommate_requested" maxlength="35" value="<?php echo $row[0]["roommate_requested"]; ?>">
      </div>
    </div></br>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Coupon: &nbsp  &nbsp  &nbsp </em></label>
      <div>
        <input type="text" class="form-control" id="coupon" maxlength="35" value="<?php echo $row[0]["coupon"]; ?>">
      </div>
    </div></br>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_project_text'> Special Notes: &nbsp  &nbsp  &nbsp </em></label>
      <div>
        <textarea class="form-control" id="special_notes" cols="100" rows="4" maxlength = "127"> <?php echo $row[0]["special_notes"]; ?> </textarea>
      </div>
    </div></br></br>

    <div class="form-group">
      <label class="col-md-3 control-label"> <h5 class="logo-name" id="total_cost"style="font-weight:lighter"> Total: <?php echo $row[0]["total_cost"]; ?> </h5></label>
    </div></br></br>

      <div class="form-group">
       &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp
       <button type="button" class="btn btn-warning form-group" onclick="register()">Save</button>
    </div>
    <div class="form-group">
     &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp&nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp
      <strong id="output"></strong>
    </div>

  </form>
  </body>
</html>
