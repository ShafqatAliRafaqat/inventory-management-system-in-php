<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
include("../connection.php");
$accountcode=$_POST['accountcode'];
$detail=Run("SELECT * FROM ACCOUNT WHERE ACCOUNTCODE='$accountcode'");
$record=mssql_fetch_object($detail);
$a=$record->ATYPE;
?>
<div class="row" id="loader_update">
</div>
<form role="form" id="form_update" action="javascript:update_data();" method="post" class="validate form-horizontal form-groups-bordered">
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Account Code:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" readonly value="<?php echo $record-> ACCOUNTCODE ?>" id="accountcode_e" placeholder="Please Enter Account Code" name="accountcode_e" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Account Name:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="accountname_e" value="<?php echo $record-> ACCOUNTNAME ?>" placeholder="Please Enter Account Name" name="accountname_e" required>
</div>
</div>
<div class="form-group">
<label  class="col-sm-3 control-label" style="color:black;">Account Type:<span id="star">*</span></label>
<div class="col-sm-5">
<select  class="form-control select2" data-allow-clear="true" name="accounttype_e"  id="accounttype_e" required="required">
<option value="">Please Select Type</option>
<?php
$query_type=Run("SELECT * FROM ACCOUNT_TYPE ORDER BY ATYPE_NAME ASC");
while($fetch_type=mssql_fetch_object($query_type))
{
$b=$fetch_type->ATYPE;
$c=$fetch_type->ATYPE_NAME;
if($a==$b)
{
?>
<option value="<?php echo $b; ?>" Selected ><?php echo $c;?></option>
<?php
}
else
{
?>
<option value="<?php echo $b;?>" ><?php echo $c;?></option>
<?php
}
}
?>
</select>
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
$("#accounttype_e").select2();
$(".select2-limiting").select2({
maximumSelectionLength: 2
});
</script>