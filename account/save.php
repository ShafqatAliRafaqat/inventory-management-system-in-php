<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
Include('../connection.php');
$accountcode=$_POST['accountcode'];
$accountname=$_POST['accountname'];
$accounttype=$_POST['accounttype'];
$status=$_POST['status'];
$query_account = Run("SELECT * FROM ACCOUNT_TYPE WHERE ATYPE='$accounttype'");
$fetch_type = mssql_fetch_object($query_account);
$type_name =$fetch_type->ATYPE_NAME;

if($status=='SAVE')
{
$query=Run("SELECT * FROM ACCOUNT WHERE ACCOUNTNAME ='$accountname'");
if (mssql_num_rows($query)>0)
{
echo 'FALSE';
}
else
{
$query_max = Run("select max(ACCOUNTCODE) AS CODE from ACCOUNT");
$x = mssql_fetch_object($query_max);
$id = $x->CODE+1;
$query_save= Run("INSERT INTO ACCOUNT (ACCOUNTCODE,ACCOUNTNAME,ATYPE_NAME,ATYPE) VALUES ('$accountcode','$accountname','$type_name','$accounttype')");
}
}
else
{
$query_check=Run("SELECT * FROM ACCOUNT WHERE ACCOUNTNAME = '$accountname'AND ACCOUNTCODE <> '$accountcode'");
if (mssql_num_rows($query_check)>0)
{
echo 'FALSE';
}
else
{
$query= Run("UPDATE ACCOUNT SET ACCOUNTNAME= '$accountname' ,ATYPE='$accounttype', ATYPE_NAME='$type_name' WHERE ACCOUNTCODE = '$accountcode' ");
}
}
?>