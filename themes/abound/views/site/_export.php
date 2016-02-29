<?php if (Yii::app()->user->checkAccess('administrator') || Yii::app()->user->checkAccess('client')): ?>
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