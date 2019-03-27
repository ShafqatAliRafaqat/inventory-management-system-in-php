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
$bankcode=$_POST['bankcode'];
$detail=Run("SELECT * FROM BANK WHERE BANKCODE='$bankcode'");
$rec=mssql_fetch_object($detail);
?>
<table class="big-font-table table table-bordered table-stripped" >
<tr>
<th>Bank Code</th>
<td><?php echo $rec->BANKCODE;?></td>
</tr>
<tr>
<th>Bank Name</th>
<td><?php echo $rec->BANKNAME;?></td>
</tr>
</table>