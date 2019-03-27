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
$accountcode=$_POST['accountcode'];
$detail=Run("SELECT * FROM ACCOUNT WHERE ACCOUNTCODE='$accountcode'");
$rec=mssql_fetch_object($detail);
?>
<table class="big-font-table table table-bordered table-stripped" >
<tr>
<th>Account Code</th>
<td><?php echo $rec->ACCOUNTCODE;?></td>
</tr>
<tr>
<th>Account Name</th>
<td><?php echo $rec->ACCOUNTNAME;?></td>
</tr>
<tr>
<th>Account Type</th>
<td><?php echo $rec->ATYPE_NAME;?></td>
</tr>
</table>