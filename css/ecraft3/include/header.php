<?php $melody=''.Yii::app()->User->name.''; 

$mysqli = new mysqli("localhost", "root", "", "widya_db");
$result = $mysqli->query("SELECT * FROM pelanggan where username='$melody'");
$row = $result->fetch_assoc();

mysqli_free_result($result);

$frieska=$row['username'];
$sonia=$row['nama_pelanggan'];
$level=$row['level'];
$id_pel=$row['id_pelanggan'];

$result2 = $mysqli->query("SELECT * FROM admin where username='$melody'");
$row2 = $result2->fetch_assoc();

mysqli_free_result($result2);

$wawa=$row2['username'];
$mpris=$row2['level'];



?>


<div class="header-top-w3layouts">
	<div class="container">
		<div class="col-md-6 logo-w3">
			<a href="index.php"><img src="css/ecraft3/images/logo.png" alt=" " /><h1>Widya Handicraft<span></span></h1></a>
		</div>
		<div class="col-md-6 phone-w3l">
			<ul>
			
				<?php if($melody=='Guest'){?>
				<?php }else{?>
				<li><span class="glyphicon glyphicon-user" aria-hidden="true"></span></li>
				<li>Halo <?php echo $melody;?></li>
				<!--<li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></li>
				<li>123456789110</li>-->
				<?php }?>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="header-bottom-w3ls">
	<div class="container">
		<div class="col-md-7 navigation-agileits">
			<nav class="navbar navbar-default">
				<div class="navbar-header nav_2">
					<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div> 
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav ">
						<li><a href="index.php" class="hyper "><span>Beranda</span></a></li>
						<li><a href="index.php?r=site/login" class="hyper">Tentang Kami</a></li>						
						
						
						<?php if($level==2){?>
						<!--<li class="dropdown ">
							<a href="#" class="dropdown-toggle  hyper" data-toggle="dropdown" ><span>Akun Saya<b class="caret"></b></span></a>
								<ul class="dropdown-menu multi">
									<div class="row">
										<div class="col-sm-4">
											<ul class="multi-column-dropdown">
												
												
												<li><i class="fa fa-angle-right" aria-hidden="true"></i>Halo <?php //echo $sonia;?></li>
												<li><i class="fa fa-angle-right" aria-hidden="true"></i>Daftar Pesanan</li>
												<li><a href="index.php?r=site/logout">Logout</a></li>
												
												
												
											</ul>
										
										</div>
										<div class="col-sm-4 w3l">
											<!--<a href="women.php"><img src="images/menu1.jpg" class="img-responsive" alt=""></a>
										</div>
										</div>
										
										
										<div class="clearfix"></div>
									</div>	
								</ul>
						</li>-->
						<?php if($frieska=='Guest'){?>
						
						
						
						<li><a href="index.php?r=user/index" class="hyper "><span>Akun Saya</span></a></li>
						<?php }?>
						<?php if($frieska!='Guest'){?>
						
						<li class="dropdown ">
							<a href="#" class="dropdown-toggle  hyper" data-toggle="dropdown" ><span>Akun Saya<b class="caret"></b></span></a>
								<ul class="dropdown-menu multi">
									<div class="row">
										<div class="col-sm-4">
											<ul class="multi-column-dropdown">
			
												<li><a href="index.php?r=user/index"><i class="fa fa-angle-right" aria-hidden="true"></i>Pesanan Saya</a></li>
												<li><a href="index.php?r=site/logout"><i class="fa fa-angle-right" aria-hidden="true"></i>Logout</a></li>
										
											</ul>
										
										</div>
																				<div class="col-sm-4 w3l">
											<!--<a href="women.php"><img src="images/menu1.jpg" class="img-responsive" alt=""></a>-->
										</div>
										<div class="clearfix"></div>
									</div>	
								</ul>
						</li>
						<?php }?>
						<?php }?>
						<li><a href="index.php?r=site/" class="hyper">Bantuan</a></li>
						
						<?php if($mpris==1){?>
						<!--<li class="dropdown ">
							<a href="#" class="dropdown-toggle  hyper" data-toggle="dropdown" ><span>Akun Saya<b class="caret"></b></span></a>
								<ul class="dropdown-menu multi">
									<div class="row">
										<div class="col-sm-4">
											<ul class="multi-column-dropdown">
												
												
												<li><i class="fa fa-angle-right" aria-hidden="true"></i>Halo <?php //echo $sonia;?></li>
												<li><i class="fa fa-angle-right" aria-hidden="true"></i>Daftar Pesanan</li>
												<li><a href="index.php?r=site/logout">Logout</a></li>
												
												
												
											</ul>
										
										</div>
										<div class="col-sm-4 w3l">
											<!--<a href="women.php"><img src="images/menu1.jpg" class="img-responsive" alt=""></a>
										</div>
										</div>
										
										
										<div class="clearfix"></div>
									</div>	
								</ul>
						</li>-->
						
						<li><a href="index.php?r=admin/" target="_blank" class="hyper "><span>Halaman Admin</span></a></li>
						<?php }?>
						
						<?php if($melody=='Guest'){?>
						<li class="dropdown ">
							<a href="#" class="dropdown-toggle  hyper" data-toggle="dropdown" ><span>Akun Saya<b class="caret"></b></span></a>
								<ul class="dropdown-menu multi">
									<div class="row">
										<div class="col-sm-4">
											<ul class="multi-column-dropdown">
			
												<li><a href="index.php?r=site/login"><i class="fa fa-angle-right" aria-hidden="true"></i>Masuk</a></li>
												<li><a href="index.php?r=site/daftar"><i class="fa fa-angle-right" aria-hidden="true"></i>Daftar</a></li>
								
											</ul>
										</div>
						<?php } ?>
						
						
						
						
						
						<!--<li class="dropdown">
								<a href="#" class="dropdown-toggle hyper" data-toggle="dropdown" ><span> Personal Care <b class="caret"></b></span></a>
								<ul class="dropdown-menu multi multi1">
									<div class="row">
										<div class="col-sm-4">
											<ul class="multi-column-dropdown">
												<li><a href="women.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Jewellery </a></li>
												<li><a href="women.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Watches</a></li>
										
											</ul>
											
										</div>
										<div class="col-sm-4">
											
											<ul class="multi-column-dropdown">
												<li><a href="women.php"> <i class="fa fa-angle-right" aria-hidden="true"></i>Hair Care </a></li>
												<li><a href="women.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Shoes</a></li>
										
											</ul>
											
										</div>
										<div class="col-sm-4 w3l">
											<a href="women.php"><img src="images/menu2.jpg" class="img-responsive" alt=""></a>
										</div>
										<div class="clearfix"></div>
									</div>	
								</ul>
						</li>-->
						<!--<li><a href="#" class="hyper"><span>About</span></a></li>
						<li><a href="#" class="hyper"><span>Contact Us</span></a></li>-->
					</ul>
				</div>
			</nav>
		</div>
								<script>
				$(document).ready(function(){
					$(".dropdown").hover(            
						function() {
							$('.dropdown-menu', this).stop( true, true ).slideDown("fast");
							$(this).toggleClass('open');        
						},
						function() {
							$('.dropdown-menu', this).stop( true, true ).slideUp("fast");
							$(this).toggleClass('open');       
						}
					);
				});
				</script>
		<div class="col-md-2 search-agileinfo">
			<form action="index.php?r=site/hasilsearch" method="post">
				<input type="search" name="cari" placeholder="Cari Produk..." required="">
				<button type="submit" class="btn btn-default search" aria-label="Left Align">
					<i class="fa fa-search" aria-hidden="true"> </i>
				</button>
			</form>
		</div>
		
				<?php
		$con=mysqli_connect("localhost","root","","widya_db");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }

		$sql2="SELECT * FROM keranjang where id_pelanggan='$id_pel' and status not like '%checkout%'";

		if ($result2=mysqli_query($con,$sql2))
		  {
		  // Return the number of rows in result set
		  $rowcountkeranjang=mysqli_num_rows($result2);
		  
		  
		  
		  // Free result set
		  mysqli_free_result($result2);
		  }

		mysqli_close($con);

		?>
		
		
		<div class="col-md-2 cart-wthree">
			<div class="cart"> 
				<form action="#" method="post" class="last"> 
					<!-- <input type="hidden" name="cmd" value="_cart" />
					<input type="hidden" name="display" value="1" /> -->
					 <!-- <button class="w3view-cart" type="submit" name="submit" value=""> <a href="basket.php"> <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> </a> </button> -->

					 <a href="index.php?r=site/viewkeranjang" class="w3view-cart">
					 	<i class="fa fa-cart-arrow-down fa-small" aria-hidden="true"></i> <?php echo $rowcountkeranjang;?> Item
					 </a>
				</form>  
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>