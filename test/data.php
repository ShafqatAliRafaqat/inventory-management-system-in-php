<?php
Include('../connection.php');
$code=$_POST['code'];
$query=Run("SELECT * FROM PRODUCT WHERE PRODUCTCODE='$code'");
$query_fetch= mssql_fetch_object($query);
$a=$query_fetch-> UNIT;
$b=$query_fetch-> PURCHASERATE;

echo json_encode(array("unit"=>$a ,"purchaserate"=>$b));
?>