<?php
/* @var $this ListRecordController */
/* @var $model ListRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'list-record-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'listid'); ?>
		<?php echo $form->textField($model,'listid'); ?>
		<?php echo $form->error($model,'listid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diallable_leads'); ?>
		<?php echo $form->textField($model,'diallable_leads'); ?>
		<?php echo $form->error($model,'diallable_leads'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'credit_used'); ?>
		<?php echo $form->textField($model,'credit_used'); ?>
		<?php echo $form->error($model,'credit_used'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_minutes'); ?>
		<?php echo $form->textField($model,'total_minutes'); ?>
		<?php echo $form->error($model,'total_minutes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->