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
$DELETE_TABLE1=Run("DELETE RECEIPT WHERE VOUCHER_NO='$voucher_no'");
$DELETE_TABLE4=Run("DELETE LEDGER WHERE VOUCHER_NO='$voucher_no' AND VOUCHERTYPE='RV'");
$voucher_type='DELETE';
//LOG BUILD
$entrytime=date("Y-m-d H:i:s");
$insertion_log=Run("INSERT INTO LOG(VOUCHER_NO,VOUCHER,ENTERY_TIME,ENTERY_BY,ENTERY_TYPE) VALUES ('$voucher_no','RV','$entrytime','$U_ID','$voucher_type')");
?>