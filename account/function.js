function save_data()
{
var accountcode = $('#accountcode').val();
var accountname= $('#accountname').val();
var accounttype= $('#accounttype').val();
$('#form_new').css('display','none');
$('#loader_new').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.ajax({
type: "POST",
url: "account/save.php",
data:
{
accountcode: accountcode,
accountname: accountname,
accounttype: accounttype,
status:'SAVE'
},
success: function(result)
{ 
if(result=='FALSE')
{
swal("Account Name Alreay Exist")
$('#loader_new').html('');
$('#form_new').css('display','inline');

}
else
{
swal("Good job!","Record Successfully Saved", "success");
$.post('account/reload.php',{},function(data){
$('#reload_form').html(data);
});
$.post('account/list.php',{},function(data){
$('#reload_list').html(data);
});	
}	
}
});
}

function update_data()
{
var accountcode = $('#accountcode_e').val();
var accountname= $('#accountname_e').val();
var accounttype= $('#accounttype_e').val();
$('#form_update').css('display','none');
$('#loader_update').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.ajax({
type: "POST",
url: "account/save.php",
data:
{
accountcode: accountcode,
accountname: accountname,
accounttype: accounttype,
status:'UPDATE'
},
success: function(result)
{  
if(result=='FALSE')
{
swal("Account Name Alreay Exist")
$('#loader_update').html('');
$('#form_update').css('display','inline');
}
else
{
$('#edit_modal').modal('hide');
swal("Good job!","Record Successfully Updated", "success");
$.post('account/reload.php',{},function(data){
$('#reload_form').html(data);
});
$.post('account/list.php',{},function(data){
$('#reload_list').html(data);
});	
}	
}
});
}
function details_data(accountcode)
{
$('#details_modal').modal('show');
$.ajax({
type: "POST",
url: "account/details.php",
data:
{
accountcode:accountcode
},
success: function(data)
{   
$('#details').html(data);
}
});	
}
function edit_data(accountcode)
{
$('#edit_modal').modal('show');
$.ajax({
type: "POST",
url: "account/edit.php",
data:
{
accountcode:accountcode
},
success: function(data)
{   
$('#edit').html(data);
}
});	
}
function delete_data(accountcode)
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
url: "account/delete.php",
data:
{
accountcode:accountcode
},
success: function(result)
{
swal("Good job!", "Data Successfully Deleted", "success");
$.post('account/list.php',{},function(data){
$('#reload_list').html(data);
});
$.post('account/reload.php',{},function(data){
$('#reload_form').html(data);
});
}
});
});
}