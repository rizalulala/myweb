<?php
/* @var $this KategoriController */
/* @var $model Kategori */

$this->breadcrumbs=array(
	'Kategoris'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Kategori', 'url'=>array('index')),
	array('label'=>'Create Kategori', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#kategori-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Kelola Kategori</h1>

<div align="right"><button type="button" onClick='top.location="index.php?r=kategori/create"' class="btn btn-primary">Tambah Kategori</button><br>


<table class="table table-striped" data-effect="fade">
	                <thead>
	                  <tr>
	                    <th>Kategori</th>
	                    <th>Aksi</th>
	                  </tr>
	                </thead>
	                <tbody>
					
					<?php
     

     
			foreach($data as $dt){
					   
					$id_kategori = $dt->id_kategori;  
					$kategori = $dt->kategori;
					//$url = $dt->url;
                    
?>
                       
					
					
	                  <tr>
	                    <td><?php echo $kategori;?></td>
	                    <td width="80"><acronym title="Ubah Data"><a href="index.php?r=kategori/update&id=<?php echo $id_kategori;?>"><i class="fa fa-pencil"></i></a></acronym> || 
						<!--<acronym title="Lihat Data"><a href="index.php?r=produk/view&id=<?php //echo $id_kategori;?>"><i class="fa fa-search"></i></a></acronym>-->
						<acronym title="Hapus Data"><a href="index.php?r=kategori/hapus&id=<?php echo $id_kategori;?>" onclick="return konfirmasi_hapus();"><i class="fa fa-trash"></i></a></acronym></td>
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
				  
				  <div align="center">
 <?php $this-> widget('CLinkPager',array(
'pages'=> $pages
));
?>
</div>