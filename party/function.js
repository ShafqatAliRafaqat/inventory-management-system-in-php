function save_data()
{
var partycode = $('#partycode').val();
var partyname= $('#partyname').val();
var partytype = $('input[name=partytype]:checked').val();
var address= $('#address').val();
var mobile= $('#mobile').val();
var telephone= $('#telephone').val();
$('#form_new').css('display','none');
$('#loader_new').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.ajax({
type: "POST",
url: "party/save.php",
data:
{
partycode: partycode,
partyname: partyname,
partytype: partytype,
address: address,
mobile: mobile,
telephone: telephone,
status:'SAVE'
},
success: function(result)
{ 
if(result=='FALSE')
{
swal("Party Name Alreay Exist")
$('#loader_new').html('');
$('#form_new').css('display','inline');

}
else
{
swal("Good job!","Record Successfully Saved", "success");
$.post('party/reload.php',{},function(data){
$('#reload_form').html(data);
});
$.post('party/list.php',{},function(data){
$('#reload_list').html(data);
});	
}	
}
});
}

function update_data()
{
var partycode = $('#partycode_e').val();
var partyname= $('#partyname_e').val();
var partytype = $('input[name=partytype_e]:checked').val();
var address= $('#address_e').val();
var telephone= $('#telephone_e').val();
var mobile= $('#mobile_e').val();
$('#form_update').css('display','none');
$('#loader_update').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.ajax({
type: "POST",
url: "party/save.php",
data:
{
partycode: partycode,
partyname: partyname,
partytype: partytype,
address: address,
telephone: telephone,
mobile: mobile,
status:'UPDATE'
},
success: function(result)
{  
if(result=='FALSE')
{
swal("Party Name Alreay Exist")
$('#loader_update').html('');
$('#form_update').css('display','inline');
}
else
{
$('#edit_modal').modal('hide');
swal("Good job!","Record Successfully Updated", "success");
$.post('party/reload.php',{},function(data){
$('#reload_form').html(data);
});
$.post('party/list.php',{},function(data){
$('#reload_list').html(data);
});	
}	
}
});
}
function details_data(partycode)
{
$('#details_modal').modal('show');
$.ajax({
type: "POST",
url: "party/details.php",
data:
{
partycode:partycode
},
success: function(data)
{   
$('#details').html(data);
}
});	
}
function edit_data(partycode)
{
$('#edit_modal').modal('show');
$.ajax({
type: "POST",
url: "party/edit.php",
data:
{
partycode:partycode
},
success: function(data)
{   
$('#edit').html(data);
}
});	
}
function delete_data(partycode)
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
url: "party/delete.php",
data:
{
partycode:partycode
},
success: function(result)
{
swal("Good job!", "Data Successfully Deleted", "success");
$.post('party/list.php',{},function(data){
$('#reload_list').html(data);
});
$.post('party/reload.php',{},function(data){
$('#reload_form').html(data);
});
}
});
});
}
//Customer list
function update_data_customer()
{
var partycode = $('#partycode_e').val();
var partyname= $('#partyname_e').val();
var partytype = $('input[name=partytype_e]:checked').val();
var address= $('#address_e').val();
var telephone= $('#telephone_e').val();
var mobile= $('#mobile_e').val();
$('#form_update').css('display','none');
$('#loader_update').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.ajax({
type: "POST",
url: "party/save.php",
data:
{
partycode: partycode,
partyname: partyname,
partytype: partytype,
address: address,
telephone: telephone,
mobile: mobile,
status:'UPDATE'
},
success: function(result)
{  
if(result=='FALSE')
{
swal("Party Name Alreay Exist")
$('#loader_update').html('');
$('#form_update').css('display','inline');
}
else
{
$('#edit_modal').modal('hide');
swal("Good job!","Record Successfully Updated", "success");
$.post('party/customer_list.php',{},function(data){
$('#reload_list').html(data);
});	
}	
}
});
}
function delete_data_customer(partycode)
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
url: "party/delete.php",
data:
{
partycode:partycode
},
success: function(result)
{
swal("Good job!", "Data Successfully Deleted", "success");
$.post('party/customer_list.php',{},function(data){
$('#reload_list').html(data);
});
}
});
});
}
function edit_data_customer(partycode)
{
$('#edit_modal').modal('show');
$.ajax({
type: "POST",
url: "party/edit_customer.php",
data:
{
partycode:partycode
},
success: function(data)
{   
$('#edit').html(data);
}
});	
}
// Supplier List
function update_data_supplier()
{
var partycode = $('#partycode_e').val();
var partyname= $('#partyname_e').val();
var partytype = $('input[name=partytype_e]:checked').val();
var address= $('#address_e').val();
var telephone= $('#telephone_e').val();
var mobile= $('#mobile_e').val();
$('#form_update').css('display','none');
$('#loader_update').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.ajax({
type: "POST",
url: "party/save.php",
data:
{
partycode: partycode,
partyname: partyname,
partytype: partytype,
address: address,
telephone: telephone,
mobile: mobile,
status:'UPDATE'
},
success: function(result)
{  
if(result=='FALSE')
{
swal("Party Name Alreay Exist")
$('#loader_update').html('');
$('#form_update').css('display','inline');
}
else
{
$('#edit_modal').modal('hide');
swal("Good job!","Record Successfully Updated", "success");
$.post('party/supplier_list.php',{},function(data){
$('#reload_list').html(data);
});	
}	
}
});
}
function delete_data_supplier(partycode)
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
url: "party/delete.php",
data:
{
partycode:partycode
},
success: function(result)
{
swal("Good job!", "Data Successfully Deleted", "success");
$.post('party/supplier_list.php',{},function(data){
$('#reload_list').html(data);
});
}
});
});
}
function edit_data_supplier(partycode)
{
$('#edit_modal').modal('show');
$.ajax({
type: "POST",
url: "party/edit_supplier.php",
data:
{
partycode:partycode
},
success: function(data)
{   
$('#edit').html(data);
}
});	
}