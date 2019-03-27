<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
Include('../connection.php');
$username=$_POST['username'];
$password=$_POST['password'];
$voucher_edit=$_POST['voucher_edit'];
$voucher_delete=$_POST['voucher_delete'];
if($voucher_edit=='')
{
$voucher_edit='NO';	
}
if($voucher_delete=='')
{
$voucher_delete='NO';	
}
$type=$_POST['type'];
$status=$_POST['status'];
if($status=='SAVE')
{
$query=Run("SELECT * FROM LOGIN WHERE USERNAME = '$username'");
if (mssql_num_rows($query)>0)
{
echo 'FALSE';
}
else
{
$query_save= Run("INSERT INTO LOGIN (USERNAME,PASSWORD,TYPE,EDIT_VR,DELETE_VR) VALUES ('$username','$password','$type','$voucher_edit','$voucher_delete')");
}
}
else
{
$query= Run("UPDATE LOGIN SET PASSWORD= '$password' , TYPE= '$type', EDIT_VR= '$voucher_edit', DELETE_VR= '$voucher_delete' WHERE USERNAME = '$username' ");
}
?>