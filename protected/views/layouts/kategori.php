<!doctype html>
<html lang="en">

<head>
	<title>Dashboard | Admin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- CSS -->
	<link rel="stylesheet" href="css/admin/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/admin/assets/css/vendor/icon-sets.css">
	<link rel="stylesheet" href="css/admin/assets/css/main.min.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="css/admin/assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="css/admin/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="css/admin/assets/img/favicon.png">
</head>

<?php
$con=mysqli_connect("localhost","root","","widya_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT * FROM product ORDER BY id desc";

if ($result=mysqli_query($con,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  
  
  
  // Free result set
  mysqli_free_result($result);
  }

mysqli_close($con);

?>

<?php
$con=mysqli_connect("localhost","root","","widya_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql2="SELECT * FROM pemesanan where status='Pesanan Baru' group by id_pelanggan ORDER BY id_pemesanan desc";

if ($result2=mysqli_query($con,$sql2))
  {
  // Return the number of rows in result set
  $rowcountpemesanan=mysqli_num_rows($result2);
  
  
  
  // Free result set
  mysqli_free_result($result2);
  }

mysqli_close($con);

?>


<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- SIDEBAR -->
		<div class="sidebar">
			<div class="brand">
				<a href="index.php"></a>
			</div>
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="index.php?r=admin" class=""><i class="lnr lnr-home"></i> <span>Beranda</span></a></li>
						<li><a href="index.php?r=kategori/admin" class="active"><span>Kelola Kategori</span></a></li>
						<li><a href="index.php?r=produk/admin" class=""><span>Produk</span></a></li>
						<li><a href="index.php?r=produk/admingudang" class=""><span>Gudang</span></a></li>
						<li><a href="index.php?r=admin/pemesanan" class=""><span>
						
						<?php if($rowcountpemesanan>0){?> 
						<font color="red"><?php echo $rowcountpemesanan;?>
						<?php echo "Pemesanan Baru</font>";
						}else{?>
						
						Pemesanan
						
						<?php } ?>
						
						
						
						
						
						</span></a></li>
						<li><a href="#" class=""><span>Laporan</span></a></li>
						
					</ul>
				</nav>
			</div>
			<span class="footer">WIDYA HANDICRAFT</span>
		</div>
		<!-- END SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- NAVBAR -->
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
							<span class="sr-only">Toggle Navigation</span>
							<i class="fa fa-bars icon-nav"></i>
						</button>
					</div>
					<div id="navbar-menu" class="navbar-collapse collapse">
						
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								
								<ul class="dropdown-menu notifications">
									<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
									<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
									<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
									<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
									<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
									<li><a href="#" class="more">See all notifications</a></li>
								</ul>
							</li>
							<!--<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="#">Basic Use</a></li>
									<li><a href="#">Working With Data</a></li>
									<li><a href="#">Security</a></li>
									<li><a href="#">Troubleshooting</a></li>
								</ul>
							</li>-->
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><?php echo ''.Yii::app()->User->name.'' ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
								<ul class="dropdown-menu">
									
									<li><a href="index.php?r=site/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			
			
			
			
			<!-- END NAVBAR -->
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Hello <?php echo ''.Yii::app()->User->name.'' ?></h3>
							<!--<p class="panel-subtitle"><?php/*
$tanggal= mktime(date("m"),date("d"),date("Y"));
echo "Tanggal : <b>".date("d M Y", $tanggal)."</b> ";
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");
echo "| Pukul : <b>". $jam." "."</b>";
$a = date ("H");
if (($a>=6) && ($a<=11)){
echo "<b>, Selamat Pagi !!</b>";
}
else if(($a>11) && ($a<=15))
{
echo ", Selamat Siang !!";}
else if (($a>15) && ($a<=18)){
echo ", Selamat Malam !!";}
else { echo ", <b> Selamat Malam </b>";} */
?></p>-->
						</div>
						<?php echo $content;?> 
							</div>
					
					<!-- END OVERVIEW -->
					
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
			<!--<footer>
				<div class="container-fluid">
					<p class="copyright">&copy; 2016. Designed &amp; Crafted by <a href="https://themeineed.com">The Develovers</a></p>
				</div>
			</footer>-->
		</div>
		<!-- END MAIN -->
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="css/admin/assets/js/jquery/jquery-2.1.0.min.js"></script>
	<script src="css/admin/assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="css/admin/assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="css/admin/assets/js/plugins/jquery-easypiechart/jquery.easypiechart.min.js"></script>
	<script src="css/admin/assets/js/plugins/chartist/chartist.min.js"></script>
	<script src="css/admin/assets/js/klorofil.min.js"></script>
</body>

</html>
