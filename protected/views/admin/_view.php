<?php
/* @var $this AdminController */
/* @var $data Admin */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_admin')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_admin), array('view', 'id'=>$data->id_admin)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('level')); ?>:</b>
	<?php echo CHtml::encode($data->level); ?>
	<br />


</div>