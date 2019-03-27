<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
include("../connection.php");
$username=$_POST['username'];
$detail=Run("SELECT * FROM LOGIN WHERE USERNAME='$username'");
$record=mssql_fetch_object($detail);
?>
<div class="row" id="loader_update">
</div>
<form role="form" id="form_update" action="javascript:update_data();" method="post" class="validate form-horizontal form-groups-bordered">
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Name:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control"readonly id="username_e" value="<?php echo $record-> USERNAME; ?>" placeholder="Please Enter Username" name="username_e" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Password:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" value="<?php echo $record-> PASSWORD; ?>" id="password_e" placeholder="Please Enter Password" name="password_e" required>
</div>
</div>
<div class="form-group">
<label  class="col-sm-3 control-label" style="color:black;">User Type:<span id="star">*</span></label>
<div class="col-sm-5">
<select  class="form-control select2" data-allow-clear="true" name="usertype_e"  id="usertype_e" required="required">
<option value="">Please Select Type</option>
<?php
$user_type=$record->TYPE; 
if ($user_type=='0')
{
?>
<option value="0" Selected >ADMIN</option>
<?php
}
else
{
?>
<option value="0">ADMIN</option>
<?php
}
if ($user_type=='1')
{
?>

<option value="1" Selected >USER</option>
<?php
}
else
{
?>
<option value="1">USER</option>
<?php
}
?>
</select>
</div>
</div>
<div class="form-group">
<label  class="col-sm-3 control-label" style="color:black;">Voucher Edit:<span id="star">*</span></label>
<div class="col-sm-5">
<td>
<input type="checkbox"  name="voucher_edit_e" name="voucher_edit_e" <?php if($record->EDIT_VR=='YES'){ echo "checked";} ?>  value="YES" data-plugin="switcherya" data-color="#81c868" data-size="small"/>
</td>
</div>
</div>
<div class="form-group">
<label  class="col-sm-3 control-label" style="color:black;">Voucher Delete:<span id="star">*</span></label>
<div class="col-sm-5">
<td>
<input type="checkbox"  name="voucher_delete_e" name="voucher_delete_e" <?php if($record->DELETE_VR=='YES'){ echo "checked";} ?>  value="YES" data-plugin="switcherya" data-color="#81c868" data-size="small"/>
</td>
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
$(document).ready(function(){
$('[data-plugin="switcherya"]').each(function (idx, obj) {
new Switchery($(this)[0], $(this).data());
});		
});
$("#usertype_e").select2();
$(".select2-limiting").select2({
maximumSelectionLength: 2
});
</script>