function save_data()
{
var username = $('#username').val();
var password= $('#password').val();
var type= $('#usertype').val();
var voucher_edit=$('input[name=voucher_edit]:checked').val();
var voucher_delete=$('input[name=voucher_delete]:checked').val();
$('#form_new').css('display','none');
$('#loader_new').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.ajax({
type: "POST",
url: "user/save.php",
data:
{
username: username,
password: password,
voucher_edit: voucher_edit,
voucher_delete: voucher_delete,
type: type,
status:'SAVE'
},
success: function(result)
{  
if(result=='FALSE')
{
swal("User Name Alreay Exist")
$('#loader_new').html('');
$('#form_new').css('display','inline');

}
else
{
swal("Good job!","Record Successfully Saved", "success");
$.post('user/reload.php',{},function(data){
$('#reload_form').html(data);
});
$.post('user/list.php',{},function(data){
$('#reload_list').html(data);
});	
}	
}
});
}

function update_data()
{
var username = $('#username_e').val();
var password= $('#password_e').val();
var type= $('#usertype_e').val();
var voucher_edit=$('input[name=voucher_edit_e]:checked').val();
var voucher_delete=$('input[name=voucher_delete_e]:checked').val();
$('#form_update').css('display','none');
$('#loader_update').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.ajax({
type: "POST",
url: "user/save.php",
data:
{
username: username,
password: password,
voucher_edit: voucher_edit,
voucher_delete: voucher_delete,
type: type,
status:'UPDATE'
},
success: function(result)
{  
if(result=='FALSE')
{
swal("User Name Alreay Exist")
$('#loader_update').html('');
$('#form_update').css('display','inline');
}
else
{
$('#edit_modal').modal('hide');
swal("Good job!","Record Successfully Updated", "success");
$.post('user/reload.php',{},function(data){
$('#reload_form').html(data);
});
$.post('user/list.php',{},function(data){
$('#reload_list').html(data);
});	
}	
}
});
}
function details_data(username)
{
$('#details_modal').modal('show');
$.ajax({
type: "POST",
url: "user/details.php",
data:
{
username:username
},
success: function(data)
{   
$('#details').html(data);
}
});	
}
function edit_data(username)
{
$('#edit_modal').modal('show');
$.ajax({
type: "POST",
url: "user/edit.php",
data:
{
username:username
},
success: function(data)
{   
$('#edit').html(data);
}
});	
}
function delete_data(username)
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
url: "user/delete.php",
data:
{
username:username
},
success: function(result)
{
swal("Good job!", "Data Successfully Deleted", "success");
$.post('user/list.php',{},function(data){
$('#reload_list').html(data);
});
$.post('user/reload.php',{},function(data){
$('#reload_form').html(data);
});
}
});
});
}