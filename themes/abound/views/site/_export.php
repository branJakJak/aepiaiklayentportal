<?php if (Yii::app()->user->checkAccess('administrator') || Yii::app()->user->checkAccess('client')): ?>
    <?php if (isset($_GET['listid'])): ?>
    <h5>
        <span class="icon-download"></span>
        <?php
            echo CHtml::link("Export Data <span class='label label-info'>".BarryOptLog::getCountAll(@$_GET['listid'])."</span>", array('/export/index','listid'=>@$_GET['listid']));
        ?>
    </h5>
    <?php endif ?>
    <hr>
    <?php if (isset($_GET['listid'])): ?>
    <h5>
        <span class="icon-calendar"></span>
            <?php
                echo CHtml::link("Export Today  <span class='label label-info'>".BarryOptLog::getCountToday(@$_GET['listid'])."</span>",  array('/export/today','listid'=>@$_GET['listid']));
            ?>
    </h5>
    <?php endif ?>
    <hr>
    <?php if (isset($_GET['listid'])): ?>
    <h5>
        <span class="icon-calendar"></span>
        <?php
            echo CHtml::link("Export Range", "#"  , array("onclick"=>'$("#exportModal").dialog("open"); return false;'));
        ?>
    </h5>
    <?php endif ?>
    <div class="clearfix"></div>
<?php endif; ?>
<?php if (Yii::app()->user->checkAccess('exporter')): ?>
    <?php if (isset($_GET['listid'])): ?>
    <h5>
        <span class="icon-calendar"></span>
        <?php
            echo CHtml::link("Export Today  <span class='label label-info'>".BarryOptLog::getCountToday()."</span>",  array('/export/today','listid'=>@$_GET['listid']));
        ?>
    </h5>
    <hr>
    <?php endif ?>
<?php endif ?>
