<?php
ob_start();
session_start();
if (!isset($_SESSION["user_id"]) && $_SESSION["user_id"] == "") {
  // user already logged in the site
  header("location:" . "login.html");
  die();
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


    <script src="../js/jquery-2.1.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>
<link type = 'text/css' href="../css/style.css?v=1" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript">
    function export_registrant(){
      $("#output").empty();
      var query_option = $("#export").val().trim();
      $.post("export_action.php",{
        postquery_option : query_option
      }, function(data){
        var data = data.trim();
        $("#output").html(data);
      })
    }
    function edit(id){

        window.location.replace("edit_registrant.php?id="+id);
    }
    function delet(id){
      if(confirm("Are you sure you want to delete this?") === true){

      $.post("delete_registrant.php",{
        postid: id
      }, function(data){

        location.reload();
      });
    }
}
    function notify(id){
    window.location.replace("send_email.php?id="+id+"&notify=yes");
    }

    function email(id){
    window.location.replace("send_email.php?id="+id);
    }

    function load(){
    $.get("registrants_list.php",function(list){
      var list = JSON.parse(list);
      $("#total_registrants").html(list.length);
      for(var i=0; i < list.length; i++){
         if(list[i]["registration_status"] === "Confirmed" || list[i]["registration_status"] === "confirmed" ){
            list[i]["registration_status"] = "<h2><strong>" + list[i]["registration_status"] + "</strong></h2>";
         }
         if(list[i]["paid"] === "Yes" || list[i]["paid"] === "yes"){
           $("#registrants").append("<tr class='paid_yes'><th id = 'table_box_width'>"+ list[i]["last_name"] +"</th><th id = 'table_box_width'>"+  list[i]["first_name"]  +"</th><th id = 'table_box_width'>"+  list[i]["email"]  +"</th><th id = 'table_box_width'>"+ list[i]["name_tag"]  +"</th><th id = 'table_box_width'>"+ list[i]["dance_registration"] +"</th><th id = 'table_box_width'>"+ list[i]["youth_registration"] +
           "</th><th id = 'table_box_width'>"+ list[i]["meal_package"] +"</th><th id = 'table_box_width'>"+ list[i]["dorm_room"] +"</th><th id = 'table_box_width'>"
           + list[i]["roommate_requested"] +"</th><th id = 'table_box_width'>"+ list[i]["date"] +"</th><th id = 'table_box_width'>"+ list[i]["special_notes"] +"</th><th id = 'table_box_width'>"+ list[i]["coupon"] +"</th><th id = 'table_box_width'>"+ list[i]["total_cost"] +"</th><th id = 'table_box_width'>"+ list[i]["paid"] +"</th><th id = 'table_box_width'>"+ list[i]["volunteer"]
           +"</th><th id = 'table_box_width'>"+ list[i]["room_number"]+"</th><th id = 'table_box_width'>"+ list[i]["registration_status"]+"</th><th id = 'table_box_width'>"+ "<button type='button'  name='edit_id' value="+
           list[i]['id']+" class='label control-label label-sm' onclick='edit("+list[i]['id']+")'>Edit </button><button type='button'  name='edit_id' value="+
           list[i]['id']+" class='label label-danger label-sm' onclick='delet("+list[i]['id']+")'>Delete </button></th><th id = 'table_box_width'><button type='button'  name='edit_id'  value="+
           list[i]['id']+" class='label label-info label-sm' onclick='notify("+list[i]['id']+")'> Notify </button><button type='button'  name='edit_id' value="+list[i]['id']+" class='label label-white label-sm' onclick='email("+list[i]['id']+")'>Email </button></th></tr>");

         }else if(i % 2 === 0){
          $("#registrants").append("<tr class='paid'><th id = 'table_box_width'>"+ list[i]["last_name"] +"</th><th id = 'table_box_width'>"+  list[i]["first_name"]  +"</th><th id = 'table_box_width'>"+  list[i]["email"]  +"</th><th id = 'table_box_width'>"+ list[i]["name_tag"]  +"</th><th id = 'table_box_width'>"+ list[i]["dance_registration"] +"</th><th id = 'table_box_width'>"+ list[i]["youth_registration"] +
          "</th><th id = 'table_box_width'>"+ list[i]["meal_package"] +"</th><th id = 'table_box_width'>"+ list[i]["dorm_room"] +"</th><th id = 'table_box_width'>"
          + list[i]["roommate_requested"] +"</th><th id = 'table_box_width'>"+ list[i]["date"] +"</th><th id = 'table_box_width'>"+ list[i]["special_notes"] +"</th><th id = 'table_box_width'>"+ list[i]["coupon"] +"</th><th id = 'table_box_width'>"+ list[i]["total_cost"] +"</th><th id = 'table_box_width'>"+ list[i]["paid"] +"</th><th id = 'table_box_width'>"+ list[i]["volunteer"]
          +"</th><th id = 'table_box_width'>"+ list[i]["room_number"]+"</th><th id = 'table_box_width'>"+ list[i]["registration_status"]+"</th><th id = 'table_box_width'>"+ "<button type='button'  name='edit_id' value="+
          list[i]['id']+" class='label control-label label-sm' onclick='edit("+list[i]['id']+")'>Edit </button><button type='button'  name='edit_id' value="+
          list[i]['id']+" class='label label-danger label-sm' onclick='delet("+list[i]['id']+")'>Delete </button></th><th id = 'table_box_width'><button type='button'  name='edit_id'  value="+
          list[i]['id']+" class='label label-info label-sm' onclick='notify("+list[i]['id']+")'> Notify </button><button type='button'  name='edit_id' value="+list[i]['id']+" class='label label-white label-sm' onclick='email("+list[i]['id']+")'>Email </button></th></tr>");
        }else{


        $("#registrants").append("<tr><th id = 'table_box_width'>"+ list[i]["last_name"] +"</th><th id = 'table_box_width'>"+  list[i]["first_name"]  +"</th><th id = 'table_box_width'>"+  list[i]["email"]  +"</th><th id = 'table_box_width'>"+ list[i]["name_tag"]  +"</th><th id = 'table_box_width'>"+ list[i]["dance_registration"] +"</th><th id = 'table_box_width'>"+ list[i]["youth_registration"] +
        "</th><th id = 'table_box_width'>"+ list[i]["meal_package"] +"</th><th id = 'table_box_width'>"+ list[i]["dorm_room"] +"</th><th id = 'table_box_width'>"
        + list[i]["roommate_requested"] +"</th><th id = 'table_box_width'>"+ list[i]["date"] +"</th><th id = 'table_box_width'>"+ list[i]["special_notes"] +"</th><th id = 'table_box_width'>"+ list[i]["coupon"] +"</th><th id = 'table_box_width'>"+ list[i]["total_cost"] +"</th><th id = 'table_box_width'>"+ list[i]["paid"] +"</th><th id = 'table_box_width'>"+ list[i]["volunteer"]
        +"</th><th id = 'table_box_width'>"+ list[i]["room_number"]+"</th><th id = 'table_box_width'>"+ list[i]["registration_status"]+"</th><th id = 'table_box_width'>"+ "<button type='button'  name='edit_id' value="+
        list[i]['id']+" class='label control-label label-sm' onclick='edit("+list[i]['id']+")'>Edit </button><button type='button'  name='edit_id' value="+
        list[i]['id']+" class='label label-danger label-sm' onclick='delet("+list[i]['id']+")'>Delete </button></th><th id = 'table_box_width'><button type='button'  name='edit_id' value="+
        list[i]['id']+" class='label label-info label-sm' onclick='notify("+list[i]['id']+")'>Notify </button><button type='button'  name='edit_id' value="+list[i]['id']+" class='label label-white label-sm' onclick='email("+list[i]['id']+")'>Email </button></th></tr>");
      }
        if(i % 7 === 0 && i !== 0){
          $("#registrants").append("<tr class='registrants_header'><th>Last Name</th><th>First Name</th><th>Email</th><th>Name Tag</th><th>Dance Reg</th><th>Youth Dance Reg</th><th>Meal Package</th><th>Dorm Room</th><th>Roommate</th><th>Date</th><th>SN</th><th>Coupon</th><th>Total Cost</th><th>Paid</th><th>Vlntr</th><th>Room#</th><th>Reg Status</th><th>Edit/Delete</th><th>Notify/Email</th></tr>");
        }
      }
    });
}
function text_box() {
  var text_box = $("#text_box").val().trim();
  if(text_box === ""){
    alert("Text Box is empty. If you don't want to change the Text Box simply refresh the page!")
  }else{
    $.post("text_box_action.php",{
      posttext

    },function(data){
      alert(data);
      location.reload();
    })
  }
}
    </script>
  </head>
  <body onload="load()" style="">
    <nav class="navbar navbar-default">
     <div class="container">
       </br>
       <div class="navbar-header">

         <!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
       </br>
         <a class=" btn btn-warning" href="registrants_view.php">Registrants View Page</a>


       </div>
       <!-- Note that the .navbar-collapse and .collapse classes have been removed from the #navbar -->
       <div id="navbar">
         <form class="navbar-form navbar-left">
           <div class="form-group">
             <select class="form-control" id='export'>
               <option value="all">All</option>
               <option value="paid">Paid</option>
               <option value="unpaid">Unpaid</option>
               <option value="meal">Meal Package</option>
               <option value="meal_package">Meal Package Regular</option>
               <option value="meal_package_vegetarian">Meal Package Vegetarian</option>
               <option value="dorm_room">Dorm Room</option>
               <option value="dorm_room_single">Dorm Room Single</option>
               <option value="dorm_room_shared">Dorm Room Shared</option>
             </select>

           </div>
           <button type="button" class="btn btn-warning" onclick="export_registrant()">Export</button>
           <div id="output">
           </div>
         </form>
       </div><!--/.nav-collapse -->
     </div>
   </nav></br></br>
   <em id="new_project_text" class="col-md-offset-3">You can edit <strong style='font-weight: bold'>Status, Room number and Volunteer </strong>Fields of the user by clicking the <b>edit BUTTON.</b>  The <b>BlUE ROWS </b>are for the users that have paid! <strong style='font-weight: bold'>SN = Special Notes</strong></em></br></br>

   <b id="new_project_text" >Total number of registrants: <strong><span id='total_registrants' style='font-size: 20px'></span></strong></b>
 </br>


</br><table class='table table-bordered' id="registrants">
      <thead>
        <tr>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Email</th>
          <th>Name Tag</th>
          <th>Dance Reg.</th>
          <th>Youth Dance Reg.</th>
          <th>Meal Package</th>
          <th>Dorm Room</th>
          <th>Roommate</th>
          <th>Date</th>
          <th>SN</th>
          <th>Coupon</th>
          <th>Total Cost</th>
          <th>Paid</th>
          <th>Vlntr</th>
          <th>Room#</th>
          <th>Reg Status</th>
          <th>Edit/Delete</th>
          <th>Notify/Email</th>
          </thead>

        </table>
      </body>
      </html>
