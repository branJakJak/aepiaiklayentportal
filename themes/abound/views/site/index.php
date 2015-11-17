<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;


$placeHolderDataGridView = new CArrayDataProvider(array(
    array('id'=>1, 'firstName'=>'Mark', 'lastName'=>'Otto', 'language'=>'CSS','usage'=>'<span class="inlinebar">1,3,4,5,3,5</span>'),
));

$gridDataProvider = new CArrayDataProvider($clientVb);

$fileUploadedDataProvider = new CArrayDataProvider($fileUploadedArr);


?>


<style type="text/css">
    .action-buttons {
        font-size: 31px;
        padding: 20px;
    }

</style>




<div class="row-fluid">
    <div class="span6">
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
                    'onComplete'=>"js:function(id, fileName, responseJSON){ $.fn.yiiGridView.update('gridview1') }",
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
    <div class="span6">
        <?php
        $this->widget('bootstrap.widgets.TbAlert', array(
            'fade'=>true,
            'closeText'=>'×',
            'alerts'=>array(
                'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
                'error'=>array('error'=>true, 'fade'=>true, 'closeText'=>'×'),
            ),
        )); ?>
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>'<span class="icon-picture"></span>Upload Files',
            'titleCssClass'=>''
        ));
        ?>
        <?php $this->widget('yiiwheels.widgets.grid.WhGridView', array(
            'id'=>'gridview1',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$fileUploadedDataProvider,
            'template'=>"{summary}\n{items}\n{pager}",
            'columns'=>array(
                array('name'=>'file_name', 'header'=>'Filename'),
                array(
                    'header'=>'',
                    'type'=>'raw',
                    'value'=>'CHtml::link("start", array("/send/start","fileName"=>$data["file_name"]))',
                ),
                array(
                    'header'=>'',
                    'type'=>'raw',
                    'value'=>'CHtml::link("stop", array("/send/stop","fileName"=>$data["file_name"]))',
                ),
            ),
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


