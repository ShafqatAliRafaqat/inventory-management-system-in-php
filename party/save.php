<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
Include('../connection.php');
$partycode=$_POST['partycode'];
$partyname=$_POST['partyname'];
$partytype=$_POST['partytype'];
$address=$_POST['address'];
$mobile=$_POST['mobile'];
$telephone=$_POST['telephone'];
$status=$_POST['status'];
if($status=='SAVE')
{
$query=Run("SELECT * FROM PARTY WHERE PARTYNAME = '$partyname'");
if (mssql_num_rows($query)>0)
{
echo 'FALSE';
}
else
{
$query_max = Run("select max(PARTYCODE) AS CODE from PARTY");
$x = mssql_fetch_object($query_max);
$id = $x->CODE;
if($id=='')
{
$id=5000;	
}
else
{
$id=$id+1;	
}
$query_save= Run("INSERT INTO PARTY (PARTYCODE,PARTYNAME,PARTYTYPE,ADDRESS,MOBILE,TELEPHONE) VALUES ('$partycode','$partyname','$partytype','$address','$mobile','$telephone')");
}
}
else
{
$query_check=Run("SELECT * FROM PARTY WHERE PARTYNAME = '$partyname' AND PARTYCODE <> '$partycode'");
if (mssql_num_rows($query_check)>0)
{
echo 'FALSE';
}
else
{
$query= Run("UPDATE PARTY SET PARTYNAME= '$partyname',PARTYTYPE='$partytype',ADDRESS= '$address',MOBILE= '$mobile',TELEPHONE= '$telephone' WHERE PARTYCODE = '$partycode' ");
}
}
?>