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
<div class="wrapper">
<div class="container">
<div class="row">
<div class="panel panel-primary" data-collapsed="0">
<div class="panel-heading">
<div class="panel-title">
<h4>PURCHASE VOUCHER</h4>
</div>
</div>

<div class="panel-body">
<form role="form" id="form_new" action="javascript:save_data();" method="post" class="validate form-horizontal form-groups-bordered">


<?php
$query_row=Run("SELECT MAX(VOUCHER_NO) AS NO FROM PURCH1");
$query_fetch= mssql_fetch_object($query_row);
$x=$query_fetch->NO+1;
?>
<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Voucher No:<span id="star">*</span></label>
<div class="col-sm-2">
<input type="text" class="form-control" placeholder="Voucher No"  value="<?php echo $x?>" id="voucher_no" name="voucher_no" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Voucher Date:<span id="star">*</span></label>
<div class="col-sm-2">
<input type="text" class="form-control"  value="<?php echo date('d/m/Y')?>"  id="voucher_date" name="voucher_date" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Remarks:</label>
<div class="col-sm-5">
<input type="text" class="form-control" placeholder="Enter Remarks" id="remarks" name="remarks">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Party Code:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" placeholder="Enter Party Code" id="partycode" name="partycode" readonly required>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Party Name:<span id="star">*</span></label>
<div class="col-sm-5">
<select class="form-control select2" data-allow-clear="true"placeholder="Enter Party Code" id="partyname" name="partyname" required onchange="document.getElementById('partycode').value=this.value;get_address(this.value);">
<option value="">Please Select Party</option>
<?php 
$query_party=Run("SELECT * FROM PARTY WHERE PARTYTYPE='Supplier' ORDER BY PARTYNAME");
while ($query_party_fetch=mssql_fetch_object($query_party))
{
$a=$query_party_fetch->PARTYNAME;
$b=$query_party_fetch->PARTYCODE;
?>
<option value="<?php echo $b; ?>"> <?php echo $a;?>  </option>
<?php 
}
?>
</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Party Address:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" placeholder="Enter Party Address" id="address" name="address" readonly required>
</div>
</div>

<table class="table table-bordered table-stripped" >
<tr>
<input type="text" class="form-control" id="row_number" name="row_number" value="1" readonly>
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
<input type="text" class="form-control" placeholder="Code" id="code_s" name="code_s" readonly required>
<span id="code_s_error"></span>
</td>
<td>
<select class="form-control select2"  data-allow-clear="true" id="product_name_s" name="product_name_s" required onchange="document.getElementById('code_s').value=this.value;get_data(this.value);">
<option value=""> Please Select Product</option>
<?php 
$query_product=Run("SELECT * FROM PRODUCT ORDER BY PRODUCTNAME");
while($query_product_fetch= mssql_fetch_object($query_product))
{
$c=$query_product_fetch->PRODUCTNAME;
$d=$query_product_fetch->PRODUCTCODE;
?>
<option value="<?php echo $d ?>"> <?php echo $c ?> </option>
<?php
}
?>
</select>
</td>
<td>
<input type="text" class="form-control" placeholder="Unit" id="unit_s" name="unit_s" readonly required>
</td>
<td>
<input type="text" class="form-control" placeholder="Quantity" id="quantity_s" name="quantity_s" onkeyup="calculate_amount();"  required>
<span id="quantity_s_error"></span>
</td>
<td>
<input type="text" class="form-control" placeholder="(Rs.)" id="rate_s" name="rate_s" readonly required>
<span id="rate_s_error"></span>
</td>
<td>
<input type="text" class="form-control" placeholder="(Rs.)" id="amount_s" name="amount_s" readonly required>
<span id="amount_s_error"></span>
</td>
<td>
<button type="button" class="btn btn-block btn-default" OnClick="generate_row();" > Add Row</button>
</td>
</tr>
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
<th><input type="text" class="form-control" onkeyup="calculate_discount()" id="discount"  name="discount" value="0" ></th>
<th></th>
</tr>
<tr>
<th style="text-align:right;color:#14a81b" colspan=3>Grand Amount:</th>
<th><input type="text" class="form-control" id="grandamount"  name="grandamount" value="0" readonly></th>
<th>

</th>
</tr>
</table>
</form>
</div>
</div>

</div>
</div>
<script>
$(window).load(function()
{
$.post('bank/list.php',{},function(data){
$('#reload_list').html(data);
});
});
</script>
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
<div class="modal fade" id="delete_modal">
<div class="modal-dialog" style="width:70%;">
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
<th style="width:15%">Product Code</th>
<th style="width:30%">Product Name</th>
<th style="width:15%">Unit</th>
<th style="width:10%">Quantity</th>
<th style="width:10%">Rate</th>
<th style="width:10%">Amount</th>
</tr>
<tr>
<td>
<input type="text" class="form-control" id="code"  name="code" placeholder="Code" readonly >
<span id="code_edit_error"></span>
</td>
<td>
<select  class="form-control select2" data-allow-clear="true" name="product_name"  id="product_name" onchange="document.getElementById('code').value=this.value;get_data_edit(this.value);">
<option value="">Please Select Product</option>
<?php
$query_product=Run("SELECT * FROM PRODUCT ORDER BY PRODUCTNAME ASC");
while($fetch_procduct=mssql_fetch_object($query_product))
{
$a=$fetch_procduct->PRODUCTCODE;
$b=$fetch_procduct->PRODUCTNAME;
?>
<option value="<?php echo $a ?>"><?php echo $b?></option>
<?php 
}
?>
</select>
</td>
<td>
<input type="text" class="form-control" id="unit"  name="unit" placeholder="Unit" readonly>
</td>
<td>
<input type="text" class="form-control" id="quantity"  name="quantity" placeholder="Quantity" onkeyup="calculate_amount_edit();">
<span id="quantity_edit_error"></span>
</td>
<td>
<input type="text" class="form-control" id="rate"  name="rate" placeholder="(Rs.)" onkeyup="calculate_amount_edit();" readonly>
<span id="rate_edit_error"></span>
</td>
<td>
<input type="text" class="form-control" id="amount"  name="amount" placeholder="(Rs.)" readonly>
<span id="amount_edit_error"></span>
</td>
</tr>
<input type="text" class="form-control" id="row_no"  name="row_no"  readonly>
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

<link href="assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
<script src="assets/plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="assets/plugins/notifyjs/dist/notify.min.js"></script>
<script src="assets/plugins/notifications/notify-metro.js"></script>
<link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>

<script src="test/function.js" id="script-resource-8"></script>
<script src="test/row.js" id="script-resource-8"></script>
<script>
$(".select2").select2();
$(".select2-limiting").select2({
maximumSelectionLength: 2
});
</script>

</body>
</html>