<?php
/* @var $this BalanceController */
/* @var $model BalanceLog */

$this->breadcrumbs=array(
	'Balance Logs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

// $this->menu=array(
// 	array('label'=>'List BalanceLog', 'url'=>array('index')),
// 	array('label'=>'Create BalanceLog', 'url'=>array('create')),
// 	array('label'=>'View BalanceLog', 'url'=>array('view', 'id'=>$model->id)),
// 	array('label'=>'Manage BalanceLog', 'url'=>array('admin')),
// );


?>

<h1>Update BalanceLog <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>