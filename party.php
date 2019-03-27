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
<title>Party Information</title>
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
<h4>Party Information</h4>
</div>
</div>
<div class="panel-body" id="reload_form">
<?php
$query_max = Run("select max(PARTYCODE) AS CODE from PARTY");
$x = mssql_fetch_object($query_max);
$id = $x->CODE;
if($id=='')
{
$id=5000;	
}
else
{
$id=$id+1;	
}
?>
<div class="row" id="loader_new">
</div>
<form role="form" id="form_new" action="javascript:save_data();" method="post" class="validate form-horizontal form-groups-bordered">
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Party Code:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" readonly value="<?php echo $id ?>" id="partycode" placeholder="Please Enter Party Code" name="partycode" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Party Name:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="partyname" placeholder="Please Enter Party Name" name="partyname" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Party Type:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="radio"  id="partytype" name="partytype" value="Customer" checked>Customer</input>
<input type="radio"  id="partytype" name="partytype" value="Supplier">Supplier</input>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Party Address:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="address" placeholder="Please Enter Party Address" name="address" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Mobile:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="mobile" data-mask="9999-9999999" placeholder="Please Enter Mobile" name="mobile" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Telephone:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="telephone" data-mask="999-9999999"placeholder="Please Enter Telephone" name="telephone">
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-3 col-sm-5">
<button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
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
<h4>List Party</h4>
</div>
</div>
<div class="panel-body" id="reload_list">
</div>
</div>
</div>
</div>
<script>
$(window).load(function()
{
$.post('party/list.php',{},function(data){
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
<div class="modal fade" id="details_modal">
<div class="modal-dialog" style="width:45%;">
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
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Edit</h4>
</div>
<div class="modal-body" id="edit">
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

<script src="party/function.js" id="script-resource-8"></script>
<script>
$(".select2").select2();
$(".select2-limiting").select2({
maximumSelectionLength: 2
});
</script>

</body>
</html>