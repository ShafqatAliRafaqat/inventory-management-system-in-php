<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
$rpt='purchase_voucher';
$filename=$rpt.".pdf";
$my_report = "F:\\xampp\\htdocs\\php\\MEGA2018\\reports\\rpt\\".$rpt.".rpt"; 
$myfile = "F:\\xampp\\htdocs\\php\\MEGA2018\\reports\\files\\".$filename;
$FormatType=31;	
$ObjectFactory= new COM("CrystalReports.ObjectFactory.2");
$crapp = $ObjectFactory->CreateObject("CrystalRunTime.Application.9");
$creport = $crapp->OpenReport($my_report, 1);
$creport->Database->Tables(1)->SetLogOnInfo("DESKTOP-8G77LAP\SQLEXPRESS", "MEGA2018", "sa", "aaa123*");
$creport->FormulaSyntax=0; 
$creport->RecordSelectionFormula="{PURCH1.VOUCHER_NO}=".$_POST['voucher_no']."";
$creport->EnableParameterPrompting = 0;
$creport->DiscardSavedData;
$creport->ReadRecords();
$creport->ExportOptions->DiskFileName=$myfile;
$creport->ExportOptions->FormatType=$FormatType;
$creport->ExportOptions->DestinationType=1;
$creport->Export(false);
$creport = null;
$crapp = null;
$ObjectFactory = null;
$forvd="reports/files/".$filename;
print "<embed src=\"".$forvd."\" width=\"100%\" height=\"800px\">"
?>
