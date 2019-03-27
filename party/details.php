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
$partycode=$_POST['partycode'];
$detail=Run("SELECT * FROM PARTY WHERE PARTYCODE='$partycode'");
$rec=mssql_fetch_object($detail);
?>
<table class="big-font-table table table-bordered table-stripped" >
<tr>
<th>Party Code</th>
<td><?php echo $rec->PARTYCODE;?></td>
</tr>
<tr>
<th>Party Name</th>
<td><?php echo $rec->PARTYNAME;?></td>
</tr>
<tr>
<th>Party Type</th>
<td><?php echo $rec->PARTYTYPE;?></td>
</tr>
<tr>
<th>Party Address</th>
<td><?php echo $rec->ADDRESS;?></td>
</tr>
<tr>
<th>Mobile</th>
<td><?php echo $rec->MOBILE;?></td>
</tr>
<tr>
<th>Telephone</th>
<td><?php echo $rec->TELEPHONE;?></td>
</tr>
</table>