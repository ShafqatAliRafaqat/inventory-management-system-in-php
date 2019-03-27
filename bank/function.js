function save_data()
{
var bankcode = $('#bankcode').val();
var bankname= $('#bankname').val();
$('#form_new').css('display','none');
$('#loader_new').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.ajax({
type: "POST",
url: "bank/save.php",
data:
{
bankcode: bankcode,
bankname: bankname,
status:'SAVE'
},
success: function(result)
{ 
if(result=='FALSE')
{
swal("Bank Name Alreay Exist")
$('#loader_new').html('');
$('#form_new').css('display','inline');

}
else
{
swal("Good job!","Record Successfully Saved", "success");
$.post('bank/reload.php',{},function(data){
$('#reload_form').html(data);
});
$.post('bank/list.php',{},function(data){
$('#reload_list').html(data);
});	
}	
}
});
}

function update_data()
{
var bankcode = $('#bankcode_e').val();
var bankname= $('#bankname_e').val();
$('#form_update').css('display','none');
$('#loader_update').html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.ajax({
type: "POST",
url: "bank/save.php",
data:
{
bankcode: bankcode,
bankname: bankname,
status:'UPDATE'
},
success: function(result)
{  
if(result=='FALSE')
{
swal("Bank Name Alreay Exist")
$('#loader_update').html('');
$('#form_update').css('display','inline');
}
else
{
$('#edit_modal').modal('hide');
swal("Good job!","Record Successfully Updated", "success");
$.post('bank/reload.php',{},function(data){
$('#reload_form').html(data);
});
$.post('bank/list.php',{},function(data){
$('#reload_list').html(data);
});	
}	
}
});
}
function details_data(bankcode)
{
$('#details_modal').modal('show');
$.ajax({
type: "POST",
url: "bank/details.php",
data:
{
bankcode:bankcode
},
success: function(data)
{   
$('#details').html(data);
}
});	
}
function edit_data(bankcode)
{
$('#edit_modal').modal('show');
$.ajax({
type: "POST",
url: "bank/edit.php",
data:
{
bankcode:bankcode
},
success: function(data)
{   
$('#edit').html(data);
}
});	
}
function delete_data(bankcode)
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
url: "bank/delete.php",
data:
{
bankcode:bankcode
},
success: function(result)
{
swal("Good job!", "Data Successfully Deleted", "success");
$.post('bank/list.php',{},function(data){
$('#reload_list').html(data);
});
$.post('bank/reload.php',{},function(data){
$('#reload_form').html(data);
});
}
});
});
}