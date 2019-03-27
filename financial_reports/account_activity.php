<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
error_reporting(0);
include("../connection.php");
$refresh_table=Run("DELETE FROM ACCOUNT_ACTIVITY");
$account_code = $_POST['account_code'];
$query=Run("SELECT * FROM ACCOUNT WHERE ACCOUNTCODE='$account_code'");
if(mssql_num_rows($query)==0)
{
$query=Run("SELECT (PARTYNAME) AS ACCOUNTNAME FROM PARTY WHERE PARTYCODE='$account_code'");		
}
$query_fetch=mssql_fetch_object($query);
$account_name=$query_fetch->ACCOUNTNAME;

$daterange = $_POST['daterange'];

$array = explode('-',$daterange);
$startingdate=	$array[0];
$endingdate= $array[1];
$start_date=explode("/",$startingdate);

$start_day=$start_date[0];
$start_month=$start_date[1];
$start_year=$start_date[2];
$starting_date=$start_year."-".$start_month."-".$start_day;

$end_date=explode("/",$endingdate);
$end_day=$end_date[0];
$end_month=$end_date[1];
$end_year=$end_date[2];
$ending_date=$end_year."-".$end_month."-".$end_day;
$balance=0;
$OPENING_BALANCE=0;
$sr=1;

$opening_query = Run("SELECT SUM(DEBIT-CREDIT) AS OPENING_BALANCE FROM LEDGER WHERE  ACCOUNTCODE = '$account_code' AND VOUCHER_DATE < '$starting_date' ");
$record_opening= mssql_fetch_object($opening_query);
$OPENING_BALANCE = $record_opening -> OPENING_BALANCE ;

$insertion_opening = Run("INSERT INTO ACCOUNT_ACTIVITY (SERIALNO,VOUCHER_NO,VOUCHER_DATE,DEBIT,CREDIT,BALANCE,DESCRIPTION,VOUCHERTYPE,USERNAME,SDATE,EDATE,USER_REPORT,ACCOUNTCODE,ACCOUNTNAME) values('$sr','0','','','','$OPENING_BALANCE','OPENING BALANCE','OP','','$starting_date','$ending_date','$U_ID','$account_code','$account_name')");

$balance=$balance+$OPENING_BALANCE;
$sr=2;
$legder_query = Run("SELECT * FROM LEDGER WHERE  ACCOUNTCODE = '$account_code' AND VOUCHER_DATE >='$starting_date' AND VOUCHER_DATE <='$ending_date' ORDER BY VOUCHER_DATE ASC");
while($record= mssql_fetch_object($legder_query))
{
$VOUCHER_NO = $record -> VOUCHER_NO ;
$VOUCHER_DATE = $record -> VOUCHER_DATE ;
$DEBIT = $record -> DEBIT ;
$CREDIT = $record -> CREDIT ;
$DESCRIPTION = $record -> DESCRIPTION ;
$VOUCHERTYPE = $record -> VOUCHERTYPE ;
$USERNAME = $record -> USERNAME ;
$balance=$balance+$DEBIT;
$balance=$balance-$CREDIT;
$insertion = Run("INSERT INTO ACCOUNT_ACTIVITY (SERIALNO,VOUCHER_NO,VOUCHER_DATE,DEBIT,CREDIT,BALANCE,DESCRIPTION,VOUCHERTYPE,USERNAME,SDATE,EDATE,USER_REPORT,ACCOUNTCODE,ACCOUNTNAME) values('$sr','$VOUCHER_NO','$VOUCHER_DATE','$DEBIT','$CREDIT','$balance','$DESCRIPTION','$VOUCHERTYPE','$USERNAME','$starting_date','$ending_date','$U_ID','$account_code','$account_name')");
$sr=$sr+1;
}
?>

<button type="button" id="print"  style="margin-top:-25px" class="btn btn-danger waves-effect waves-light"><i class="fa fa-print"></i></button>
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
<th>Sr.No</th>
<th>Vr. No</th>
<th>Vr. Date</th>
<th>Vr. Type</th>
<th>Description</th>
<th>Debit</th>
<th>Credit</th>
<th>Balance</th>    
<th>Posted By</th>    
</tr>
</thead>
<tbody>
<?php
$total_debit=0;
$total_credit=0;
$view_query = Run("SELECT * FROM ACCOUNT_ACTIVITY ORDER BY SERIALNO ASC");
while($result = mssql_fetch_object($view_query))
{
$SERIALNO = $result -> SERIALNO ;
$VOUCHER_NO = $result -> VOUCHER_NO ;
$VOUCHER_DATE_FORMAT = $result -> VOUCHER_DATE ;
$VOUCHER_DATE=date("d/m/Y",strtotime($VOUCHER_DATE_FORMAT));
if($VOUCHER_DATE=='31/12/1969')
{
$VOUCHER_DATE='';	
}
$DEBIT = $result -> DEBIT ;
$CREDIT = $result -> CREDIT ;
$BALANCE = $result -> BALANCE ;
$DESCRIPTION = $result -> DESCRIPTION ;
$VOUCHERTYPE = $result -> VOUCHERTYPE ;
$USERNAME = $result -> USERNAME ;
$total_debit=$total_debit+$DEBIT;
$total_credit=$total_credit+$CREDIT;
?>
<tr>
<td><?php echo $SERIALNO;?></td>
<td><?php echo $VOUCHER_NO; ?></td>
<td><?php echo $VOUCHER_DATE; ?></td>
<td><?php echo $VOUCHERTYPE; ?></td>
<td><?php echo $DESCRIPTION; ?></td>
<td style="text-align:right"><?php echo $DEBIT; ?></td>
<td style="text-align:right"><?php echo $CREDIT; ?></td>
<td style="text-align:right"><?php echo $BALANCE; ?></td>
<td><?php echo $USERNAME; ?></td>
</tr>
<?php
}
?>
</tbody>
<tfoot>
<tr>
<td colspan="5" style="text-align:right;color:white;background-color:#5fbeaa;">Total:</td>
<td style="text-align:right;color:white;background-color:#5fbeaa"><?php echo $total_debit; ?></td>
<td style="text-align:right;color:white;background-color:#5fbeaa"><?php echo $total_credit; ?></td>
<td style="text-align:right;color:white;background-color:#5fbeaa"><?php echo $BALANCE; ?></td>
<td style="text-align:right;color:white;background-color:#5fbeaa"></td>
</tr>
<tr>
<td colspan="9" style="text-align:center;color:white;background-color:#36404a;"> Closing Balance (Rs) : <?php echo $BALANCE; ?></td>
</tr>
</tfoot>
</table>
<script type="text/javascript">
jQuery(document).ready(function($)
{
$("#example").dataTable();
});
$("#print").click(function(){
$('#print_modal').modal('show');
$.post("financial_reports/account_activity_print.php",{
},function(data){
$('#print_body').html(data);
});	 
});
</script>