<?php
/* @var $this ListRecordController */
/* @var $model ListRecord */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'listid'); ?>
		<?php echo $form->textField($model,'listid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diallable_leads'); ?>
		<?php echo $form->textField($model,'diallable_leads'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'credit_used'); ?>
		<?php echo $form->textField($model,'credit_used'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_minutes'); ?>
		<?php echo $form->textField($model,'total_minutes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->