<?php
/* @var $this ListRecordController */
/* @var $model ListRecord */

$this->breadcrumbs=array(
	'List Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ListRecord', 'url'=>array('index')),
	array('label'=>'Create ListRecord', 'url'=>array('create')),
	array('label'=>'Update ListRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ListRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ListRecord', 'url'=>array('admin')),
);
?>

<h1>View ListRecord #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'listid',
		'diallable_leads',
		'credit_used',
		'total_minutes',
	),
)); ?>
