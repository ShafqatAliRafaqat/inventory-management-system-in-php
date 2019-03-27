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
$query_max = Run("SELECT MAX(VOUCHER_NO) AS NO from SRET1");
$x = mssql_fetch_object($query_max);
$voucher_no = $x->NO+1;
$voucher_type='NEW';
}
else
{
$voucher_no=$_POST['voucher_no'];	
$voucher_type='EDIT';
}
$DELETE_TABLE1=Run("DELETE SRET1 WHERE VOUCHER_NO='$voucher_no'");
$DELETE_TABLE2=Run("DELETE SRET2 WHERE VOUCHER_NO='$voucher_no'");
$DELETE_TABLE3=Run("DELETE STOCK WHERE VOUCHER_NO='$voucher_no' AND VOUCHERTYPE='SR'");
$DELETE_TABLE4=Run("DELETE LEDGER WHERE VOUCHER_NO='$voucher_no' AND VOUCHERTYPE='SR'");
//LOG BUILD
$entrytime=date("Y-m-d H:i:s");
$insertion_log=Run("INSERT INTO LOG(VOUCHER_NO,VOUCHER,ENTERY_TIME,ENTERY_BY,ENTERY_TYPE) VALUES ('$voucher_no','SR','$entrytime','$U_ID','$voucher_type')");
$voucher_date=$_POST['voucher_date'];
$date=explode("/",$voucher_date);
$day=$date[0];
$month=$date[1];
$year=$date[2];
$date_format= $year."-".$month."-".$day;
$remarks=$_POST['remarks'];
$party_code=$_POST['party_code'];
$query=Run("SELECT * FROM PARTY WHERE PARTYCODE='$party_code'");
$query_fetch=mssql_fetch_object($query);
$address=$query_fetch->ADDRESS;
$partyname=$query_fetch->PARTYNAME;
$totalquantity=$_POST['totalquantity'];
$totalamount=$_POST['totalamount'];
$discount=$_POST['discount'];
$grandamount=$_POST['grandamount'];
$query_save=Run("INSERT INTO SRET1 (VOUCHER_NO,VOUCHER_DATE,REMARKS,PARTYCODE,PARTYNAME,PARTYADDRESS,TQTY,TAMOUNT,TDISCOUNT,GAMOUNT,USERNAME) VALUES ('$voucher_no','$date_format','$remarks','$party_code','$partyname','$address','$totalquantity','$totalamount','$discount','$grandamount','$U_ID')");
//SECOND TABLE //
$row_number=$_POST['row_number'];
$end_number=$row_number-1;
$start=1;
while($start<=$end_number)
{
$code=$_POST['code'.$start];
$product_name=$_POST['product_name'.$start];
$unit=$_POST['unit'.$start];
$quantity=$_POST['quantity'.$start];
$rate=$_POST['rate'.$start];
$amount=$_POST['amount'.$start];
if($code!='' && $code!=0)
{
$query2_save=Run("INSERT INTO SRET2
(PRODUCTCODE,PRODUCTNAME,UNIT,QUANTITY,RATE,AMOUNT,VOUCHER_NO,VOUCHER_DATE,USERNAME) VALUES ('$code','$product_name','$unit','$quantity','$rate','$amount','$voucher_no','$date_format','$U_ID')");
//Stock Ledger 
$query_stock=Run("INSERT INTO STOCK
(VOUCHER_NO,VOUCHER_DATE,PRODUCTCODE,PRODUCTNAME,UNIT,INQTY,OUTQTY,INAMOUNT,OUTAMOUNT,PARTYCODE,PARTYNAME,VOUCHERTYPE,USERNAME) VALUES ('$voucher_no','$date_format','$code','$product_name','$unit','$quantity','0','$amount','0','$party_code','$partyname','SR','$U_ID')");
$DESCRIPTION=$quantity.' Qty '.$product_name.' @ '.$rate;
//Party Ledger Credit
$account_code=7;
$account_name='Sales Return Account';
$query_party=Run("INSERT INTO LEDGER
(VOUCHER_NO,VOUCHER_DATE,ACCOUNTCODE,ACCOUNTNAME,DEBIT,CREDIT,DESCRIPTION,SACCOUNTACODE,SACCOUNTNAME,VOUCHERTYPE,USERNAME) VALUES ('$voucher_no','$date_format','$party_code','$partyname','0','$amount','$DESCRIPTION','$account_code','$account_name','SR','$U_ID')");
//Account Ledger Debit
$query_account=Run("INSERT INTO LEDGER
(VOUCHER_NO,VOUCHER_DATE,ACCOUNTCODE,ACCOUNTNAME,DEBIT,CREDIT,DESCRIPTION,SACCOUNTACODE,SACCOUNTNAME,VOUCHERTYPE,USERNAME) VALUES ('$voucher_no','$date_format','$account_code','$account_name','$amount','0','$DESCRIPTION','$party_code','$partyname','SR','$U_ID')");
}
$start++;
}
if($discount!='' && $discount!=0 )
{
//Discount Portion
//Party Ledger Debit
$discount_account_code=4;
$discount_account_name='Discount Head';
$DISCOUNT_DESCRIPTION='Discount On'. $totalquantity.' Qty ';
$query_party=Run("INSERT INTO LEDGER
(VOUCHER_NO,VOUCHER_DATE,ACCOUNTCODE,ACCOUNTNAME,DEBIT,CREDIT,DESCRIPTION,SACCOUNTACODE,SACCOUNTNAME,VOUCHERTYPE,USERNAME) VALUES ('$voucher_no','$date_format','$party_code','$partyname','$discount','0','$DISCOUNT_DESCRIPTION','$discount_account_code','$discount_account_name','SR','$U_ID')");
//Discount Account Ledger Credit
$query_account=Run("INSERT INTO LEDGER
(VOUCHER_NO,VOUCHER_DATE,ACCOUNTCODE,ACCOUNTNAME,DEBIT,CREDIT,DESCRIPTION,SACCOUNTACODE,SACCOUNTNAME,VOUCHERTYPE,USERNAME) VALUES ('$voucher_no','$date_format','$discount_account_code','$discount_account_name','0','$discount','$DISCOUNT_DESCRIPTION','$party_code','$partyname','SR','$U_ID')");
}
printf('<script>location.href="../salereturn.php?popup=yes"</script>');
?>