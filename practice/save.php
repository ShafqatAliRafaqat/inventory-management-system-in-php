<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
Include('../connection.php');
$voucher_no=$_POST['voucher_no'];
$voucher_date=$_POST['voucher_date'];
$date=explode("/",$voucher_date);
$day=$date[0];
$month=$date[1];
$year=$date[2];
$date_format= $year."-".$month."-".$day;
$remarks=$_POST['remarks'];
$party_code=$_POST['partycode'];
$query=Run("SELECT * FROM PARTY WHERE PARTYCODE='$party_code'");
$query_fetch=mssql_fetch_object($query);
$address=$query_fetch->ADDRESS;
$partyname=$query_fetch->PARTYNAME;
$totalquantity=$_POST['totalquantity'];
$totalamount=$_POST['totalamount'];
$discount=$_POST['discount'];
$grandamount=$_POST['grandamount'];
$query_save=Run("INSERT INTO PURCH1 (VOUCHER_NO,VOUCHER_DATE,REMARKS,PARTYCODE,PARTYNAME,PARTYADDRESS,TQTY,TAMOUNT,TDISCOUNT,GAMOUNT) VALUES ('$voucher_no','$date_format','$remarks','$party_code','$partyname','$address','$totalquantity','$totalamount','$discount','$grandamount')");

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

$query2_save=Run("INSERT INTO PURCH2
(PRODUCTCODE,PRODUCTNAME,UNIT,QUANTITY,RATE,AMOUNT,VOUCHER_NO,VOUCHER_DATE) VALUES ('$code','$product_name','$unit','$quantity','$rate','$amount','$voucher_no','$date_format')");
$start++;
}
printf('<script>location.href="../purchase.php"</script>');
?>