<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
Include('../connection.php');
if(isset($_POST['submit']))
{
$query_max = Run("SELECT MAX(VOUCHER_NO) AS NO from RECEIPT");
$x = mssql_fetch_object($query_max);
$voucher_no = $x->NO+1;
$voucher_type='NEW';
}
else
{
$voucher_no=$_POST['voucher_no'];	
$voucher_type='EDIT';
}
$DELETE_TABLE1=Run("DELETE RECEIPT WHERE VOUCHER_NO='$voucher_no'");
$DELETE_TABLE4=Run("DELETE LEDGER WHERE VOUCHER_NO='$voucher_no' AND VOUCHERTYPE='RV'");
//LOG BUILD
$entrytime=date("Y-m-d H:i:s");
$insertion_log=Run("INSERT INTO LOG(VOUCHER_NO,VOUCHER,ENTERY_TIME,ENTERY_BY,ENTERY_TYPE) VALUES ('$voucher_no','RV','$entrytime','$U_ID','$voucher_type')");
$voucher_date=$_POST['voucher_date'];
$date=explode("/",$voucher_date);
$day=$date[0];
$month=$date[1];
$year=$date[2];
$date_format= $year."-".$month."-".$day;
$account_code=$_POST['account_code'];
$query=Run("SELECT * FROM ACCOUNT WHERE ACCOUNTCODE='$account_code'");
$query_fetch=mssql_fetch_object($query);
$account_name=$query_fetch->ACCOUNTNAME;
$totalamount=$_POST['totalamount'];
//SECOND TABLE //
$row_number=$_POST['row_number'];
$end_number=$row_number-1;
$start=1;
while($start<=$end_number)
{
$party_code=$_POST['code'.$start];
$party_name=$_POST['party_name'.$start];
$description=$_POST['description'.$start];
$amount=$_POST['amount'.$start];
if($party_code!='' && $party_code!=0 && $amount!='' && $amount!=0)
{
$query2_save=Run("INSERT INTO RECEIPT
(VOUCHER_NO,VOUCHER_DATE,ACCOUNT_CODE,ACCOUNT_NAME,PARTY_CODE,PARTY_NAME,DESCR,AMOUNT,USERNAME) VALUES ('$voucher_no','$date_format','$account_code','$account_name','$party_code','$party_name','$description','$amount','$U_ID')");
//Party Ledger Credit
$query_party=Run("INSERT INTO LEDGER
(VOUCHER_NO,VOUCHER_DATE,ACCOUNTCODE,ACCOUNTNAME,DEBIT,CREDIT,DESCRIPTION,SACCOUNTACODE,SACCOUNTNAME,VOUCHERTYPE,USERNAME) VALUES ('$voucher_no','$date_format','$party_code','$party_name','0','$amount','$description','$account_code','$account_name','RV','$U_ID')");
//Account Ledger Debit
$query_account=Run("INSERT INTO LEDGER
(VOUCHER_NO,VOUCHER_DATE,ACCOUNTCODE,ACCOUNTNAME,DEBIT,CREDIT,DESCRIPTION,SACCOUNTACODE,SACCOUNTNAME,VOUCHERTYPE,USERNAME) VALUES ('$voucher_no','$date_format','$account_code','$account_name','$amount','0','$description','$party_code','$party_name','RV','$U_ID')");
}
$start++;
}
printf('<script>location.href="../receipt.php?popup=yes"</script>');
?>