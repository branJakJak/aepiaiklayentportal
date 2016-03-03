<?php 
//get cookie here
$lastMessage1 = @Yii::app()->lastStatusUpdate->read("22920161");
$lastMessage2 = @Yii::app()->lastStatusUpdate->read("22920162");


?>
<?php echo CHtml::beginForm(array('/site/index'), 'GET',array('id'=>'quickFilterData')); ?>
    <div class="span6">
        Load Source/Campaign<br>
        <?php echo CHtml::hiddenField('campaign_action', null, array('name'=>'campaign_action','id'=>'campaign_actionFld')); ?>
        <?php 
            echo CHtml::dropDownList('listid', @$_GET['listid'], array(
                "22920161"=>"Pension1",
                "22920162"=>"Funeral1",
            ), array('prompt'=>'Select Campaign','onchange'=>'submitFilterForm(this)','id'=>'currentSelectedCampaign','style'=>"float: left;")); ?>
            <div class="clearfix"></div>

            <?php if (  (isset( $lastMessage ) && strpos($lastMessage, 'deactivated') || (isset( $lastMessage2 ) && strpos($lastMessage2, 'deactivated') ) === FALSE) ): ?>
            <div class="alert alert-success" style="width: 169px">
                <strong>Success!</strong> <br>
                <?php echo $lastMessage ?> <br>
                <?php echo $lastMessage2 ?> <br>
            </div>
            <?php endif ?>

    </div>    
    <div class="span6">
        <div class="" style="margin-top: 20px;">
            <button onclick="confirmCampaignStatusUpdate('start')" type="button" class="btn btn-primary btn-large" value="start" style="width: 106px;">Start</button>
            <br>
            <br>
            <button onclick="confirmCampaignStatusUpdate('stop')" type="button" class="btn btn-danger btn-large" value="stop" style="width: 106px;">Stop</button>
        </div>
    </div>
    <div class="clearfix"></div>
<?php echo CHtml::endForm(); ?>
