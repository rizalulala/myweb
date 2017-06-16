<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Widya Handicraft</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/responsive/style.css">
	<link rel="stylesheet" href="css/w3.css">

<style>

.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    border-radius: 5px; /* 5px rounded corners */
}

/* Add rounded corners to the top left and the top right corner of the image */
img {
    border-radius: 5px 5px 0 0;
}

div.img {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 180px;
}

div.img:hover {
    border: 1px solid #777;
}

div.img img {
    width: 100%;
    height: auto;
}

div.desc {
    padding: 15px;
    text-align: center;
}

@font-face {
    font-family: 'Southype';
    src: url('css/fonts/LCDPHONE.ttf');
    font-weight: normal;
    font-style: normal;
}



</style>







</head>
<body>
	

<div class="container">
	
	<div class="header">
	
	<marquee align="left"><font style="font-family:Southype;" color="red"><b>Selamat Datang Di Widya Handicraft :)</b></font></marquee>
	
		</div>
		<!--<strong>3 Columns</strong> --- <small><a href="http://www.tutorial-cara-membuat-desain-web-responsive">Back to article</a></small>-->
	<!--/ .header -->

	<div class="main">
		
		<div class="left">
			<h3>Category</h3>
			<br>
			
				<p><a href="index.php?r=">New Product</a></p>
				<p>Best Seller</p>
				<?php if(''.Yii::app()->user->isGuest.'')
				
			echo "<p><a href='index.php?r=site/login'>Login</a></p>";
			
			else{
				echo "<p><a href='index.php?r=site/logout'>Logout</a></p>";
				}
				?>
			
			
		<!--	 <div class="card">
  <img src="images/1.jpg" alt="Avatar" style="width:100%">
  <div class="container">
    <h4><b>Fajar Niskala .H</b></h4>
    <p>Original Human</p>
  </div>-->

			
			
			<!--<p>Tutorial-webdesign.com adalah Website untuk Web Designer & Web Developer Indonesia, Serta Graphic Designer Indonesia. </p>-->
		</div> <!--/ .header -->

		<div class="middle">
			
			
			<?php echo $content; ?>
			<!--
			
			<p><strong><a href="http://www.tutorial-webdesign.com/pengenalan-responsive-web-design/" target="_blank">Pengenalan responsive web design / desain web responsif</a></strong> – Hallo para pembaca TWD, pertama-tama kami ingin mengucapkan Selamat Tahun Baru 2015 untuk para pembaca semuanya, semoga tahun ini menjadi tahun yang lebih baik untuk kita dibanding tahun-tahun sebelumnya.</p>
			<p><img src="http://www.tutorial-webdesign.com/wp-content/uploads/2015/01/responsive-web-design.jpg" alt=""></p>
			<p><a href="http://www.tutorial-webdesign.com/kegunaan-manfaat-responsive-web-design/">Seberapa Penting Sih Responsive Web Design?</a> Semakin hari semakin banyak orang yang menggunakan perangkat mobile untuk browsing, seperti menggunakan smartphone dan tablet untuk setiap tugas atau pekerjaannya sehari-hari. Pekerjaan yang dulunya hanya dilakukan melalui personal komputer (desktop & laptop) sekarang hampir semua sudah bisa digunakan juga melalui perangkat mobile.</p>
			<p><img src="http://www.tutorial-webdesign.com/wp-content/uploads/2015/01/responsive-web-design1.jpg" alt=""></p>-->
		</div>
		
		
 <!--/ .middle -->

		<div class="right">
			
			<?php 
			
			$a=''.Yii::app()->User->name.'';
			
			$con=mysqli_connect("localhost","root","","online_shop");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT * FROM product";
$shania="SELECT * FROM orders where payment_status='1'";

if ($result=mysqli_query($con,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  //printf("Result set has %d rows.\n",$rowcount);
  // Free result set
  mysqli_free_result($result);
  }
  
if ($shania2=mysqli_query($con,$shania))
  {
  // Return the number of rows in result set
  $rowcountorder=mysqli_num_rows($shania2);
  //printf("Result set has %d rows.\n",$rowcount);
  // Free result set
  mysqli_free_result($shania2);
  }

mysqli_close($con);
			
			
			?>
			<p>Jumlah Produk : <?php echo $rowcount; ?></p>
			<p>Jumlah Order : <?php echo $rowcountorder; ?></p>
			
		
			<p><a href="index.php?r=cart/">Keranjang Anda</a></p>
			
			

			
			
			
		
			<!--<p>Responsive Web Design adalah sebuah teknik yang digunakan untuk membuat layout website menyesuaikan ukuran lebar layar dari perangkat yang digunakan</p>
			<h3>Artikel Responsive Lain</h3>
			<p>
				<ul>
					<li><a href="http://www.tutorial-webdesign.com/pengenalan-responsive-web-design/">Pengenalan Responsive Web Design</a></li>
					<li><a href="http://www.tutorial-webdesign.com/kegunaan-manfaat-responsive-web-design/">Seberapa Penting Sih Responsive Web Design?</a></li>
					<li><a href="http://www.tutorial-webdesign.com/6-tips-untuk-membuat-website-responsive/">6 Tips Untuk Membuat Website Responsive</a></li>
					<li><a href="http://www.tutorial-webdesign.com/prinsip-dasar-responsive-web-design/">9 Prinsip Dasar Responsive Web Design</a></li>
					<li><a href="http://www.tutorial-webdesign.com/template-blogger-blogspot-gratis-dan-responsive/">7 Template Blogger Blogspot Gratis Dan Responsive</a></li>
					<li><a href="http://www.tutorial-webdesign.com/test-responsive-web/">Test Responsive Web Design</a></li>
				</ul>
			</p>-->
		</div> <!--/ .right -->

	</div> <!--/ .main -->

	<div class="footer">
		
		<p>Copyright &copy; 2017 <a href="http://www.tutorial-webdesign.com"></a></p>
	</div> <!--/ .footer -->
 
</div>

</body>
</html>
