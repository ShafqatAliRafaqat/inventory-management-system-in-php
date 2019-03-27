<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
Include('../connection.php');
$bankcode=$_POST['bankcode'];
$bankname=$_POST['bankname'];
$status=$_POST['status'];
if($status=='SAVE')
{
$query=Run("SELECT * FROM BANK WHERE BANKNAME = '$bankname'");
if (mssql_num_rows($query)>0)
{
echo 'FALSE';
}
else
{
$query_max = Run("select max(BANKCODE) AS CODE from BANK");
$x = mssql_fetch_object($query_max);
$id = $x->CODE+1;
$query_save= Run("INSERT INTO BANK (BANKCODE,BANKNAME) VALUES ('$bankcode','$bankname')");
}
}
else
{
$query_check=Run("SELECT * FROM BANK WHERE BANKNAME = '$bankname' AND BANKCODE <> '$bankcode'");
if (mssql_num_rows($query_check)>0)
{
echo 'FALSE';
}
else
{
$query= Run("UPDATE BANK SET BANKNAME= '$bankname' WHERE BANKCODE = '$bankcode' ");
}
}
?>