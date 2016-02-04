<?php 

?>
<?php echo CHtml::beginForm(array(), 'POST'); ?>

<?php echo CHtml::activeLabel($exportModel, 'date_from'); ?>	
<?php 
	$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	    'model'=>$exportModel,
	    'attribute'=>'date_from',
	    'options'=>array(
	        'showAnim'=>'fold',
	        'changeMonth'=>true,
	        'changeYear'=>true,
	    ),
	    'htmlOptions'=>array(
	        'style'=>'height:20px;'
	    ),
	));
?>
<?php echo CHtml::error($exportModel, 'date_from'); ?>


<?php echo CHtml::activeLabel($exportModel, 'date_to'); ?>	
<?php 
	$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	    'model'=>$exportModel,
	    'attribute'=>'date_to',
	    'options'=>array(
	        'showAnim'=>'fold',
	        'changeMonth'=>true,
	        'changeYear'=>true,
	        'showAnim'=>'fold',
	    ),
	    'htmlOptions'=>array(
	        'style'=>'height:20px;'
	    ),
	));
?>
<?php echo CHtml::error($exportModel, 'date_to'); ?>
<?php echo CHtml::submitButton('Submit',array('class'=>"btn btn-primary",'style'=>"margin-bottom: 5px;width: 218px")); ?>
<?php echo CHtml::resetButton('Clear',array('class'=>'btn btn-default','style'=>"width: 218px")); ?>
<?php echo CHtml::endForm(); ?>