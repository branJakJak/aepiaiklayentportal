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
    #content > div > div.span8 > div.row-fluid > div > h3 > small{
        font-size: 25px;
    }
    #content > div > div.span8 > div.row-fluid > div:nth-child(4){
        /*margin-left: 109px;*/
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

            <?php if (Yii::app()->user->checkAccess('administrator')): ?>
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
                    'Boiler'=>'HCCRO',
                    'Car_Finance'=>'Car Finance',
                    'Debt_3000'=>'Debt - 3000',
                    'Debt_5000'=>'Debt - 5000',
                    'FlightDelay'=>'Flight Delay',
                    'Funeral'=>'Funeral',
                    'PBA'=>'PBA',
                    'PI'=>'PI',
                    'MISSOLD_PENSION'=>'Mis-Sold Pension',
                    // 'ECO'=>'Eco',
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

        <div class="row-fluid">
            <?php
                $this->beginWidget('zii.widgets.CPortlet', array(
                    'title'=>'Leads and status :' . $currentCampaignSelected,
                ));
            ?>
            <?php 
                $this->renderPartial('leadsAndStatus', array('leadsAndStatusDataProvider'=>$leadsAndStatusDataProvider));
            ?>
            <?php
                $this->endWidget();
            ?>
        </div>


        <div class="row-fluid">
            <div class="span4 well text-center">
                <h3>
                    <img src="//icons.iconarchive.com/icons/graphicloads/100-flat/48/phone-call-icon.png"><br>
                    Diallable Leads
                    <hr>
                    <small>
                        <?php echo rand(0, 5000) ?>
                    </small>
                </h3>
            </div>
            <div class="span4 well text-center">
                <h3>
                    <img src="//icons.iconarchive.com/icons/uiconstock/e-commerce/48/credit-card-icon.png"> <br>
                    Credit Used
                    <hr>
                    <small>
                        <?php echo rand(0, 5000) ?>
                    </small>
                </h3>
            </div>
            <div class="span4 well text-center">
                <h3>
                    <img src="//icons.iconarchive.com/icons/paomedia/small-n-flat/48/money-icon.png"> <br>
                    Balance
                    <hr>
                    <small>
                        <?php echo rand(0, 5000) ?>
                    </small>
                </h3>
            </div>
            <div class="span4 well text-center">
                <h3>
                    <img src="//icons.iconarchive.com/icons/graphicloads/colorful-long-shadow/48/Check-2-icon.png"> <br>
                    5 Press
                    <hr>
                    <small>
                        <?php echo rand(0, 5000) ?>
                    </small>
                </h3>
            </div>
            <div class="span4 well text-center">
                <h3>
                    <img src="//icons.iconarchive.com/icons/graphicloads/flat-finance/48/time-icon.png"> <br>
                    Total Minutes
                    <hr>
                    <small>
                        <?php echo rand(0, 5000) ?>
                    </small>
                </h3>
            </div>
        </div><!-- end of row-fluid -->
        <?php endif ?>
    </div>
    <hr>
    <div class="row-fluid hidden">
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
                    'title'=>'Export and Status',
                ));
            ?>
            
            <div class="span8" style="padding: 22px;">
                <?php echo CHtml::beginForm(array('/site/index'), 'GET',array('id'=>'quickFilterData')); ?>
                    Load Source/Campaign<br>
                    <?php 
                        echo CHtml::dropDownList('listid', @$_GET['listid'], array(
                            "2262016"=>"Pension1",
                            "22920162"=>"Funeral1",
                        ), array('prompt'=>'Select Campaign','onchange'=>'submitFilterForm(this)')); ?>
                    <br>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary btn-large" name="campaign_action" value="start">Start</button>
                        <button type="submit" class="btn btn-danger btn-large" name="campaign_action" value="stop">Stop</button>
                    </div>
                <?php echo CHtml::endForm(); ?>
            </div>
            <div class="span4">
                <?php $this->renderPartial('_export', array()); ?>
            </div>
            <div class="clearfix"></div>
            <br>

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
                echo $this->renderPartial('_chart', array('chartDataProvider'=>$chartDataProvider),true);
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
<source src="<?php echo $baseUrl ?>/recordings/CarFinance1.mp3" type="audio/mp3">
</audio>
<audio id="Debt_3000">
<source src="<?php echo $baseUrl ?>/recordings/Debt_3000.WAV" type="audio/ogg">
</audio>
<audio id="Debt_5000">
<source src="<?php echo $baseUrl ?>/recordings/Debt_5000.mp3" type="audio/mp3">
</audio>
<audio id="FlightDelay">
<source src="<?php echo $baseUrl ?>/recordings/FlightDelay.mp3" type="audio/mp3">
</audio>
<audio id="Funeral">
<source src="<?php echo $baseUrl ?>/recordings/Funeral.mp3" type="audio/mp3">
</audio>
<audio id="PBA">
<source src="<?php echo $baseUrl ?>/recordings/PBA.mp3" type="audio/mp3">
</audio>
<audio id="PI">
<source src="<?php echo $baseUrl ?>/recordings/Pi.mp3" type="audio/mp3">
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
