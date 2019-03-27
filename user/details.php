<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
error_reporting(0);
include("../connection.php");
$username=$_POST['username'];
$detail=Run("SELECT * FROM LOGIN WHERE USERNAME='$username'");
$rec=mssql_fetch_object($detail);
$type=$rec->TYPE;
$d=$rec->EDIT_VR;
$e=$rec->DELETE_VR;
if($type=='0')
{
$c='ADMIN';
}
else
{
$c='USER';
}
?>
<table class="big-font-table table table-bordered table-stripped" >
<tr>
<th>Username</th>
<td><?php echo $rec->USERNAME;?></td>
</tr>
<tr>
<th>Password</th>
<td><?php echo $rec->PASSWORD;?></td>
</tr>
<tr>
<th>Type</th>
<td>
<?php echo $c;?></td>
</tr>
<tr>
<th>Voucher Edit</th>
<td>
<?php echo $d;?></td>
</tr>
<tr>
<th>Voucher Delete</th>
<td>
<?php echo $e;?></td>
</tr>
</table>