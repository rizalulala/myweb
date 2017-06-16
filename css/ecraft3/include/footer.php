
<?php

$melody=''.Yii::app()->User->name.'';

$mysqli = new mysqli("localhost", "root", "", "widya_db");
$result = $mysqli->query("SELECT * FROM pelanggan where username='$melody'");
$row = $result->fetch_assoc();

mysqli_free_result($result);

$frieska=$row['username'];
$sonia=$row['nama_pelanggan'];

//mysqli_close($mysqli); 

?>





<div class="footer" style="background-color: #f8f8f8">
	<div class="container">
		<div class="col-md-3 footer-grids fgd1">
		<a href="index.html"><img src="css/ecraft3/images/logo.png" alt=" " /><h4>Widya Handicraft<span></span></h4></a>
		<ul>
		</ul>
		</div>
		<div class="col-md-3 footer-grids fgd2">
			<h4>Kontak Kami</h4> 
			<ul>
				<li>Banyuwangi, 68416</li>
				<li>Jawa Timur, Indonesia</li>
				<li>widya_handicraft@gmail.com</li>
			</ul>
		</div>
		<div class="col-md-3 footer-grids fgd1">
			<h4>Cari Kami</h4>
		<ul>
			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
								
			</ul>
		</div>
		
		<!--<div class="col-md-3 footer-grids fgd4">
			<h4>My Account</h4> 
			<ul>
			<?php //if($melody=='Guest'){?>	
				<li><a href="index.php?r=site/login">Login</a></li>
				<li><a href="index.php?r=site/daftar">Register</a></li>
			<?php //} ?>
			<?php //if($melody!='Guest'){?>
				<li>Halo <?php //echo $sonia;?></li>
				<li>Daftar Pesanan</li>
				<li><a href="index.php?r=site/logout">Logout</a></li>
			<?php //}?>
			</ul>
		</div>-->
		<div class="clearfix "></div>
		<!-- <p class="copy-right">© 2016 Fashion Club . All rights reserved | Design by <a href="http://w3layouts.com"> W3layouts.</a></p> -->
	</div>
</div>