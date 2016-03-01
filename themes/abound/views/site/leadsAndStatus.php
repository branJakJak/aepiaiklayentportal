<?php
$this->beginWidget('zii.widgets.CPortlet', array(
    'title'=>'Leads and status : ' . $currentCampaignSelected,
));
?>
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
            /*'type'=>'striped bordered condensed',*/
            'htmlOptions'=>array('class'=>'table table-striped table-bordered table-condensed'),
            'dataProvider'=>$leadsAndStatusDataProvider,
            'template'=>"{items}",
            'columns'=>array(
                array('name'=>'status', 'header'=>'Status'),
                array('name'=>'lead', 'header'=>'Lead'),
            ),
        )); 
?>
<?php
    $this->endWidget();
?>
