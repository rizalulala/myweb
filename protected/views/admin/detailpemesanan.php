<?php 
				

				
			$abc=$_GET['id'];		 
							
									$con=mysqli_connect("localhost","root","","widya_db");

									
									// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$sql4="SELECT * from pelanggan where id_pelanggan='$abc'";
$result4=mysqli_query($con,$sql4);

// Associative array
$row4=mysqli_fetch_assoc($result4);

$ce2=$row4['id_pelanggan'];
  
$sql="SELECT * from pemesanan where id_pelanggan='$ce2'";
$result=mysqli_query($con,$sql);

// Associative array
$row=mysqli_fetch_assoc($result);

$c=$row['id_pelanggan'];
$d=$row['id_pemesanan'];
$e=$row['status'];

$sql2="SELECT * from pelanggan where id_pelanggan='$c'";
$result2=mysqli_query($con,$sql2);

// Associative array
$row2=mysqli_fetch_assoc($result2);

$ce=$row2['nama_pelanggan'];
//$rating=$row2['nilairating'];



?>		


Rincian Pemesanan :<br><br>

No. Invoice : <?php echo $d;?><br>
Nama Pemesan : <?php echo $ce;?><br>
Produk : <br>
<?php
$query=$con->query('SELECT * FROM pemesanan inner join pelanggan on pemesanan.id_pelanggan=pelanggan.id_pelanggan where pemesanan.id_pelanggan="'.$abc.'"');
while($data=$query->fetch_object()){


 echo '<br> '.$data->nama_produk.'';

}
?><br><br>
Alamat Pemesan : <?php //echo $alamat;?> 
<br>
Status : 
<?php if($e=='Pesanan Baru'){?>
<?php echo "Menunggu Bukti Transfer";?>
<?php}else{?>
<?php }?>
<br>
