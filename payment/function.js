$("#backward").click(function(){
var voucher_no=$("#voucher_no").val();
voucher_no--;
if(voucher_no>0)
{
$("#voucher_no").val(voucher_no);
$("#reload_voucher").html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.post("payment/edit.php",{
voucher_no:voucher_no 
},function(data){
$('#reload_voucher').html(data);
total_amount();
});	 
}
});
$("#forward").click(function(){
var voucher_no=$("#voucher_no").val();
var max_voucher_no=$("#max_voucher_no").val();
voucher_no++;
if(voucher_no<=max_voucher_no)
{
$("#voucher_no").val(voucher_no);
$("#reload_voucher").html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.post("payment/edit.php",{
voucher_no:voucher_no 
},function(data){
$('#reload_voucher').html(data);
total_amount();
});	 
}
});
$("#refresh").click(function(){
var voucher_no=$("#voucher_no").val();
$("#reload_voucher").html('<h1 align="center"><img src="assets/images/loading _save.gif"/></h1>');
$.post("payment/edit.php",{
voucher_no:voucher_no 
},function(data){
$('#reload_voucher').html(data);
total_amount();
});	 
});
$("#print").click(function(){
var voucher_no=$("#voucher_no").val();
$('#print_modal').modal('show');
$.post("payment/print.php",{
voucher_no:voucher_no 
},function(data){
$('#print_body').html(data);
});	 
});
$("#delete").click(function(){
var voucher_no=$("#voucher_no").val();
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
url: "payment/delete.php",
data:
{
voucher_no:voucher_no
},
success: function(result)
{
//swal("Good job!", "Data Successfully Deleted", "success");
//$.post('payment/edit.php',{voucher_no:voucher_no},function(data){
//$('#reload_voucher').html(data);
//});
location.href="payment.php?popup=no";
}
});
});
});
function edit_row(row_no)
{
$('#edit_modal').modal('show');	
var code=document.getElementById('code'+row_no).value;
var party_name=document.getElementById('party_name'+row_no).value;
var description=document.getElementById('description'+row_no).value;
var amount=document.getElementById('amount'+row_no).value;	
document.getElementById('code').value=code;
document.getElementsByClassName("select2-chosen")[2].innerHTML=party_name;
document.getElementById('description').value=description;
document.getElementById('amount').value=amount;
document.getElementById('row_no').value=row_no;
}
function update_row()
{
var a=$("#code").val();
var b=document.getElementsByClassName('select2-chosen')[2].innerHTML;
var c=$("#description").val();
var d=$("#amount").val();
var row_no=$("#row_no").val();
if(a!='' && d!='' && d!=0)
{
var code=document.getElementById('code').value;
var party_name=document.getElementsByClassName('select2-chosen')[2].innerHTML;
var description=document.getElementById('description').value;
var amount=document.getElementById('amount').value;
document.getElementById('code'+row_no).value=code;
document.getElementById('party_name'+row_no).value=party_name;
document.getElementById('description'+row_no).value=description;
document.getElementById('amount'+row_no).value=amount;
$('#edit_modal').modal('hide');
$.Notification.autoHideNotify('black', 'bottom left', 'Good job!', 'Row Successfully Updated')
total_amount();	
}
else
{
if(a=='')
{
document.getElementById('code').style.borderColor ='red';
document.getElementById('code_edit_error').innerHTML='*Enter Product Name';
document.getElementById('code_edit_error').style.color='red';
}	
if(d=='' || d==0)
{
document.getElementById('amount').style.borderColor ='red';
document.getElementById('amount_edit_error').innerHTML='*Enter Amount';	
document.getElementById('amount_edit_error').style.color='red';	
}	
}
}
function delete_row(row_no)
{
$('#delete_modal').modal('show');	
var code=document.getElementById('code'+row_no).value;
var party_name=document.getElementById('party_name'+row_no).value;
var description=document.getElementById('description'+row_no).value;
var amount=document.getElementById('amount'+row_no).value;
document.getElementById('dcode').value=code;
document.getElementById('dparty_name').value=party_name;
document.getElementById('ddescription').value=description;
document.getElementById('damount').value=amount;
document.getElementById('drow_no').value=row_no;
}
function remove_row()
{
var drow_no=$("#drow_no").val();
document.getElementById('row'+drow_no).innerHTML="";
total_amount();	
$('#delete_modal').modal('hide');	
$.Notification.autoHideNotify('error', 'bottom left', 'Good job!', 'Row Successfully Deleted')
}
function total_amount()
{
var total_amounts=0;
$(".amount").each(function(){
var total=($(this).val());
total_amounts=parseFloat(total_amounts)+parseFloat(total);
});
$("#totalamount").val(total_amounts);		
}

function checkvalidation(){	
var totalamount=$("#totalamount").val();
var party_code=$("#party_code").val();
if(party_code=='' || party_code==0)
{
document.getElementById('party_code').style.borderColor ='red';
document.getElementById('party_code_error').innerHTML='*Enter Product Name';	
document.getElementById('party_code_error').style.color='red';
return false;
}
else if(totalamount=='' || totalamount==0)
{
swal("Warning", "Total Amount Must Be Greater Than Zero", "error");
return false;
}
}