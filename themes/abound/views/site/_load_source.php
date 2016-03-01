<?php echo CHtml::beginForm(array('/site/index'), 'GET',array('id'=>'quickFilterData')); ?>
    Load Source/Campaign<br>
    <?php echo CHtml::hiddenField('campaign_action', null, array('name'=>'campaign_action','id'=>'campaign_actionFld')); ?>
    <?php 
        echo CHtml::dropDownList('listid', @$_GET['listid'], array(
            "2262016"=>"Pension1",
            "22920162"=>"Funeral1",
        ), array('prompt'=>'Select Campaign','onchange'=>'submitFilterForm(this)','id'=>'currentSelectedCampaign','style'=>"float: left;")); ?>
    <br>
    <div class="btn-group" style="float: left;margin-left: 75px;margin-top: -25px;">
        <button onclick="confirmCampaignStatusUpdate('start')" type="button" class="btn btn-primary btn-large" value="start">Start</button>
        <button onclick="confirmCampaignStatusUpdate('stop')" type="button" class="btn btn-danger btn-large" value="stop">Stop</button>
    </div>
<?php echo CHtml::endForm(); ?>
