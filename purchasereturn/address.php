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
$detail=Run("SELECT * FROM PARTY WHERE PARTYCODE='$code'");
$record=mssql_fetch_object($detail);
echo $address=$record-> ADDRESS;
?>