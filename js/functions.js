//new function
function done(){

var cct_values = {};
var wattages = {};
var empty = false;
cct_values.length = 0;
wattages.length = 0;
$(".family_children").each(function(){
 if($(this).val() === ""){
	 empty = true;
 }
cct_values[$(this).attr('id')] = $(this).val();
});
$(".wattages").each(function(){
 if($(this).val() === ""){
	 empty = true;
 }
 var wattage = $(this).attr('id').split("/");
wattages[wattage[1]] = $(this).val();
});
if(empty === true){
 $("#output").html("</br><strong> Please fill in all the required fields to autoscale!");
 cct_values.length = 0;
 wattages.length = 0;
}else{

$('#output').empty();

$.post('../family_action.php',{
postcct_values : cct_values,
postwattages : wattages
}, function(data){
$('#output').html(data);
location.reload();
});
}

}
