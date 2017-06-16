<?php
/*untuk membuat breadcrumbs*/
$this -> breadcrumbs = array('Cart' => array('.'),Yii::app() -> user -> Namapelanggan=>array('account/'),'Choose address');
?>

<div style="padding:5px 10px 0 0;margin:5px 5px 15px 5px; border:1px solid #CCC;text-align: justify;">
	<div style="margin-left: 5px;" class="flash-success">Gunakan 'Alamat' yang sudah ada dibawah ini: </div>
	 
	<form action="" method="post">
		 
		 
		<div style="clear: left;"></div>
	<?php
		$i=1;foreach($addressBooks as $address):
		($i%3===0) ? $div ='<div style="clear:left;"></div>':$div='';
		($i===1) ? $checked ='checked="checked"' : $checked='';
	?>
		<div style="float: left;margin:5px 0 0 5px;border:solid 1px #CCC;">
			<table width="166" height="66">
				<tr>
					<td valign="top"><input type="radio" <?php echo $checked;?> name="ChooseAddress[id_alamat]" value="<?php echo $address->id_alamat;?>" /></td>
					<td valign="top">
						<strong><?php echo $address->nama;?></strong><br>
						<?php echo $address->alamat;?>
						<?php echo $address->provinsi;?>
						<?php echo $address->kota;?><br>
						Telp./Hp : 
						<?php echo $address->nomor_telpon;?>
					</td>
				</tr>
			</table>
		</div>
		<?php
		echo $div;
		$i++;
		endforeach;
		?>
	<div style="clear:left;"></div>
	<div class="flash-notice" style="margin:15px 0 0 5px;">
	<p style="margin-left: 5px;">Atau
		<strong><a href="<?php echo $this->createUrl('cart/finishshop',array('addNewAddress'=>'and use it'));?>">Buat alamat baru dan gunakan sebagai alamat pengiriman</a></strong>
	</p>
	</div>
	<?php
	foreach(Yii::app()->user->getFlashes() as $key=>$message){
		echo "<div style='margin-left:5px;' class='flash-".$key."'>".$message."'</div>";
	}
	?>
	<p style="float: right;margin-right: 5px;">
		<input type="submit" value="Lanjutkan" onclick="return confirm('periksa kembali, apakah alamat kirim sudah benar?')" />
	</p>
	</form>
	<div style="clear: both;"></div>
</div>