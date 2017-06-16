<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Orders', 'url'=>array('index')),
	array('label'=>'Create Orders', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#orders-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orders-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'order_code',
		'order_date',
		'id_address',
		'customer_id',
		'bank_transfer',
		
		'payment_status',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); */?>




<table class="table table-striped" data-effect="fade">
	                <thead>
	                  <tr>
	                    <th>Kode Order</th>
						<th>Pemesan</th>
	                    <th>Alamat</th>
	                    <th>Bank</th>
	                    <th>Tanggal</th>
						<th>Status Pembayaran</th>
						<!--<th>Aksi</th>-->
	                  </tr>
	                </thead>
	                <tbody>
					
					
					<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_shop";



foreach($data as $dt){
					   
					 $id = $dt->id;  
					$order_code = $dt->order_code;
					$customer_id = $dt->customer_id;
                    $id_address = $dt->id_address;
                    $bank_transfer = $dt->bank_transfer;
					$tanggal=$dt->order_date;
$payment_status = $dt->payment_status;

}


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

$sql22="SELECT * from customer";
$result=mysqli_query($conn,$sql22);

// Associative array
$row=mysqli_fetch_assoc($result);
//$t=$row['username'];
$y=$row['customer_name'];

//$u=$row['level'];
//$isActive='active';

?>
					
					
					
					
					<?php
     

  /*   
			foreach($data as $dt){
					   
					 $id = $dt->id;  
					$order_code = $dt->order_code;
					$customer_id = $dt->customer_id;
                    $id_address = $dt->id_address;
                    $bank_transfer = $dt->bank_transfer;
					$tanggal=$dt->order_date;
                    $payment_status = $dt->payment_status;
*/ ?>
   <?php         
/*
		$host='localhost';
$user='root';
$pass='';
$db='online_shop';

$db=new mysqli($host,$user,$pass,$db);

if($db->connect_errno) {
	echo 'Gagal koneksi ke mysql : ('.$db->connect_errno.') '.$db->connect_error;
}

					$queryjoin=$db->query('SELECT orders.order_code, orders.order_date, orders.bank_transfer, orders.id_address, orders.payment_status, customer.customer_name
FROM orders
INNER JOIN customer ON orders.customer_id = customer.customer_id');
while($data=$queryjoin->fetch_object()){
*/?>


<?php 
        //        $no = 1;
                $query = "SELECT orders.id, orders.order_code, orders.customer_id, orders.order_date, orders.bank_transfer, orders.id_address, orders.payment_status, customer.customer_name, addressbook.address
FROM orders
JOIN customer ON orders.customer_id = customer.customer_id
JOIN addressbook ON orders.customer_id = addressbook.customer_id";
                $sql = mysqli_query($conn,$query); ?>
    
    
            <?php   while ($row = mysqli_fetch_array($sql))
            {
            
            $id=$row['id'];    
			$order_date=$row['order_date'];
            $order_code=$row['order_code'];
            $id_address=$row['address'];
            $bank_transfer=$row['bank_transfer'];
            $payment_status=$row['payment_status'];
            $customer_id=$row['customer_name'];
?>

					
	                  <tr>
	                    <td><?php echo $order_code;?></td>
	                    <td><?php echo $customer_id;?></td>
	                    <td><?php echo $id_address;?></td>
						<td><?php echo $bank_transfer;?></td>
						<td><?php echo $order_date; ?></td>
						
						<?php if($payment_status==1){
							echo "<td><span class='label label-success'><i class='fa fa-check-circle'></i> Lunas</span></td>";
						}else{
							echo "<td><span class='label label-danger'><i class='fa fa-warning'></i> Belum Lunas</span></td>";
						}?>
						
						
					    
						<!--<td>
						<acronym title="Lihat Data"><a href="index.php?r=orders/view&id=<?php echo $id;?>"><i class="fa fa-search"></i></a></acronym>
						</td>-->
	                  </tr>
			<?php } ?>  
					  
	                </tbody>
	              </table>
 <?php /*$this-> widget('CLinkPager',array(
'pages'=> $pages
));*/
?>
