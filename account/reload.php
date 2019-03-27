<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}       
include("../connection.php");
$query_max = Run("select max(ACCOUNTCODE) AS CODE from ACCOUNT");
$x = mssql_fetch_object($query_max);
$id = $x->CODE+1;
?>
<div class="row" id="loader_new">
</div>
<form role="form" id="form_new" action="javascript:save_data();" method="post" class="validate form-horizontal form-groups-bordered">
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Account Code:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" readonly value="<?php echo $id ?>" id="accountcode" placeholder="Please Enter Account Code" name="accountcode" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Account Name:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="accountname" placeholder="Please Enter Account Name" name="accountname" required>
</div>
</div>

<div class="form-group">
<label  class="col-sm-3 control-label" style="color:black;">Account Type:<span id="star">*</span></label>
<div class="col-sm-5">
<select  class="form-control select2" data-allow-clear="true" name="accounttype"  id="accounttype" required="required">
<option value="">Please Select Type</option>
<?php
$query_type=Run("SELECT * FROM ACCOUNT_TYPE ORDER BY ATYPE_NAME ASC");
while($fetch_type=mssql_fetch_object($query_type))
{
$a=$fetch_type->ATYPE;
$b=$fetch_type->ATYPE_NAME;
?>
<option value="<?php echo $a ?>"><?php echo $b?></option>

<?php 
}
?>
</select>
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
$("#accounttype").select2();
$(".select2-limiting").select2({
maximumSelectionLength: 2
});
</script>