<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
include("../connection.php");
$voucher_no=$_POST['voucher_no'];
$detail=Run("SELECT * FROM PAYMENT WHERE VOUCHER_NO='$voucher_no'");
$record=mssql_fetch_object($detail);
$check_records=mssql_num_rows($detail);
$date_format=$record->VOUCHER_DATE;
if($date_format=='')
{
$date_voucher=date("d/m/Y");	
}
else
{
$date_voucher=date("d/m/Y",strtotime($date_format));
}
$rights_validation=Run("SELECT * FROM LOGIN WHERE USERNAME='$U_ID'");
$fetch_rights = mssql_fetch_object($rights_validation);
?>
<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Voucher Date:<span id="star">*</span></label>
<div class="col-sm-2">
<input type="text" class="form-control" value="<?php echo $date_voucher?>" id="voucher_date"  name="voucher_date" required="required">
</div>
<?php if ($check_records==0)
{
?>
<div class="col-sm-2">
<button type="submit" id="submit" name="submit" class="btn btn-success waves-effect waves-light"><i class="fa fa-check"></i> Save</button>
<a href="home.php"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-remove"></i> Cancel</button></a>
</div>
<?php
}
else if($fetch_rights->EDIT_VR=='YES' || $U_TYPE==0)
{
?>
<div class="col-sm-2">
<button type="submit" id="update" name="update" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-check"></i> Update</button>
<a href="home.php"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="fa fa-remove"></i> Cancel</button></a>
</div>
<?php
}
if ($check_records>0)
{
?>
<div class="col-sm-5">
<label class="col-sm-4 control-label" style="color:black;">Posted By:</label>
<div class="col-sm-6">
<input type="text" readonly class="form-control" style="background-color:#36404a;border-left:5px solid #5fbeaa;color:white" value="<?php echo $record->USERNAME?>">
</div>
</div>
<?php
}
?>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Remarks:</label>
<div class="col-sm-5">
<input type="text" class="form-control" value="<?php echo $record->REMARKS?>" id="remarks" placeholder="Enter Remarks" name="remarks">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Credit Account Code:<span id="star">*</span></label>
<div class="col-sm-5">
<input type="text" class="form-control"  id="account_code" readonly  value="<?php echo $record->ACCOUNT_CODE?>" placeholder="Enter Account Code"name="account_code" required="required">
<span id="account_code_error"> </span>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" style="color:black;">Credit Account Name:<span id="star">*</span></label>
<div class="col-sm-5">
<select class="form-control select2" data-allow-clear="true" name="account_name"  id="account_name" onchange="document.getElementById('account_code').value=this.value;">
<option value="">Please Select Account</option>
<?php
$query_account=Run("SELECT * FROM ACCOUNT WHERE ATYPE IN ('0','1')");
while($fetch_account=mssql_fetch_object($query_account))
{
$a=$fetch_account->ACCOUNTCODE;
$b=$fetch_account->ACCOUNTNAME;
if($record->ACCOUNT_CODE==$a)
{
?>
<option value="<?php echo $a ?>" selected><?php echo $b?></option>
<?php 
}
else
{
?>
<option value="<?php echo $a ?>"><?php echo $b?></option>
<?php 
}
}
?>
</select>
</div>
</div>
<table class="table table-bordered table-stripped" >
<tr>
<th style="width:10%;" id="custom-table-head">Party Code</th>
<th style="width:30%" id="custom-table-head">Party Name</th>
<th style="width:30%" id="custom-table-head">Description</th>
<th style="width:20%" id="custom-table-head">Amount</th>
<th id="custom-table-head">Actions</th>
</tr>
<tr>
<td>
<input type="text" class="form-control" id="code_s"  name="code_s" placeholder="Code" readonly>
<span id="code_s_error"></span>
</td>
<td>
<select  class="form-control select2" data-allow-clear="true" name="party_name_s"  id="party_name_s" onchange="document.getElementById('code_s').value=this.value;">
<option value="">Please Select Party</option>
<?php
$query_party=Run("SELECT * FROM PARTY WHERE PARTYTYPE='Supplier' ORDER BY PARTYNAME ASC");
while($fetch_party=mssql_fetch_object($query_party))
{
$a=$fetch_party->PARTYCODE;
$b=$fetch_party->PARTYNAME;
?>
<option value="<?php echo $a ?>"><?php echo $b?></option>
<?php 
}
?>
</select>
</td>
<td>
<input type="text" class="form-control" id="description_s"  name="description_s" placeholder="Description">
</td>
<td>
<input type="text" class="form-control" id="amount_s"  name="amount_s" placeholder="(Rs.)">
<span id="amount_s_error"></span>
</td>
<td>
<button type="button" class="typcn typcn-plus btn btn-block btn-default waves-effect waves-light" onClick="generate_row()"> Add Row</button>
</td>
</tr>
<input type="hidden" class="form-control" id="row_number"  name="row_number" value="1"readonly>
</table>
<div id="show_tables">
<?php 
$counter=1;
$detail2=Run("SELECT * FROM PAYMENT WHERE VOUCHER_NO='$voucher_no'");
while($record2=mssql_fetch_object($detail2))
{
?>
<div id="row<?php echo $counter;?>">
<table class="big-font-table table table-bordered table-stripped" >
<tr>
<td style="width:10%">
<input type="text" class="form-control" id="code<?php echo $counter;?>"  name="code<?php echo $counter;?>" placeholder="Code" value="<?php echo $record2->PARTY_CODE?>"readonly>
</td>
<td style="width:30%">
<input type="text" class="form-control" id="party_name<?php echo $counter;?>"  name="party_name<?php echo $counter;?>" placeholder="Name" value="<?php echo $record2->PARTY_NAME?>"readonly>
</td>
<td style="width:30%">
<input type="text" class="form-control" id="description<?php echo $counter;?>"  name="description<?php echo $counter;?>" placeholder="Unit" value="<?php echo $record2->DESCR?>" readonly>
</td>
<td style="width:20%">
<input type="text" class="form-control amount" id="amount<?php echo $counter;?>"  name="amount<?php echo $counter;?>" placeholder="(Rs.)" value="<?php echo $record2->AMOUNT?>" readonly>
</td>
<td>
<button type="button" class="btn btn-icon waves-effect waves-light btn-warning" onClick="edit_row(<?php echo $counter?>)"> <i class="typcn typcn-pencil"></i> </button> <button type="button" class="btn btn-icon waves-effect waves-light btn-danger" onClick="delete_row(<?php echo $counter?>)"> <i class="fa fa-remove"></i></button>
</td>
</tr>
</table>
</div>
<?php
$counter++;
}
?>
<input type="hidden" class="form-control" id="row_number"  name="row_number" value="<?php echo $counter;?>"readonly>
</div>
<table class="table table-condensed table-bordered table-hover table-striped" >
<tr>
<th style="width:70%;text-align:right">Total Amount:</th>
<th style="width:20%"><input type="text" class="form-control" id="totalamount"  name="totalamount" value="0" readonly></th>
<th></th>
</tr>
</table>
<script>
$("#account_name").select2();
$("#party_name_s").select2();
</script>