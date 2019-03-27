<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}       
include("../connection.php");
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
<script>
$("#usertype").select2();
$(".select2-limiting").select2({
maximumSelectionLength: 2
});
</script>