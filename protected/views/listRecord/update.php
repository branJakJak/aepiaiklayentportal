<?php
/* @var $this ListRecordController */
/* @var $model ListRecord */

$this->breadcrumbs=array(
	'List Records'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ListRecord', 'url'=>array('index')),
	array('label'=>'Create ListRecord', 'url'=>array('create')),
	array('label'=>'View ListRecord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ListRecord', 'url'=>array('admin')),
);
?>

<h1>Update ListRecord <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>