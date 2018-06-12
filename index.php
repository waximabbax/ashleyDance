<?php
require_once "config.php";
 ?>
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


    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <link type = 'text/css' href="css/style.css?v=10" rel="stylesheet">
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
//zip code validation



  function register(){

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
  var total_cost = Number($("#dance_registration").val()) + Number($("#youth_registration").val()) + Number($("#meal_package").val()) + Number($("#dorm_room").val());

  if(first_name === "" || last_name === "" || name_tag  === "" || address  === "" || city === "" || zip_code === "" || phone === "" || email === ""
     ){
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
   }else if(!$('#refund_policy').is(":checked")){
     $("#output").empty();
     $("#output").html("Please agree to our Refund Policy!");
   }else{

     $("#submit_button_display").css("display", "none");
     $("#output").html("Please wait!");

     dance_registration = $("#dance_registration option:selected").text().trim();
     youth_registration = $("#youth_registration option:selected").text().trim();
     meal_package = $("#meal_package option:selected").text().trim();
     dorm_room = $("#dorm_room option:selected").text().trim();

     $.post("registration_action.php",{
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
       posttotal_cost: total_cost
     },function(data){
       if(data.trim() === "Saved"){
         $("#output").empty();
         $("submit_button").hide();
         $("input[name=custom]").val(email);
         $("input[name=amount]").val(total_cost);
         $("#message_of_error").css("display", "none");
         $("#paypal_button").css("display", "block");

     }else if(data.trim() === "done"){
       window.location.href = "success_paid.php";
     }else{
       $("#submit_button_display").css("display", "block");
       $("#output").html(data);
     }
     });
   }

}

function text_box(){
$("#refund_data").load("refund_policy.html");

}


    </script>




  </head>
  <body id="landing_page" onload="text_box()">

    <div class="col-md-9 col-md-offset-2" style="margin-left:20%">
      <img class=".img-responsive" src="img/bg1.jpg" alt="Smiley face" width="80%"/>
    </div>
    <form class="form-horizontal  col-sm-9 col-lg-6 col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-1 col-lg-offset-3 col-md-offset-4">
      <h5 class="logo-name" style="color: #f08080; width:100%; margin-left:39%;" > Registration Form</h5>

    <div class="col-md-8 col-xs-11 col-xs-offset-1 col-md-offset-2 text-center" style="background-color:#C0C0C0">
     <strong id="text_box"><b>Registration and Payment online only by Paypal. Online Only. No mail in Payments!</b></strong>
    </div></br></br>
    <div class="col-md-8 col-xs-11 col-xs-offset-1 col-md-offset-2 text-center">
     <strong>All fields with * are required!</strong>
   </div></br></br></br>
      <!--first name-->
    <div class="form-group">
      <label class="control-label"><em id='new_green'> First Name: &nbsp  &nbsp <strong>*</strong>  &nbsp </em></label>
      <div >
        <input type="text" class="form-control my-field" id="first_name" placeholder="First Name" maxlength="35">
      </div>
    </div></br>

    <!--last name-->
    <div class="form-group">
      <label class="control-label"><em id='new_green'> Last Name: &nbsp  &nbsp  <strong>*</strong>  &nbsp </em></label>
      <div>
        <input type="text" class="form-control my-field" id="last_name"placeholder="Last Name" maxlength="35">
      </div>
    </div></br>

    <!--Name Tag-->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> What name do you &nbsp  &nbsp  &nbsp want on your name  &nbsp  &nbsp  &nbsp tag? &nbsp  &nbsp  <strong>*</strong>  &nbsp </em></label>
    </br>
      <div>
        <input type="text" class="form-control my-field" id="name_tag" placeholder="Name Tag" maxlength="35">
      </div>
    </div></br>
    <!-- Address -->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> Address: &nbsp  &nbsp  <strong>*</strong>  &nbsp </em></label>
      <div >
        <input type="text" class="form-control my-field" id="address" placeholder="Max Length 35 Characters" maxlength="35">
      </div>
    </div></br>

    <!--City-->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> City: &nbsp  &nbsp  <strong>*</strong>  &nbsp </em></label>
      <div>
        <input type="text" class="form-control my-field" id="city" placeholder="Max Length 35 Characters" maxlength="35">
      </div>
    </div></br>
    <!-- state -->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> State: &nbsp  &nbsp  <strong>*</strong>  &nbsp </em></label>
      <div >
        <input type="text" class="form-control my-field" id="state" placeholder="Ex: NY, CA" maxlength="35">
      </div>
    </div></br>

    <!--zip code-->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> Zip Code: &nbsp  &nbsp  <strong>*</strong>  &nbsp </em></label>
      <div>
        <input type="text" class="form-control my-field"  id="zip_code" placeholder="Ex: 38980, 83900-8789" maxlength="35">
      </div>
    </div></br>

    <!--Phone -->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> Phone: &nbsp  &nbsp  <strong>*</strong>  &nbsp </em></label>

        <input type="text" class="form-control my-field" id="phone" placeholder="Ex: 308-154-7894" maxlength="35">

    </div></br>

    <!--Email-->
    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> Email: &nbsp  &nbsp  <strong>*</strong>  &nbsp </em></label>

        <input type="email" class="form-control my-field" id="email" placeholder="Ex: larry123@gmail.com " maxlength="35">

    </div></br>
    <!--options -->
    <h5 class="logo-name" style="font-weight:lighter"> &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp Options</h5>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> Dance Registration (@ $<?php echo $dance_registration_price; ?>): &nbsp  &nbsp  &nbsp </em></label>
      <select class="col-md-3 form-control  my-field cost" onchange="calculate_cost()" id="dance_registration">
        <option value=0>0</option>
        <option value=<?php echo $dance_registration_price; ?>>1</option>
      </select>
    </div></br>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> Youth Registration (@ $<?php echo $youth_registration_price; ?>): &nbsp  &nbsp  &nbsp </em></label>
      <select class="col-md-3 form-control my-field cost" id="youth_registration" onchange="calculate_cost()">
        <option value=0>0</option>
        <option value=<?php echo $youth_registration_price; ?>>1</option>
      </select>
    </div>
    <div class='form-group'><label><strong>(25 and under: limited to 20% of total, must register within first week of registration.)</strong></label></div>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> Meal Package (@ $<?php echo $meal_package_price; ?>): &nbsp  &nbsp  &nbsp </em></label>
      <select class="col-md-3 form-control  my-field cost" id="meal_package" onchange="calculate_cost()">
        <option value=0>0</option>
        <option value=<?php echo $meal_package_price; ?>>Veg</option>
        <option value=<?php echo $meal_package_price; ?>>Reg</option>
      </select>
    </div>
    <div class='form-group'><label><strong>(Breakfast on Saturday and Sunday morning and lunch in the college cafeteria, Saturday night catered dinner and Sunday sandwich for lunch)</strong></label></div>


    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> Dorm Room for Two nights: &nbsp  &nbsp  &nbsp </em></label>
      <select class="col-md-3 form-control my-field" id="dorm_room" onchange="calculate_cost()">
        <option value=0>No</option>
        <option value=<?php echo $single_dorm_room_price; ?>>Single</option>
        <option value=<?php echo $share_dorm_room_price; ?>>Shared</option>
      </select>
    </div></br>
    <div class='form-group'><label><strong>(Shared room, $60 for 2 nights, single $120)</strong></label></div>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> Roommate Requested: &nbsp  &nbsp  &nbsp </em></label>
      <div>
        <input type="text" class="form-control my-field"  id="roommate_requested" maxlength="35">
      </div>
    </div></br>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> Coupon: &nbsp  &nbsp  &nbsp </em></label>
      <div>
        <input type="text" class="form-control my-field" id="coupon" maxlength="35">
      </div>
    </div></br>

    <div class="form-group">
      <label class="col-md-3 control-label"><em id='new_green'> Special Notes: &nbsp  &nbsp  &nbsp </em></label>
      <div>
        <textarea class="form-control my-field" id="special_notes" cols="100" rows="4" maxlength = "127"></textarea>
      </div>
    </div></br></br>

    <div class="form-group">
      <label class="col-md-3 control-label"> <h5 class="logo-name" id="total_cost"style="font-weight:lighter"> Total: 0 </h5></label>
    </div></br></br>

    <div class="checkbox">
      <label>
        <em id='new_green'>  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp
        <input type="checkbox" id="refund_policy"> I have read and agree to the <a data-toggle="modal" data-target="#myModal">Refund Policy</a>
        </em>
      </label>
    </div></br>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Refund Policy</h4>
            </div>
            <div class="modal-body">
              <p id="refund_data"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div></div>


    <div class="form-group" id="submit_button_display">
      <div id="submit_button">
       &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp
       <button type="button" class="btn btn-warning form-group" onclick="register()">Submit</button>
     </div>
    </div>
    <div class="form-group" id="message_of_error">
     &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp&nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp
      <strong id="output"></strong>
    </div>

  </form>
  <div class="row" id ="paypal_button" style="display: none;">
    <div class="col-md-2 col-md-offset-5">

      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="53HKMBKD68ZCN">
  <input type="hidden" name="lc" value="US">
  <input type="hidden" name="button_subtype" value="services">
  <input type="hidden" name="no_note" value="0">
  <input type="hidden" name="cn" value="Add special instructions to the seller:">
  <input type="hidden" name="no_shipping" value="2">
  <input type="hidden" name="rm" value="1">
  <input type="hidden" name="return" value="http://www.ashevillecontra.com/reg/success_paid.php">
  <input type="hidden" name="cancel_return" value="http://www.ashevillecontra.com/reg/payment_cancel.php">
  <input type="hidden" name="currency_code" value="USD">
  <input type="hidden" name="bn" value="PP-BuyNowBF:btn_paynowCC_LG.gif:NonHosted">
  <input type="hidden" name="custom" value="">
  <input type="hidden" name="amount" value="">
  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
  <a class="btn btn-warning" href="success_paid.php">Pay later</a>
  </form>


</div>
<div class="col-md-2 col-md-offset-5"></br>

</div>
</div>

  </body>
</html>
