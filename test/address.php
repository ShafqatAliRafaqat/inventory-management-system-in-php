<?php
Include('../connection.php');
$code=$_POST['code'];
$query=Run("SELECT * FROM PARTY WHERE PARTYCODE='$code'");
$query_fetch= mssql_fetch_object($query);
echo $query_fetch->ADDRESS;
?>