<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
include("../connection.php");
$accountcode=$_POST['accountcode'];
$check=Run("SELECT * FROM LEDGER WHERE ACCOUNTCODE='$accountcode'");
$counter=mssql_num_rows($check);
if($counter==0)
{
$del=Run("DELETE FROM ACCOUNT WHERE ACCOUNTCODE='$accountcode'");
}
?>