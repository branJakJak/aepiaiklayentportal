<?php
/* @var $this ListRecordController */
/* @var $model ListRecord */

$this->breadcrumbs=array(
	'List Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ListRecord', 'url'=>array('index')),
	array('label'=>'Manage ListRecord', 'url'=>array('admin')),
);
?>

<h1>Create ListRecord</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>