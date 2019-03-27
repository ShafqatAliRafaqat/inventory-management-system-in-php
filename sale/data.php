<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
include("../connection.php");
$code=$_POST['code'];
$detail=Run("SELECT * FROM PRODUCT WHERE PRODUCTCODE='$code'");
$record=mssql_fetch_object($detail);
$unit=$record-> UNIT;
$purchaserate=$record-> SALERATE;
echo json_encode(array("unit"=>$unit ,"purchaserate"=>$purchaserate));
?>