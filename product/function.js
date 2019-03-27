function save_data()
{
var productcode = $('#productcode').val();
var productname= $('#productname').val();
var unit= $('#unit').val();
var salerate= $('#salerate').val();
var purchaserate= $('#purchaserate').val();
$('#form_new').css('display','none');
$('#loader_new').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.ajax({
type: "POST",
url: "product/save.php",
data:
{
productcode: productcode,
productname: productname,
unit: unit,
salerate: salerate,
purchaserate: purchaserate,
status:'SAVE'
},
success: function(result)
{ 
if(result=='FALSE')
{
swal("Product Name Alreay Exist")
$('#loader_new').html('');
$('#form_new').css('display','inline');

}
else
{
swal("Good job!","Record Successfully Saved", "success");
$.post('product/reload.php',{},function(data){
$('#reload_form').html(data);
});
$.post('product/list.php',{},function(data){
$('#reload_list').html(data);
});	
}	
}
});
}

function update_data()
{
var productcode = $('#productcode_e').val();
var productname= $('#productname_e').val();
var unit= $('#unit_e').val();
var purchaserate= $('#purchaserate_e').val();
var salerate= $('#salerate_e').val();
$('#form_update').css('display','none');
$('#loader_update').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.ajax({
type: "POST",
url: "product/save.php",
data:
{
productcode: productcode,
productname: productname,
unit: unit,
purchaserate: purchaserate,
salerate: salerate,
status:'UPDATE'
},
success: function(result)
{  
if(result=='FALSE')
{
swal("Product Name Alreay Exist")
$('#loader_update').html('');
$('#form_update').css('display','inline');
}
else
{
$('#edit_modal').modal('hide');
swal("Good job!","Record Successfully Updated", "success");
$.post('product/reload.php',{},function(data){
$('#reload_form').html(data);
});
$.post('product/list.php',{},function(data){
$('#reload_list').html(data);
});	
}	
}
});
}
function details_data(productcode)
{
$('#details_modal').modal('show');
$.ajax({
type: "POST",
url: "product/details.php",
data:
{
productcode:productcode
},
success: function(data)
{   
$('#details').html(data);
}
});	
}
function edit_data(productcode)
{
$('#edit_modal').modal('show');
$.ajax({
type: "POST",
url: "product/edit.php",
data:
{
productcode:productcode
},
success: function(data)
{   
$('#edit').html(data);
}
});	
}
function delete_data(productcode)
{ 
swal({
title: "Are you sure?",
text: "Your will not be able to recover this imaginary file!",
type: "warning",
showCancelButton: true,
confirmButtonClass: "btn-danger",
confirmButtonText: "Yes, delete it!",
closeOnConfirm: false
},
function(){
$.ajax({
type: "POST",
url: "product/delete.php",
data:
{
productcode:productcode
},
success: function(result)
{
swal("Good job!", "Data Successfully Deleted", "success");
$.post('product/list.php',{},function(data){
$('#reload_list').html(data);
});
$.post('product/reload.php',{},function(data){
$('#reload_form').html(data);
});
}
});
});
}
//list
function update_data_list()
{
var productcode = $('#productcode_e').val();
var productname= $('#productname_e').val();
var unit= $('#unit_e').val();
var purchaserate= $('#purchaserate_e').val();
var salerate= $('#salerate_e').val();
$('#form_update').css('display','none');
$('#loader_update').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.ajax({
type: "POST",
url: "product/save.php",
data:
{
productcode: productcode,
productname: productname,
unit: unit,
purchaserate: purchaserate,
salerate: salerate,
status:'UPDATE'
},
success: function(result)
{  
if(result=='FALSE')
{
swal("Product Name Alreay Exist")
$('#loader_update').html('');
$('#form_update').css('display','inline');
}
else
{
$('#edit_modal').modal('hide');
swal("Good job!","Record Successfully Updated", "success");
$.post('product/product_list.php',{},function(data){
$('#reload_list').html(data);
});	
}	
}
});
}
function edit_data_list(productcode)
{
$('#edit_modal').modal('show');
$.ajax({
type: "POST",
url: "product/edit_list.php",
data:
{
productcode:productcode
},
success: function(data)
{   
$('#edit').html(data);
}
});	
}