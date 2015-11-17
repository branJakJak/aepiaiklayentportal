<?php
/* @var $this BalanceController */
/* @var $model BalanceLog */

$this->breadcrumbs=array(
	'Balance Logs'=>array('index'),
	$model->id,
);

// $this->menu=array(
// 	array('label'=>'List BalanceLog', 'url'=>array('index')),
// 	array('label'=>'Create BalanceLog', 'url'=>array('create')),
// 	array('label'=>'Update BalanceLog', 'url'=>array('update', 'id'=>$model->id)),
// 	array('label'=>'Delete BalanceLog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage BalanceLog', 'url'=>array('admin')),
// );
?>

<h1>View current balance</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		// 'id',
		'current_balance',
		'date_created',
		// 'date_updated',
	),
)); ?>
