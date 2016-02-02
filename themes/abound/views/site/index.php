<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;


$placeHolderDataGridView = new CArrayDataProvider(array(
    array('id'=>1, 'firstName'=>'Mark', 'lastName'=>'Otto', 'language'=>'CSS','usage'=>'<span class="inlinebar">1,3,4,5,3,5</span>'),
));

$gridDataProvider = new CArrayDataProvider($clientVb);

$fileUploadedDataProvider = new CArrayDataProvider($fileUploadedArr);


$updateEvery60 = <<<EOL
setInterval(function(){
$.fn.yiiGridView.update("balanceGrid")
}, 5 * (60 * 1000));
EOL;
Yii::app()->clientScript->registerScript($updateEvery60, $updateEvery60, CClientScript::POS_READY);
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
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>'<span class="icon-picture"></span>Upload Files',
            'titleCssClass'=>''
        ));
        ?>
        <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                'id'=>'uploadFile',
                'config'=>array(
                    'template'=>'<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',
                    'action'=>Yii::app()->createUrl('site/upload'),
                    'allowedExtensions'=>array("csv","jpg",'txt','xlsx','xls'),//array("jpg","jpeg","gif","exe","mov" and etc...
                    'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                    'onComplete'=>"js:function(id, fileName, responseJSON){ alert('Success! File uploaded. ') }",
                    'messages'=>array(
                        'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                        'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                        'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                        'emptyError'=>"{file} is empty, please select files again without it.",
                        'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                ),
                    'showMessage'=>"js:function(message){ alert(message); }"
                )
            )); ?>
        <?php $this->endWidget(); ?>

    </div>

</div>








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
            'title'=>'<span class="icon-user"></span>Client VB',
            'titleCssClass'=>''
        ));
        ?>
        <br>
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><span class=' icon-info-sign'></span> "This Data will refresh every 5 minutes"</strong> 
        </div>
        <?php $this->widget('yiiwheels.widgets.grid.WhGridView', array(
            'id'=>"balanceGrid",
            'type'=>'striped bordered condensed',
            'dataProvider'=>$gridDataProvider,
            'template'=>"{summary}\n{items}\n{pager}",
            'columns'=>array(
                array(
                    'header'=>'Balance',
                    'type'=>'raw',
                    'value'=>'$data["balance"]',
                ),
                array(
                    'header'=>'Credit Used',
                    'type'=>'raw',
                    'value'=>'$data["total"]',
                ),
                array(
                    'header'=>'Total Calls Made',
                    'type'=>'raw',
                    'value'=>'$data["calls"]',
                ),
                array(
                    'header'=>'Diable Leads',
                    'type'=>'raw',
                    'value'=>'$data["leads"]',
                ),
                array(
                    'header'=>'5 PRESS',
                    'type'=>'raw',
                    'value'=>'$data["cxfer"]',
                ),
                // 'total',
                // 'balance',
                array(
                    'header'=>'Credit Used',
                    'type'=>'raw',
                    'value'=>'$data["hours"]',
                ),
                array(
                    'header'=>'Credit Used',
                    'type'=>'raw',
                    'value'=>'$data["minutes"]',
                ),
                array(
                    'header'=>'Credit Used',
                    'type'=>'raw',
                    'value'=>'$data["seconds"]',
                ),
                // 'calls',
                // 'generated',
                // 'ppminc',
                // 'leads',
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


