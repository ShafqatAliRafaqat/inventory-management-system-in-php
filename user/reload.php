<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
?>
<div class="row" id="loading_bar">
</div>
<form role="form" id="form1" action="javascript:save_data();" method="post" class="validate form-horizontal form-groups-bordered">
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Name:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="username" placeholder="Please Enter Username" name="username" required>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label" style="color:black;">Password:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control" id="password" placeholder="Please Enter Password" name="password" required>
</div>
</div>
<div class="form-group">
<label  class="col-sm-3 control-label" style="color:black;">User Type:<span id="star">*</span></label>
<div class="col-sm-5">
<select  class="form-control select2" data-allow-clear="true" name="usertype"  id="usertype" required="required">
<option value="">Please Select Type</option>
<option value="0">ADMIN</option>
<option value="1">USER</option>
</select>
</div>
</div>
<div class="form-group">
<label  class="col-sm-3 control-label" style="color:black;">Voucher Edit:<span id="star">*</span></label>
<div class="col-sm-5">
<td>
<input type="checkbox"  name="voucher_edit" name="voucher_edit" value="YES" data-plugin="switchery" data-color="#81c868" data-size="small"/>
</td>
</div>
</div>
<div class="form-group">
<label  class="col-sm-3 control-label" style="color:black;">Voucher Delete:<span id="star">*</span></label>
<div class="col-sm-5">
<td>
<input type="checkbox"  name="voucher_delete" name="voucher_delete" value="YES" data-plugin="switchery" data-color="#81c868" data-size="small"/>
</td>
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
$('[data-plugin="switchery"]').each(function (idx, obj) {
new Switchery($(this)[0], $(this).data());
});		
$("#usertype").select2();
$(".select2-limiting").select2({
maximumSelectionLength: 2
});
</script>