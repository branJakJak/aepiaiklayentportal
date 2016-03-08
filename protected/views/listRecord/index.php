<?php
/* @var $this ListRecordController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'List Records',
);

$this->menu=array(
	array('label'=>'Create ListRecord', 'url'=>array('create')),
	array('label'=>'Manage ListRecord', 'url'=>array('admin')),
);
?>

<h1>List Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
