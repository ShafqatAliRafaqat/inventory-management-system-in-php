<?php
include("connection.php");
?>
<!----css files--->
<link rel="stylesheet" href="assets/plugins/morris/morris.css">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/core.css" rel="stylesheet" type="text/css" />
<link href="assets/css/components.css" rel="stylesheet" type="text/css" />
<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
<link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
<link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
<!----css files--->
<header id="topnav">
<div class="topbar-main">
<div class="container">
<!-- Logo container-->
<div class="logo">
<a href="index.php" class="logo"><span>MEGA INVENTORY (2<i
class="md md-album"></i>18)</span></a>
</div>
<!-- End Logo container-->
<div class="menu-extras">
<ul class="nav navbar-nav navbar-right pull-right">
<li class="dropdown navbar-c-items">
<a href="#" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><i class="md md-account-circle" style="font-size:30px;"></i> </a>
<ul class="dropdown-menu">
<li><a href="logout.php"><i class="ti-power-off m-r-5"></i> Logout</a></li>
</ul>
</li>
</ul>
<div class="menu-item">
<!-- Mobile menu toggle-->
<a class="navbar-toggle">
<div class="lines">
<span></span>
<span></span>
<span></span>
</div>
</a>
<!-- End mobile menu toggle-->
</div>
</div>
</div>
</div>
<div class="navbar-custom">
<div class="container">
<div id="navigation">
<!-- Navigation Menu-->
<ul class="navigation-menu">
<li>
<a href="home.php"><i class="ti ti-home"></i>Home</a>
</li>
<?php
$menufont=array('<i class="md md-desktop-windows"></i>','<i class="md md-sort"></i>','<i class="ti ti-shopping-cart"></i></i>','<i class=" ti-thumb-up"></i>','<i class="ti  ti-shortcode"></i>','<i class=" icon icon-notebook"></i>');		
$m=0;	
if($U_TYPE==0)
{
$querya=Run("SELECT * FROM MENU WHERE LEVL='1' ORDER BY SORT ASC");
}
else
{
$querya=Run("SELECT * FROM MENU WHERE LEVL='1' AND  NO NOT IN ('1','4') ORDER BY SORT ASC");
}
while($row=mssql_fetch_object($querya))
{
?>
<li class="has-submenu">
<a href="#"><?php echo $menufont[$m];?><?php echo $row->NAME;?></a>
<?php
$queryb=Run("SELECT * FROM MENU WHERE LEVL='2' AND LEVEL1='".$row->NO."' ORDER BY SORT ASC"); 
if(mssql_num_rows($queryb)>0)
{
?>
<ul class="submenu">
<?php
$sr=1; 
while($rowa=mssql_fetch_object($queryb))
{
$queryc=Run("SELECT * FROM MENU WHERE LEVL='3' AND LEVEL2='".$rowa->NO."' ORDER BY SORT ASC"); 
$nrows=mssql_num_rows($queryc);	
?>
<li <?php if($nrows>0){ ?> class="has-submenu" <?php } ?>>
<a href="<?php echo $rowa->LINK;?>"><?php echo $sr." . ";?><?php echo $rowa->NAME;?></a>
<?php
if($nrows>0) 
{
?>
<ul class="submenu">
<?php
$srr=1; 
while($rowb=mssql_fetch_object($queryc))
{
?>
<li><a href="<?php echo $rowb->LINK;?>"><?php echo $srr." . ";?><?php echo $rowb->NAME;?></a></li>
<?php
$srr++; 
}
?>
</ul>
<?php 	
}
?>
</li>
<?php 
$sr++;
}
?>
</ul>
<?php 
}
?>
</li>
<?php
$m++;
}	
?>	
</ul>
<!-- End navigation menu        -->
</div>
</div>
</div>
</header>
<!----js files--->
<!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="js/main.js"></script>
<script src="js/shortcut.js"></script>
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
<!----js files--->
<script>
$(".has-submenu").each(function(){
$(this).removeClass("last-elements");	
});
</script>