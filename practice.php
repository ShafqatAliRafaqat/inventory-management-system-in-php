<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Purchase Voucher</title>
<link rel="shortcut icon" href="assets/img/icon.png" type="image/png">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
</head>
<body>
<!-- menu Bar-->
<?php 
include("header.php");
?>
<!-- End menu Bar-->
<style>
.focus {
	border: 1px solid #36404a;
	background-color: #ebeff2;
}
</style>

<div class="wrapper">
<div class="container">
<div class="panel panel-primary" data-collapsed="0">
<div class="panel-heading">
<div class="panel-title">
<h4>Purchase Voucher</h4>
</div>
</div>
<?php
$query=Run("SELECT MAX(VOUCHER_NO) AS NO FROM PURCH1");
$fetch_query=mssql_fetch_object($query);
$x=$fetch_query->NO+1;
?>
<div class="panel-body">
<form role="form" id="form_new" action="practice/save.php"  method="post" class="validate form-horizontal form-groups-bordered">

<div class="form-group">
<div class="col-sm-offset-2 col-sm-3">
<table class="table table-bordered table-stripped">
<tr>
<td>
<button type="button" id="backward" class="btn btn-default waves-effect waves-light"><i class="fa fa-arrow-left"></i></button>
</td>
<td>
<button type="button" id="refresh" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-refresh"></i></button>
</td>
<td>
<button type="button" id="forward" class="btn btn-default waves-effect waves-light"><i class="fa fa-arrow-right"></i></button>
</td>
<td>
<button type="button" id="print"  class="btn btn-info waves-effect waves-light"><i class="fa fa-print"></i></button>
</td>
<td>
<button type="button" id="delete"  class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></button>
</td>
</tr>
</table>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Voucher No:<span id="star">*</span></label>
<div class="col-sm-2">
<input type="text" class="form-control"  tabindex="1" id="voucher_no" name="voucher_no" value="<?php echo $x ?>" placeholder="Enter Voucher No" Required>
<input type="hidden" class="form-control"  id="max_voucher_no" name="max_voucher_no" value="<?php echo $x ?>">
</div>
</div>
<div id="reload_voucher">
<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Voucher Date:<span id="star">*</span></label>
<div class="col-sm-2">
<input type="text" class="form-control"  tabindex="2" id="voucher_date" name="voucher_date" value="<?php echo date('d/m/Y') ?>" placeholder="Enter Voucher Date" Required >
</div>
<div class="col-sm-2">
<button type="submit" class="btn btn-success waves-effect waves-light" ><i class="fa fa-check"></i> Save</button>
<a href="home.php"><button type="button" class="btn btn-danger waves-effect waves-light" ><i class="fa fa-remove"></i> Cancel</button></a>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Remarks: </label>
<div class="col-sm-5">
<input type="text" class="form-control"  tabindex="3" id="remarks" name="remarks" placeholder="Enter Remarks">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Party Code:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" Readonly  id="partycode" name="partycode" placeholder="Enter Party Code">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Party Name:<span id="star">*</span></label>
<div class="col-sm-5">
<select class="form-control select2" tabindex="4" data-allow-clear="true" id="partyname" name="partyname" Required onchange="document.getElementById('partycode').value=this.value;get_address(this.value);"> 
<option value=""> Please Select Party </option>
<?php 
$query_party=Run("SELECT * FROM PARTY WHERE PARTYTYPE='Supplier' ORDER BY PARTYNAME");
while($query_party_fetch=mssql_fetch_object($query_party))
{
$a=$query_party_fetch->PARTYCODE;
$b=$query_party_fetch->PARTYNAME;
?>
<option value="<?php echo $a?>"> <?php echo $b?> </option>
<?php
}
?>

</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Party Address:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control"  Readonly id="address" name="address" placeholder="Enter Party Address">
</div>
</div>
<table class="table table-bordered table-stripped" >
<tr>
<th style="width:15%;" id="custom-table-head">Product Code</th>
<th style="width:30%" id="custom-table-head">Product Name</th>
<th style="width:15%" id="custom-table-head">Unit</th>
<th style="width:10%" id="custom-table-head">Quantity</th>
<th style="width:10%" id="custom-table-head">Rate</th>
<th style="width:10%" id="custom-table-head">Amount</th>
<th id="custom-table-head">Actions</th>
</tr>
<tr>
<td>
<input type="text" class="form-control"  Readonly id="code_s" name="code_s" placeholder="Code">
<span id="code_s_error"></span>
</td>
<td>
<select type="text" class="form-control select2"  tabindex="5"  id="product_name_s" name="product_name_s" onchange="document.getElementById('code_s').value=this.value;get_data(this.value);"> 
<option value="">Please Select Product </option>
<?php 
$query_product=Run("SELECT * FROM PRODUCT ORDER BY PRODUCTNAME");
while($query_product_fetch=mssql_fetch_object($query_product))
{
$c=$query_product_fetch->PRODUCTCODE;
$d=$query_product_fetch->PRODUCTNAME;
?>
<option value="<?php echo $c ?>"> <?php echo $d ?>  </option>
<?php }
?>
</select>
<span id="product_name_s_error"></span>
</td>
<td>
<input type="text" class="form-control"  Readonly id="unit_s" name="unit_s" placeholder="Unit">
<span id="unit_s_error"></span>
</td>
<td>
<input type="text" class="form-control"  tabindex="6"   id="quantity_s" name="quantity_s" onkeyup="calculate_amount()" placeholder="Quantity">
<span id="quantity_s_error"></span>
</td>
<td>
<input type="text" class="form-control"  Readonly id="rate_s" name="rate_s" placeholder="(Rs.)">
<span id="rate_s_error"></span>
</td>
<td>
<input type="text" class="form-control"  Readonly id="amount_s" name="amount_s" placeholder="(Rs.)">
<span id="amount_s_error"></span>
</td>
<td>
<button type="button" class="typcn typcn-plus btn btn-block btn-default waves-effect waves-light" tabindex="7"  Onclick="generate_row()"> Add Row</button>
</td>
</tr>
<input type="hidden" class="form-control"  Readonly id="row_number" name="row_number" value="1">
</table>
<div id="show_tables">
</div>

<table class="table table-condensed table-bordered table-hover table-striped" >
<tr>
<th style="width:60%;text-align:right">Total Quantity:</th>
<th style="width:10%"><input type="text" class="form-control" id="totalquantity"  name="totalquantity" value="0" readonly></th>
<th style="width:10%;text-align:right">Total Amount:</th>
<th style="width:10%"><input type="text" class="form-control" id="totalamount"  name="totalamount" value="0" readonly></th>
<th></th>
</tr>
<tr>
<th style="text-align:right" colspan=3>Total Discount:</th>
<th><input type="text" class="form-control" onkeyup="calculate_discount()" id="discount"  name="discount"value="0" >
</th>
<th></th>
</tr>
<tr>
<th style="text-align:right;color:#14a81b" colspan=3>Grand Amount:</th>
<th><input type="text" class="form-control" id="grandamount"  name="grandamount" value="0" readonly></th>
<th></th>
</tr>
</table>
</div>
</form>
</div>
</div>
<!-- Footer -->
<footer class="footer text-right">
<div class="container">
<div class="row">
<div class="col-xs-6">
Lahore Garrison University @ 2018. All rights reserved.
</div>
</div>
</div>
</footer>
<!-- End Footer -->
</div>
</div>
<div class="modal fade" id="details_modal">
<div class="modal-dialog" >
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Details</h4>
</div>
<div class="modal-body" id="details">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<div class="modal fade" id="edit_modal">
<div class="modal-dialog" style="width:70%;">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Edit</h4>
</div>
<div class="modal-body" id="edit">
<table class="table table-bordered table-stripped" >
<tr>
<th style="width:15%;">Product Code</th>
<th style="width:30%">Product Name</th>
<th style="width:15%">Unit</th>
<th style="width:10%">Quantity</th>
<th style="width:10%">Rate</th>
<th style="width:10%">Amount</th>
</tr>
<tr>
<td>
<input type="text" class="form-control"  Readonly id="code" name="code" placeholder="Code">
<span id="code_edit_error"></span>
</td>
<td>
<select type="text" class="form-control select2"  id="product_name" name="product_name" onchange="document.getElementById('code').value=this.value;get_data_edit(this.value);"> 
<option value="">Please Select Product </option>
<?php 
$query_product=Run("SELECT * FROM PRODUCT ORDER BY PRODUCTNAME");
while($query_product_fetch=mssql_fetch_object($query_product))
{
$c=$query_product_fetch->PRODUCTCODE;
$d=$query_product_fetch->PRODUCTNAME;
?>
<option value="<?php echo $c ?>"> <?php echo $d ?>  </option>
<?php }
?>
</select>
<span id="product_name_edit_error"></span>
</td>
<td>
<input type="text" class="form-control"  Readonly id="unit" name="unit" placeholder="Unit">
<span id="unit_edit_error"></span>
</td>
<td>
<input type="text" class="form-control"   id="quantity" name="quantity" onkeyup="calculate_amount_edit()" placeholder="Quantity">
<span id="quantity_edit_error"></span>
</td>
<td>
<input type="text" class="form-control"  Readonly id="rate" name="rate" placeholder="(Rs.)">
<span id="rate_edit_error"></span>
</td>
<td>
<input type="text" class="form-control"  Readonly id="amount" name="amount" placeholder="(Rs.)">
<span id="amount_edit_error"></span>
</td>
</tr>
<input type="hidden" class="form-control" id="row_no"  name="row_no"  readonly>
</table>
<div class="form-group">
<div class="col-sm-offset-5 col-sm-5">
<button type="button" class="btn btn-warning waves-effect waves-light" Onclick="update_row()">Update</button>
<a data-dismiss="modal"><button type="button" class="btn btn-danger waves-effect waves-light">Cancel</button></a>
</div>
</div>
</div>
</div>
</div>
</div>  


<div class="modal fade" id="delete_modal">
<div class="modal-dialog" style="width:70%;" >
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Delete</h4>
</div>
<div class="modal-body" id="delete">
<table class="table table-bordered table-stripped" >
<tr>
<th style="width:15%">Product Code</th>
<th style="width:30%">Product Name</th>
<th style="width:15%">Unit</th>
<th style="width:10%">Quantity</th>
<th style="width:10%">Rate</th>
<th style="width:10%">Amount</th>
</tr>
<tr>
<td>
<input type="text" class="form-control" id="dcode"  name="dcode" placeholder="Code" readonly >
</td>
<td>
<input type="text" class="form-control" id="dproduct_name"  name="dproduct_name" placeholder="Code" readonly >
</td>
<td>
<input type="text" class="form-control" id="dunit"  readonly name="dunit" placeholder="Unit" >
</td>
<td>
<input type="text" class="form-control" id="dquantity"  readonly name="dquantity" placeholder="Quantity" >
</td>
<td>
<input type="text" class="form-control" id="drate"  name="drate" placeholder="(Rs.)" readonly>
</td>
<td>
<input type="text" class="form-control" id="damount"  name="damount" placeholder="(Rs.)" readonly>
</td>
</tr>
<input type="hidden" class="form-control" id="drow_no"  name="drow_no"  readonly>
</table>

<div class="form-group">
<div class="col-sm-offset-5 col-sm-5">
<button type="button" class="btn btn-warning waves-effect waves-light" Onclick="remove_row()">Delete</button>
<a data-dismiss="modal"><button type="button" class="btn btn-danger waves-effect waves-light">Cancel</button></a>
</div>
</div>
</div>
</div>
</div>
</div> 
<link href="assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
<script src="assets/plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="assets/plugins/notifyjs/dist/notify.min.js"></script>
<script src="assets/plugins/notifications/notify-metro.js"></script>
<link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>

<script src="practice/function.js" id="script-resource-8"></script>
<script src="practice/row.js" id="script-resource-8"></script>
<script>
$(".select2").select2();
$(".select2-limiting").select2({
maximumSelectionLength: 2
});

$(document).ready( function(){
$('#voucher_no').focus();
});

$('input[type="text"]').focus(function() {
	$(this).addClass("focus");
});


</script>

</body>
</html>