<?php 


/**
* ActivateCampaign
*/
class ActivateCampaign extends CampaignStatusUpdaterBase
{
	function __construct($campaignName) {
		parent::__construct($campaignName,"start");
	}

}