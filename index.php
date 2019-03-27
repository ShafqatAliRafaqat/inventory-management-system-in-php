<?php
session_start();
if($_SESSION['mega2018'])
{
printf('<script>location.href="home.php"</script>');	
}
?>
<html>
<head>
<title>Welcome | MEGA</title>
<!-- ================== BEGIN CSS STYLE ================== -->
<link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert.css"/>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/css/core.css" />
<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
<link href="assets/css/components.css" rel="stylesheet" type="text/css" />
<link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
<!-- ================== END CSS STYLE ================== -->
</head>
<body style="background-color:#ebeff2 !important">
<div class="wrapper-page">
<div class="card-box">
<div class="panel-heading"> 
<h3 class="text-center"> Welcome to <strong class="text-custom"> MEGA 2018</strong> </h3>
</div> 
<div class="panel-body">
<form class="form-horizontal m-t-20" action="login.php" method="post">
<div class="form-group ">
<div class="col-xs-12">
<input type="text" class="form-control" name="user_name" id="user_name"  required placeholder="Username">
</div>
</div>
<div class="form-group">
<div class="col-xs-12">
<input type="password" class="form-control" name="user_password" id="user_password"  required placeholder="Password">
</div>
</div> 
<div class="form-group text-center m-t-40">
<div class="col-xs-12">
<button class="btn btn-pink btn-block waves-effect waves-light" type="submit">LOG IN</button>
</div>
</div>
</form> 
</div>   
</div>                              
</div>
<div class="row">
<div class="col-sm-12 text-center">
<p style="color:black;">Design & Developed By<a href="#" class="text-primary m-l-5"><b>NABEEL & SHAFQAT </b></a></p>
</div>
</div>
<!-- ================== BEGIN JS ================== -->
<script src="assets/jquery-3.2.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/sweetalert/sweetalert.min.js"></script>
<script src="assets/waves/waves.min.js"></script>
<!-- ================== END JS ================== -->
<?php
$a=$_GET['id'];
if($a=='error')
{
?>
<script>
swal("Warning", "Invalid Username Or Password", "error");
</script>
<?php
}
?>  
</body>
</html>