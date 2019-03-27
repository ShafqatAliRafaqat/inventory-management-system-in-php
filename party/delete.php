<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
include("../connection.php");
$partycode=$_POST['partycode'];
$del=Run("DELETE FROM PARTY WHERE PARTYCODE='$partycode'");
?>