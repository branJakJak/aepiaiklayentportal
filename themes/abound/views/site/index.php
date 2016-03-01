<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;




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
    <div class="span3">
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
            $this->renderPartial('_request_form', array());
        ?>


        <div class="row-fluid">
            <?php if (!Yii::app()->user->checkAccess('exporter')): ?>
                <div class="">
                    <?php
                        $this->beginWidget('zii.widgets.CPortlet', array(
                            'title'=>'Export and Status',
                        ));
                    ?>
                            <div class="span8" style="padding: 22px;">
                                <?php 
                                    $this->renderPartial('_load_source', array());
                                ?>
                            </div>
                            <div class="span4">
                                <?php $this->renderPartial('_export', array()); ?>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                    <?php
                        $this->endWidget();
                    ?>
            <?php endif ?>
            </div>
        </div>




        <div class="row-fluid">
            <?php 
                $this->renderPartial('_client_dash', compact(
                        "totalRawSeconds",
                        "ppminc",
                        "totalExpended",
                        "remainingBalance",
                        "hours",
                        "minutes",
                        "seconds",
                        "leads",
                        'diallableLeads'                            
                    ));
            ?>
        </div><!-- end of row-fluid -->

        <div class="row-fluid">
            <?php 
                $this->renderPartial('leadsAndStatus', compact('leadsAndStatusDataProvider','currentCampaignSelected'));
            ?>
        </div>

        <div class="row-fluid">
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
        </div>

        <?php endif ?>
    </div>
    <hr>


    <!-- imma ninja -->
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
    <!-- end of ninja -->
    <br>
</div>

<?php 
    $baseUrl = Yii::app()->theme->baseUrl; 
?>
<audio id="Boiler">
  <source src="<?php echo $baseUrl ?>/recordings/Boiler.wav" type="audio/ogg">
</audio>
<audio id="Car_Finance">
<source src="<?php echo $baseUrl ?>/recordings/CarFinance1.mp3" type="audio/mp3">
</audio>
<audio id="Debt_3000">
<source src="<?php echo $baseUrl ?>/recordings/Debt_3000.wav" type="audio/ogg">
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
<source src="<?php echo $baseUrl ?>/recordings/ECO.wav" type="audio/ogg">
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
    function confirmCampaignStatusUpdate (status) {
        var campaignSelected = document.getElementById("currentSelectedCampaign");
        campaignSelected = campaignSelected.options[campaignSelected.selectedIndex].innerHTML;
        document.getElementById("campaign_actionFld").value=status;
        if (confirm("Are you sure you want to "+status+ " " +campaignSelected)) {
            document.getElementById("quickFilterData").submit();
        }
    }
</script>