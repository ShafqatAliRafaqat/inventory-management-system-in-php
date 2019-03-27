<?php 
session_start();
$U_ID=$_SESSION['username'];
$U_TYPE=$_SESSION['type'];
if(!$_SESSION['mega2018'])
{         
printf("<script>location.href='index.php'</script>");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome | MEGA 2018</title>
</head>
<body>
<!-- menu Bar-->
<?php 
include("header.php");
?>
<!-- End menu Bar-->
<div class="wrapper">
<div class="container">
<!-- Page-Title -->
<div class="row">
<div class="col-sm-12">
<h4 class="page-title">Dashboard</h4>
<p class="text-muted page-title-alt">Welcome <?php echo $U_ID;?> !</p>
</div>
</div>
<!-- end row -->
<!-- Footer -->
<footer class="footer text-right">
<div class="container">
<div class="row">
<div class="col-xs-6">
Lahore Garrison University @ 2018. All rights reserved.
</div>
</div>
</div>
</footer>
<!-- End Footer -->
</div>
</div>
</body>
</html>