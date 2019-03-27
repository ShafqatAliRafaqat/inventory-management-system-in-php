<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
include("../connection.php");
$partycode=$_POST['partycode'];
$detail=Run("SELECT * FROM PARTY WHERE PARTYCODE='$partycode'");
$record=mssql_fetch_object($detail);
$type=$record-> PARTYTYPE;
?>
<div class="row" id="loader_update">
</div>
<form role="form" id="form_update" action="javascript:update_data();" method="post" class="validate form-horizontal form-groups-bordered">
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Party Code:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" readonly value="<?php echo $record-> PARTYCODE ?>" id="partycode_e" placeholder="Please Enter Party Code" name="partycode_e" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Party Name:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="partyname_e" value="<?php echo $record-> PARTYNAME ?>" placeholder="Please Enter Party Name" name="partyname_e" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Party Type:<span id="star">*</span></label>
<div class="col-sm-5">

<input type="radio"  id="partytype" name="partytype_e" value="Customer" <?php if($type=='Customer'){echo "checked";}?> >Customer</input>

<input type="radio"  id="partytype" name="partytype_e" <?php if($type=='Supplier'){echo "checked";}?> value="Supplier">Supplier</input>
</div>

</div>
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Party Address:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="address_e"  value="<?php echo $record-> ADDRESS ?>" placeholder="Please Enter Party Address" name="address_e" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Mobile:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="mobile_e" value="<?php echo $record-> MOBILE ?>" placeholder="Please Enter Mobile" name="mobile_e" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Telephone:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="telephone_e" value="<?php echo $record-> TELEPHONE ?>" placeholder="Please Enter Telephone" name="telephone_e" required>
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