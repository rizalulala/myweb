<?php $form = $this -> beginWidget('CActiveForm', 
		array('id' => 'add-addressBook-form', 
		'enableAjaxValidation' => false, 
		'enableClientValidation' => TRUE, 
		)
	); 
?>

<p class="note">
	Fields with <span class="required">*</span> are required.
</p>
<!--untuk menampilkan summary error-->
<?php echo $form -> errorSummary($model); ?>

<div class="row">
	<?php echo $form -> labelEx($model, 'nama'); ?>
	<?php echo $form -> textField($model, 'nama', array('size' => 56, 'maxlength' => 56)); ?>
	<?php echo $form -> error($model, 'nama'); ?>
</div>

<div class="row">
	<?php echo $form -> labelEx($model, 'nomor_telpon'); ?>
	<?php echo $form -> textField($model, 'nomor_telpon', array('size' => 15, 'maxlength' => 15)); ?>
	<?php echo $form -> error($model, 'nomor_telpon'); ?>
</div>

<div class="row">
	<?php echo $form -> labelEx($model, 'alamat'); ?>
	<?php echo $form -> textArea($model, 'alamat', array('cols' => 43, 'rows' => 3)); ?>
	<?php echo $form -> error($model, 'alamat'); ?>
</div>

<div class="row">
	<?php echo $form -> labelEx($model, 'provinsi'); ?>
	<?php echo $form -> textField($model, 'provinsi', array('size' => 35, 'maxlength' => 35)); ?>
	<?php echo $form -> error($model, 'provinsi'); ?>
</div>

<div class="row">
	<?php echo $form -> labelEx($model, 'kota'); ?>
	<?php echo $form -> textField($model, 'kota', array('size' => 35, 'maxlength' => 35)); ?>
	<?php echo $form -> error($model, 'kota'); ?>
</div>

<div class="row buttons">
	<?php echo CHtml::submitButton($model -> isNewRecord ? 'Create' : 'Save'); ?>
</div>

<?php $this -> endWidget(); ?>