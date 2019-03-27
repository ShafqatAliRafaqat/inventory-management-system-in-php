<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
include("../connection.php");
$voucher_no=$_POST['voucher_no'];
$del1=Run("DELETE FROM PURCH1 WHERE VOUCHER_NO='$voucher_no'");
$del2=Run("DELETE FROM PURCH2 WHERE VOUCHER_NO='$voucher_no'");
?>