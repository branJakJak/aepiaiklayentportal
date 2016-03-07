<?php 
//get cookie here
$listIds = array(
        "22920161",
        "22920162",
        "3720161",
    );
$allMessage  = "";
foreach ($listIds as $key => $currentId) {
    $tempContainer = @Yii::app()->lastStatusUpdate->read($currentId);
    if (isset($tempContainer) && strpos($tempContainer, 'deactivated') !== FALSE) {
        $allMessage .= $tempContainer . "<br>";
    }
}
?>
<?php echo CHtml::beginForm(array('/site/index'), 'GET',array('id'=>'quickFilterData')); ?>
    <div class="span6">
        Load Source/Campaign<br>
        <?php echo CHtml::hiddenField('campaign_action', null, array('name'=>'campaign_action','id'=>'campaign_actionFld')); ?>
        <?php 
            echo CHtml::dropDownList('listid', @$_GET['listid'], array(
                "22920161"=>"Pension1",
                "22920162"=>"Funeral1",
                "372016"=>"CARFINANCE TEST CAMPAIGN",
                "3720161"=>"HCCRO",
            ), array('prompt'=>'Select Campaign','onchange'=>'submitFilterForm(this)','id'=>'currentSelectedCampaign','style'=>"float: left;")); ?>
            <div class="clearfix"></div>

            <?php if (!empty($allMessage)): ?>
            <div class="alert alert-success" style="width: 169px">
                <strong>Success!</strong> <br>
                <?php echo $allMessage ?>
            </div>
            <?php endif ?>

    </div>    
    <div class="span6">
        <div class="span6">
            <div class="" style="margin-top: 20px;">
                <button onclick="confirmCampaignStatusUpdate('start')" type="button" class="btn btn-primary btn-large" value="start" style="width: 106px;">Start</button>
                <br>
                <br>
                <button onclick="confirmCampaignStatusUpdate('stop')" type="button" class="btn btn-danger btn-large" value="stop" style="width: 106px;">Stop</button>
            </div>
        </div>
        <div class="span6" style="text-align:center">
            <h4>
                <small>Credit Used Today</small> <br>
                <?php 
                    $ppminc = doubleval(Yii::app()->params['ppminc']);
                    $creditUsedToday = ( ($totalSecondsToday / 60) *  $ppminc );
                    $creditUsedToday = intval($creditUsedToday);
                    echo $creditUsedToday;
                ?>
            </h4>
            
        </div>

    </div>
    <div class="clearfix"></div>
<?php echo CHtml::endForm(); ?>
