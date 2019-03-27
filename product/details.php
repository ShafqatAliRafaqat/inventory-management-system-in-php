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
$productcode=$_POST['productcode'];
$detail=Run("SELECT * FROM PRODUCT WHERE PRODUCTCODE='$productcode'");
$rec=mssql_fetch_object($detail);
?>
<table class="big-font-table table table-bordered table-stripped" >
<tr>
<th>Product Code</th>
<td><?php echo $rec->PRODUCTCODE;?></td>
</tr>
<tr>
<th>Product Name</th>
<td><?php echo $rec->PRODUCTNAME;?></td>
</tr>
<tr>
<th>Product Unit</th>
<td><?php echo $rec->UNIT;?></td>
</tr>
<tr>
<th>Sale Rate</th>
<td><?php echo $rec->SALERATE;?></td>
</tr>
<tr>
<th>Purchase Rate</th>
<td><?php echo $rec->PURCHASERATE;?></td>
</tr>
</table>