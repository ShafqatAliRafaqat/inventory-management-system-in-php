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
<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<title>Account Activity Information</title>
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
<div class="col-sm-12">
<div class="panel panel-primary" data-collapsed="0">
<div class="panel-heading">
<div class="panel-title">
<h4>Account Activity Information</h4>
</div>
</div>
<div class="panel-body">
<form role="form" id="form_new" method="post" class="validate form-horizontal form-groups-bordered">
<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Account Code:<span id="star">*</span></label>
<div class="col-sm-3">
<input type="text" class="form-control" readonly id="account_code" placeholder="Account Code" name="account_code" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Account Name:<span id="star">*</span></label>
<div class="col-sm-3">
<select class="form-control select2" data-allow-clear="true" name="account_name"  id="account_name" onchange="document.getElementById('account_code').value=this.value;">
<option value="">Please Select Account</option>
<?php
$query_account=Run("SELECT * FROM ACCOUNT ORDER BY ACCOUNTNAME ASC");
while($fetch_account=mssql_fetch_object($query_account))
{
$a=$fetch_account->ACCOUNTCODE;
$b=$fetch_account->ACCOUNTNAME;
?>
<option value="<?php echo $a ?>"><?php echo $b?></option>
<?php 
}
$query_party=Run("SELECT * FROM PARTY ORDER BY PARTYNAME ASC");
while($fetch_party=mssql_fetch_object($query_party))
{
$a=$fetch_party->PARTYCODE;
$b=$fetch_party->PARTYNAME;
?>
<option value="<?php echo $a ?>"><?php echo $b?></option>
<?php 
}
?>
</select>
</div>
</div>
<div class="form-group">
<label for="field-1" class="col-sm-2 control-label"  style="color:black;">Date Range:<span id="star">*</span></label>
<div class="col-sm-3">
<input class="form-control input-daterange-datepicker" data-mask='99/99/9999 - 99/99/9999' style="cursor:pointer;" id="daterange" type="text" name="daterange"/>
</div>
</div> 
<div class="form-group">
<div class="col-sm-offset-3 col-sm-5">
<button type="button" id="submit" name="submit" class="btn btn-success waves-effect waves-light">Load Report</button>
<a href="home.php"><button type="button" class="btn btn-danger waves-effect waves-light">Cancel</button></a>
</div>
</div>
</form>
</div>
</div>
</div>
<div class="col-sm-12">
<div class="panel panel-primary" data-collapsed="0">
<div class="panel-heading">
<div class="panel-title">
<h4>Account Activity Report</h4>
</div>
</div>
<div class="panel-body" id="load_report">
</div>
</div>
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

<div class="modal fade" id="print_modal">
<div class="modal-dialog"  style="width:100%">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Print</h4>
</div>
<div class="modal-body" id="print_body">
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
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="bank/function.js" id="script-resource-8"></script>
<script>
$(document).ready(function(){
$("#submit").click(function(){
var account_code=$("#account_code").val();
var daterange=$("#daterange").val();
if(account_code=="" || account_code=="0")
{
$("#account_name").select2("open");	
}
else if(daterange=="" || daterange=="0")
{
$("#daterange").focus();
}
else{
$('#load_report').html('<h1 align="center"><img src="assets/images/Loading _save.gif"/></h1>');
$.post("financial_reports/account_activity.php",{
account_code:account_code,
daterange:daterange
},function(data){
$("#load_report").html(data);	
});	
}	
});	
});
$(".select2").select2();
$(".select2-limiting").select2({
maximumSelectionLength: 2
});
$('.input-daterange-datepicker').daterangepicker({
buttonClasses: ['btn', 'btn-sm'],
applyClass: 'btn-default',
cancelClass: 'btn-white',
locale: {
format: 'DD/MM/YYYY'
}
});
</script> 
</body>
</html>