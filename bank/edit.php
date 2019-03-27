<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
include("../connection.php");
$bankcode=$_POST['bankcode'];
$detail=Run("SELECT * FROM BANK WHERE BANKCODE='$bankcode'");
$record=mssql_fetch_object($detail);
?>
<div class="row" id="loader_update">
</div>
<form role="form" id="form_update" action="javascript:update_data();" method="post" class="validate form-horizontal form-groups-bordered">
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Bank Code:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" readonly value="<?php echo $record-> BANKCODE ?>" id="bankcode_e" placeholder="Please Enter Bank Code" name="bankcode_e" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Bank Name:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="bankname_e" value="<?php echo $record-> BANKNAME ?>" placeholder="Please Enter Bank Name" name="bankname_e" required>
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-3 col-sm-5">
<button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
<a data-dismiss="modal"><button type="button" class="btn btn-danger waves-effect waves-light">Cancel</button></a>
</div>
</div>
</form>
<script>
$("#usertype_e").select2();
$(".select2-limiting").select2({
maximumSelectionLength: 2
});
</script>