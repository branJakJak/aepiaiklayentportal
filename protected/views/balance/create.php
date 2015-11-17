<?php
/* @var $this BalanceController */
/* @var $model BalanceLog */

$this->breadcrumbs=array(
	'Balance Logs'=>array('index'),
	'Create',
);

// $this->menu=array(
// 	array('label'=>'List BalanceLog', 'url'=>array('index')),
// 	array('label'=>'Manage BalanceLog', 'url'=>array('admin')),
// );
?>

<h1>Balance</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>