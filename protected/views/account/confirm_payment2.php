<?php
/*untuk membuat breadcrumbs*/
$this -> breadcrumbs = array('My account' => array('.'), Yii::app() -> user -> customerName, 'Konfirmasi Pembayaran');
?>
<hr>
<div style="margin: 0 0 0 5px;;">
	<?php $this -> renderPartial('_myaccount_menu'); ?>
</div>
<style>
	form .errorSummary {
    background: none repeat scroll 0 0 #FFEEEE;
    border: 2px solid #CC0000;
    font-size: 0.9em;
    margin: 0 0 20px 3px;
    padding: 7px 7px 12px;
    text-align: justify;
}
form .errorSummary ul{
	padding: 0 0 0 20px;
}
</style>
<div style="padding:5px 10px 0 0;margin:5px 5px 15px 5px; border:1px solid #CCC;text-align: justify;">
 <div style="clear: left;"></div>
 	<?php echo CHtml::beginForm();?>
 	<?php echo CHtml::errorSummary($model); ?>
	
	<form name="myForm" onsubmit="return validateForm()" method="post" action="<?php echo $this->createUrl('account/Masukkan'); ?>">
	<table>
		<tr>
			<td><?php echo CHtml::activeLabel($model, 'nomerPemesanan'); ?></td>
			<td>:</td>
			<td><b><?php echo $_GET['confirm'];?></b>
				 <?php echo CHtml::activeHiddenField($model,'nomerPemesanan',array('value'=>$_GET['confirm']));?> 
			</td>
		</tr>
		<tr>
			<td><?php echo CHtml::activeLabel($model, 'bankAsal'); ?></td>
			<td>:</td>
			<td>
				 <?php echo CHtml::activeTextField($model,'bankAsal');?> 
			</td>
		</tr>
		<tr>
			<td><?php echo CHtml::activeLabel($model, 'pemilikRekAsal'); ?></td>
			<td>:</td>
			<td>
				 <?php echo CHtml::activeTextField($model,'pemilikRekAsal');?> 
			</td>
		</tr>
		<tr>
			<td colspan="3"><hr style="color:pink;"></td>
		</tr>
		<tr>
			<td><?php echo CHtml::activeLabel($model, 'bankTujuan'); ?></td>
			<td>:</td>
			<td>
				<select name="Confirmpayment[bankTujuan]">
					<option value="BCA 1800494342 a.n Rina Indriati">BCA 1800494342 a.n Rina Indriati</option>
					
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo CHtml::activeLabel($model, 'nominalTransfer'); ?></td>
			<td>:</td>
			<td><?php echo CHtml::activeTextField($model,'nominalTransfer');?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><?php //echo CHtml::submitButton('Confirm');?></td>
		</tr>
		
		 
	</table>
	
	<input type="submit" name="btn_proses" value="Akhiri Proses" onMouseOver="tryNumberFormat(this.form.bayar);">
	</form>
	
	<?php echo CHtml::endForm();?>	 
	 

	<div style="clear: both;">
		&nbsp;
	</div>
	 
</div>
