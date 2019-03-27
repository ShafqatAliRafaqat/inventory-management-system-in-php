<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
include("../connection.php");
$productcode=$_POST['productcode'];
$detail=Run("SELECT * FROM PRODUCT WHERE PRODUCTCODE='$productcode'");
$record=mssql_fetch_object($detail);
?>
<div class="row" id="loader_update">
</div>
<form role="form" id="form_update" action="javascript:update_data_list();" method="post" class="validate form-horizontal form-groups-bordered">
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Product Code:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" readonly value="<?php echo $record-> PRODUCTCODE ?>" id="productcode_e" placeholder="Please Enter Product Code" name="productcode_e" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Product Name:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="productname_e" value="<?php echo $record-> PRODUCTNAME ?>" placeholder="Please Enter Product Name" name="productname_e" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Product Unit:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="unit_e"  value="<?php echo $record-> UNIT ?>" placeholder="Please Enter Product Unit" name="unit_e" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Sale Rate:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="salerate_e" value="<?php echo $record-> SALERATE ?>" placeholder="Please Enter Sale Rate" name="salerate_e" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Purchase Rate:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="purchaserate_e" value="<?php echo $record-> PURCHASERATE ?>" placeholder="Please Enter Purchase Rate" name="purchaserate_e" required>
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