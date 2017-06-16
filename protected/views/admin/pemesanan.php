<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php /* $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'product_name',
		'category_id',
		'price',
		'purchase_price',
		'description',
		
		'image',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); */?>


<?php 

$con=mysqli_connect("localhost","root","","widya_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT * FROM pemesanan where status='Pesanan Baru' ORDER BY id_pemesanan desc";

if ($result=mysqli_query($con,$sql))
  {
  // Return the number of rows in result set
  $row=mysqli_fetch_array($result);
  
  
  
  
  // Free result set
  mysqli_free_result($result);
  }

mysqli_close($con);


?>

<?php if($row==null){
	echo "<center><h1>Tidak Ada Pemesanan Baru</h1></center><br>";
}else{?>

<center><h1>Daftar Pesanan</h1></center><br>
 <table class="table table-striped" data-effect="fade">
	                <thead>
	                  <tr>
						<th>Nama Pelanggan</th>
	                    <!--<th>Harga</th>-->
	                    
	                    <th>Status</th>
	                  </tr>
	                </thead>
	                <tbody>
					
					<?php 
									
				$con=mysqli_connect("localhost","root","","widya_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
									
$query=$con->query('select id_pemesanan, pemesanan.id_pelanggan, nama_produk, qty, subtotal, pelanggan.nama_pelanggan, status from pemesanan inner join pelanggan on pemesanan.id_pelanggan=pelanggan.id_pelanggan where pemesanan.status="Pesanan Baru" group by id_pelanggan');

while($data=$query->fetch_object()){
?>
                       
					
					
	                  <tr>
						<td><a href="index.php?r=admin/detailpemesanan&id=<?php echo $data->id_pelanggan;?>"><?php echo $data->nama_pelanggan;?></a></td>
	                    <!--<td><?php //echo $data->nama_produk;?></td>
	                    <!--<td>Rp. <?php //echo number_format($data->harga, 0, '.', '.'); ?>,00</td>
	                    <td><?php// echo $data->qty;?></td>
	                    <td>Rp. <?php //echo number_format($data->subtotal, 0, '.', '.'); ?>,00</td>-->
						
	                    <!--<td width="80"><acronym title="Ubah Data"><a href="index.php?r=produk/update&id=<?php //echo $id_produk;?>"><i class="fa fa-pencil"></i></a></acronym>
						<!--<acronym title="Lihat Data"><a href="index.php?r=produk/view&id=<?php //echo $id_produk;?>"><i class="fa fa-search"></i></a></acronym>-->
						<!--<acronym title="Hapus Data"><a href="index.php?r=produk/hapus&id=<?php //echo $id_produk;?>" onclick="return konfirmasi_hapus();"><i class="fa fa-trash"></i></a></acronym></td>-->
						
						<td><?php echo $data->status;?></td>
						
						<?php /*if($data->status=='Pesanan Baru'){
						echo "<td>Menunggu Konfirmasi Admin</td>";
						}else{
						echo "<td>Pesanan Anda Sedang Diproses</td>";
						}*/?>
						
	                  </tr>
			<?php } ?>  
					  
	                </tbody>
	              </table>
				  <script>
function konfirmasi_hapus()
{
	if(confirm('Anda yakin menghapus data ini ?')){
		return true;
	}else{
		return false;
	}
}
</script>
<br>
<div align="center">
 <?php $this-> widget('CLinkPager',array(
'pages'=> $pages
));
?>
</div>
<?php }?>