<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;


$placeHolderDataGridView = new CArrayDataProvider(array(
    array('id'=>1, 'firstName'=>'Mark', 'lastName'=>'Otto', 'language'=>'CSS','usage'=>'<span class="inlinebar">1,3,4,5,3,5</span>'),
));

$gridDataProvider = new CArrayDataProvider($clientVb);


?>


<style type="text/css">
    .action-buttons {
        font-size: 31px;
        padding: 20px;
    }

</style>
<div class="row-fluid">
    <div class="span8 offset2">
        <?php
        $this->widget('bootstrap.widgets.TbAlert', array(
            'fade'=>true, // use transitions?
            'closeText'=>'×', // close link text - if set to false, no close link is displayed
            'alerts'=>array( // configurations per alert type
                'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
                'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
            ),
        )); ?>
      <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>'<span class="icon-picture"></span>Client VB',
            'titleCssClass'=>''
        ));
        ?>
        <?php $this->widget('yiiwheels.widgets.grid.WhGridView', array(
            'id'=>'gridview1',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$gridDataProvider,
            'template'=>"{summary}\n{items}\n{pager}",
            'columns'=>array(
                'client_name',
                'balance',
                'seconds',
                'calls',
                'generated',
                'ppminc',
                'leads',
            ),
        )); ?>        
        
        <?php $this->endWidget(); ?>
        
    </div>
</div>

<div class="row-fluid">
	<div class="span4 offset2">
        <?php echo CHtml::link('Start', array('/campaigns/activate'), array('class'=>'btn btn-primary btn-block action-buttons')); ?>
	</div>
    <div class="span4">
        <?php echo CHtml::link('Stop', array('/campaigns/deactivate'), array('class'=>'btn btn-danger btn-block action-buttons')); ?>
    </div>
</div>


