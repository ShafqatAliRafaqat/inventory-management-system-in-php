<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
include("../connection.php");
$bankcode=$_POST['bankcode'];
$del=Run("DELETE FROM BANK WHERE BANKCODE='$bankcode'");
?>