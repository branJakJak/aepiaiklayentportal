<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;


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
    #balanceGrid > table > tbody > tr > td{
        text-align: center;
    }
</style>

<?php 
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
        'id'=>'exportModal',
        'options'=>array(
            'title'=>'Export Range',
            'autoOpen'=>false,
            'modal'=>true,
        ),
    ));
    echo $this->renderPartial('_export_range', compact('exportModel'),true);
    $this->endWidget('zii.widgets.jui.CJuiDialog');
?>



<div class="row-fluid">
    <div class="span2 offset1">
        <?php if (Yii::app()->user->checkAccess('administrator') || Yii::app()->user->checkAccess('client')): ?>
            <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title' => '<span class=" icon-wrench"></span>Admin Action',
                'titleCssClass' => '',
                'htmlOptions' => array('style'=>'text-align: left;padding-left: 20px;')
            ));
            ?>
            <h5>
                <span class="icon-download"></span>
                <?php
                    echo CHtml::link("Export Data <span class='label label-info'>".BarryOptLog::getCountAll()."</span>", array('/export'));
                ?>
            </h5>
            <hr>
            <h5>
                <span class="icon-calendar"></span>
                <?php
                    echo CHtml::link("Export Today  <span class='label label-info'>".BarryOptLog::getCountToday()."</span>",  array('/export/today'));
                ?>
            </h5>
            <hr>
            
            <h5>
                <span class="icon-calendar"></span>
                <?php
                    echo CHtml::link("Export Range", "#"  , array("onclick"=>'$("#exportModal").dialog("open"); return false;'));
                ?>
            </h5>


            <?php if (Yii::app()->user->checkAccess('administrator')): ?>
                <hr>
                <h5>
                    <span class="icon-remove"></span>
                    <?php
                        echo CHtml::link("Clear Data", array('/clearData'), array('confirm'=>"Are you sure you want to clear the data ?"));
                    ?>
                </h5>                
            <?php endif ?>

            <?php $this->endWidget(); ?>
            <div class="clearfix"></div>
        <?php endif; ?>
        <?php if (Yii::app()->user->checkAccess('exporter')): ?>
            <h5>
                <span class="icon-calendar"></span>
                <?php
                    echo CHtml::link("Export Today  <span class='label label-info'>".BarryOptLog::getCountToday()."</span>",  array('/export/today'));
                ?>
            </h5>
            <hr>
        <?php endif ?>
    </div>

    <div class="span8" >



        <?php
        $this->widget('bootstrap.widgets.TbAlert', array(
            'fade' => true, // use transitions?
            'closeText' => '×', // close link text - if set to false, no close link is displayed
            'alerts' => array( // configurations per alert type
                'success' => array('block' => true, 'fade' => true, 'closeText' => '×'),
                'error' => array('block' => true, 'fade' => true, 'closeText' => '×'),
            ),
        )); ?>    
        <?php if (!Yii::app()->user->checkAccess('exporter')): ?>
        <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title' => '<span class="icon-picture"></span>Request Form',
                'titleCssClass' => ''
            ));
        ?>
        <?php echo CHtml::beginForm(array('/site/clientRequest'), 'POST',array('class'=>'well')); ?>
            <h1>Request Form</h1>
            <hr>
            <?php echo CHtml::hiddenField('clientUpload', 'clientUpload'); ?>
            <?php echo CHtml::hiddenField('fileName', null, array('id'=>'fileName')); ?>
            <label>Upload the mobile numbers</label>
            <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                array(
                    'id' => 'uploadFile',
                    'config' => array(
                        'template' => '<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',
                        'action' => Yii::app()->createUrl('site/upload'),
                        'allowedExtensions' => array("csv",'txt', 'xlsx', 'xls'),
                        //array("jpg","jpeg","gif","exe","mov" and etc...
                        'sizeLimit' => 10 * 1024 * 1024,
                        // maximum file size in bytes
                        'onComplete' => "js:
                            function(id, fileName, responseJSON){ 
                                document.getElementById('fileName').value = fileName;
                            }
                        ",
                        'messages' => array(
                            'typeError' => "{file} has invalid extension. Only {extensions} are allowed.",
                            'sizeError' => "{file} is too large, maximum file size is {sizeLimit}.",
                            'minSizeError' => "{file} is too small, minimum file size is {minSizeLimit}.",
                            'emptyError' => "{file} is empty, please select files again without it.",
                            'onLeave' => "The files are being uploaded, if you leave now the upload will be cancelled."
                        ),
                        // 'showMessage' => "js:function(message){ alert(message);}"
                    )
                )); 
            ?>
            <label>Select sound file : </label>
            <?php 
            
                echo CHtml::dropDownList('soundFileName', null, array(
                    'Boiler'=>'Boiler',
                    'Car_Finance'=>'Car Finance',
                    'Debt_3000'=>'Debt - 3000',
                    'Debt_5000'=>'Debt - 5000',
                    'FlightDelay'=>'Flight Delay',
                    'Funeral'=>'Funeral',
                    'PBA'=>'PBA',
                    'PI'=>'PI',
                    'MISSOLD_PENSION'=>'Missold Pension',
                    'ECO'=>'Eco',
                ), array('id'=>'soundFileName','prompt'=>'Please select a sound file')); 
            ?>
            <button type='button' onclick='playSoundFile(this);' style="margin-top: -10px;">
                <span id="playIcon" class='icon icon-play'></span>
            </button>
            <button type='button' onclick='stopAllSoundFile(this);' style="margin-top: -10px;">
                <span class='icon icon-stop'></span>
            </button>
            <br>
            <button type="submit" class="btn btn-primary btn-large">Submit</button>
        <?php echo CHtml::endForm(); ?>
        
        <?php $this->endWidget(); ?>


        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => '<span class="icon-user"></span>Client VB',
            'titleCssClass' => ''
        ));
        ?>
        <br>
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><span class=' icon-info-sign'></span> "This Data will refresh every 5 minutes"</strong>
        </div>

        <?php $this->widget('yiiwheels.widgets.grid.WhGridView', array(
            'id' => "balanceGrid",
            'type' => 'striped bordered condensed',
            'dataProvider' => $gridDataProvider,
            'template' => "{summary}\n{items}\n{pager}",
            'columns' => array(
                array(
                    'header' => 'Balance',
                    'type' => 'raw',
                    'value' => '$data["balance"]',
                ),
                array(
                    'header' => 'Credit Used',
                    'type' => 'raw',
                    'value' => '$data["total"]',
                ),
                // array(
                //     'header' => 'Total Calls Made',
                //     'type' => 'raw',
                //     'value' => '$data["calls"]',
                // ),
                array(
                    'header' => 'Dialable Leads',
                    'type' => 'raw',
                    'value' => '$data["leads"]',
                ),

                array(
                    'header' => '5 PRESS',
                    'type' => 'raw',
                    'value' => '$data["cxfer"]',
                ),
                // 'total',
                // 'balance',
                // 'clientj_sec_count',
                // array(
                //     'header'=>'Hours',
                //     'type'=>'raw',
                //     'value'=>'$data["hours"]',
                // ),
                array(
                    'header'=>'Total Minutes',
                    'type'=>'raw',
                    'value'=>'$data["minutes"]',
                ),
                // array(
                //     'header'=>'Seconds',
                //     'type'=>'raw',
                //     'value'=>'$data["seconds"]',
                // ),
                // array(
                //     'header' => 'Total in Seconds',
                //     'type' => 'raw',
                //     'value' => '$data["raw_seconds"]',
                // ),
                // array(
                //     'header' => 'Rate',
                //     'type' => 'raw',
                //     'value' => '$data["ppminc"]',
                // ),
                // 'ppminc',
                // 'raw_seconds',
                // 'calls',
                // 'generated',
                // 'leads',
            ),
        )); ?>
        <?php $this->endWidget(); ?>
        <?php endif ?>
    </div>
    <hr>
    <div class="row-fluid">
        <?php if (!Yii::app()->user->checkAccess('exporter')): ?>
            <div class="span4 offset3">
                <?php echo CHtml::link('Start', array('/campaigns/activate'),
                    array('class' => 'btn btn-primary btn-block action-buttons')); ?>
            </div>
            <div class="span4">
                <?php echo CHtml::link('Stop', array('/campaigns/deactivate'),
                    array('class' => 'btn btn-danger btn-block action-buttons')); ?>
            </div>
        <?php endif ?>
    </div>
    <br>
    <div class="row-fluid">
        <?php if (!Yii::app()->user->checkAccess('exporter')): ?>
        <div class="offset3 span8">
            <?php
                $this->beginWidget('zii.widgets.CPortlet', array(
                    'title'=>'Leads and Status',
                ));
            ?>

            <?php echo CHtml::beginForm(array('/site/index'), 'GET',array('id'=>'quickFilterData')); ?>
                Load Source : 
                <?php 
                    echo CHtml::dropDownList('listid', @$_GET['listid'], array(
                    ), array('onchange'=>'submitFilterForm(this)')); ?>
            <?php echo CHtml::endForm(); ?>


            <?php 
                $this->widget('zii.widgets.grid.CGridView', array(
                        /*'type'=>'striped bordered condensed',*/
                        'htmlOptions'=>array('class'=>'table table-striped table-bordered table-condensed'),
                        'dataProvider'=>$leadsAndStatusDataProvider,
                        'template'=>"{items}",
                        'columns'=>array(
                            array('name'=>'status', 'header'=>'Status'),
                            array('name'=>'lead', 'header'=>'lead'),
                        ),
                    )); 
            ?>
            <?php
                $this->endWidget();
            ?>
            <hr>
            <?php
                $this->beginWidget('zii.widgets.CPortlet', array(
                    'title'=>'Chart',
                ));
            ?>
            <?php
                $this->widget(
                    'yiiwheels.widgets.highcharts.WhHighCharts',
                    array(
                        'pluginOptions' => array(
                                "chart"=>array(
                                        "type"=>'pie'
                                    ),
                                "title"=>"Leads and status report",
                                "pie"=>array(
                                        "allowPointSelect"=>true,
                                        "cursor"=>'pointer',
                                        "dataLabels"=>array(
                                                'enabled'=> false,
                                                // 'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
                                                // 'style'=> array(
                                                //     'color'=> "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'"
                                                // )                               
                                            ),
                                        "showInLegend"=>true
                                    ),
                                "series"=>array(
                                        array(
                                                "Name"=>"Brands",
                                                "colorByPoint"=>true,
                                                "data"=>$chartDataProvider
                                            )
                                    )
                            ),
                    )
                );
            ?>    
            <?php
                $this->endWidget();
            ?>
        <?php endif ?>
        </div>
    </div>
</div>

<?php 
    $baseUrl = Yii::app()->theme->baseUrl; 
?>
<audio id="Boiler">
  <source src="<?php echo $baseUrl ?>/recordings/Boiler.WAV" type="audio/ogg">
</audio>
<audio id="Car_Finance">
<source src="<?php echo $baseUrl ?>/recordings/CarFinance1.mp3" type="audio/ogg">
</audio>
<audio id="Debt_3000">
<source src="<?php echo $baseUrl ?>/recordings/Debt_3000.wav" type="audio/ogg">
</audio>
<audio id="Debt_5000">
<source src="<?php echo $baseUrl ?>/recordings/Debt_5000.mp3" type="audio/ogg">
</audio>
<audio id="FlightDelay">
<source src="<?php echo $baseUrl ?>/recordings/FlightDelay.mp3" type="audio/ogg">
</audio>
<audio id="Funeral">
<source src="<?php echo $baseUrl ?>/recordings/Funeral.mp3" type="audio/ogg">
</audio>
<audio id="PBA">
<source src="<?php echo $baseUrl ?>/recordings/PBA.mp3" type="audio/ogg">
</audio>
<audio id="PI">
<source src="<?php echo $baseUrl ?>/recordings/Pi.mp3" type="audio/ogg">
</audio>
<audio id="MISSOLD_PENSION">
<source src="<?php echo $baseUrl ?>/recordings/MISSOLD_PENSION.wav" type="audio/ogg">
</audio>
<audio id="ECO">
<source src="<?php echo $baseUrl ?>/recordings/ECO.WAV" type="audio/ogg">
</audio>


<script type="text/javascript">
    window.previousAudio= null;
    function playSoundFile (currentDomeObject) {
        var soundFileSelected = document.getElementById("soundFileName").value;
        var audioSelected = document.getElementById(soundFileSelected);
        console.log("playng");
        console.log(audioSelected);
        if (window.previousAudio !== null) {
            window.previousAudio.currentTime = 0;
            window.previousAudio.pause();
        }
        if (audioSelected) {
            audioSelected.currentTime = 0;
            audioSelected.play();
        }else{
            console.log("No sound file selected or can't find the sound file.");
        }
        window.previousAudio = audioSelected;
    }
    function stopAllSoundFile (currentDomObject) {
        console.log("stopping");
        console.log(window.previousAudio);
        window.previousAudio.currentTime = 0;
        window.previousAudio.pause();
    }
    function submitFilterForm (dom) {
        document.getElementById("quickFilterData").submit();
    }
</script>
