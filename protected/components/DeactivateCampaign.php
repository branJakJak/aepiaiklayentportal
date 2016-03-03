<?php 

/**
* DeactivateCampaign
*/
class DeactivateCampaign extends CampaignStatusUpdaterBase
{

	function __construct($campaignName) {
		parent::__construct($campaignName,"stop");
	}

}