<?php
function Run($strSQL)
{
$conn = mssql_connect('DESKTOP-8G77LAP\SQLEXPRESS','sa','aaa123*');  
if (!$conn) {
die('MSSQL error: ' . mssql_get_last_message());
}
$db = mssql_select_db ("MEGA2018");
if(!$db)
die('MSSQL error: ' . mssql_get_last_message());
$res = mssql_query($strSQL) or die ($res = 'Invalid Query: ['.$strSQL.']<br> '. mssql_get_last_message());
return $res;
}
?>