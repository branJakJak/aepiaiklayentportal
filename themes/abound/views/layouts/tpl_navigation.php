<?php 
$role = Yii::app()->authManager->getRoles(Yii::app()->user->id);
$isFacilitator = false;
$currentRoleName = "";
foreach ($role as $key => $value) {
  if ($value->name === "facilitator") {
    $isFacilitator = true;
  }
}


?>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <?php echo CHtml::link(Yii::app()->name, array('/site/index'), array('class'=>'brand')); ?>
          <div class="nav-collapse">
			<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					           'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'Home', 'url'=>array('/site/index')),
                        array('label'=>'Balance', 'url'=>array('/balance/create'), 'visible'=>$isFacilitator && !Yii::app()->user->isGuest ),
                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    ),
                )); ?>
    	</div>
    </div>
	</div>
</div>

<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
    	<div class="container">
        
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->