<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}       
include("../connection.php");
$query_max = Run("select max(BANKCODE) AS CODE from BANK");
$x = mssql_fetch_object($query_max);
$id = $x->CODE+1;
?>
<div class="row" id="loader_new">
</div>
<form role="form" id="form_new" action="javascript:save_data();" method="post" class="validate form-horizontal form-groups-bordered">
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Bank Code:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" readonly value="<?php echo $id ?>" id="bankcode" placeholder="Please Enter Bank Code" name="bankcode" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Bank Name:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="bankname" placeholder="Please Enter Bank Name" name="bankname" required>
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-3 col-sm-5">
<button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
<a href="home.php"><button type="button" class="btn btn-danger waves-effect waves-light">Cancel</button></a>
</div>
</div>
</form>
<script>
$("#usertype").select2();
$(".select2-limiting").select2({
maximumSelectionLength: 2
});
</script>