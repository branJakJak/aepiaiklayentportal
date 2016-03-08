<?php
/* @var $this ListRecordController */
/* @var $data ListRecord */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('listid')); ?>:</b>
	<?php echo CHtml::encode($data->listid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diallable_leads')); ?>:</b>
	<?php echo CHtml::encode($data->diallable_leads); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credit_used')); ?>:</b>
	<?php echo CHtml::encode($data->credit_used); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_minutes')); ?>:</b>
	<?php echo CHtml::encode($data->total_minutes); ?>
	<br />


</div>