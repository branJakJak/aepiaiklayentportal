<?php
/* @var $this BalanceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Balance Logs',
);

// $this->menu=array(
// 	array('label'=>'Create BalanceLog', 'url'=>array('create')),
// 	array('label'=>'Manage BalanceLog', 'url'=>array('admin')),
// );
?>

<h1>Balance Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
