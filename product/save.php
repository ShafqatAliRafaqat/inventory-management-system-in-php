<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
Include('../connection.php');
$productcode=$_POST['productcode'];
$productname=$_POST['productname'];
$unit=$_POST['unit'];
$salerate=$_POST['salerate'];
$purchaserate=$_POST['purchaserate'];
$status=$_POST['status'];
if($status=='SAVE')
{
$query=Run("SELECT * FROM PRODUCT WHERE PRODUCTNAME = '$productname'");
if (mssql_num_rows($query)>0)
{
echo 'FALSE';
}
else
{
$query_max = Run("select max(PRODUCTCODE) AS CODE from PRODUCT");
$x = mssql_fetch_object($query_max);
$id = $x->CODE+1;

$query_save= Run("INSERT INTO PRODUCT (PRODUCTCODE,PRODUCTNAME,UNIT,SALERATE,PURCHASERATE) VALUES ('$productcode','$productname','$unit','$salerate','$purchaserate')");
}
}
else
{
$query_check=Run("SELECT * FROM PRODUCT WHERE PRODUCTNAME = '$productname' AND PRODUCTCODE <> '$productcode'");
if (mssql_num_rows($query_check)>0)
{
echo 'FALSE';
}
else
{
$query= Run("UPDATE PRODUCT SET PRODUCTNAME= '$productname',UNIT= '$unit',SALERATE= '$salerate',PURCHASERATE= '$purchaserate' WHERE PRODUCTCODE = '$productcode' ");
}
}
?>