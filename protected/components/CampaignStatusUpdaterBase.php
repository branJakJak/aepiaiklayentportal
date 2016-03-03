<?php 

/**
* CampaignStatusUpdaterBase
*/
class CampaignStatusUpdaterBase
{
	protected $campaign_name;
	protected $status;

	function __construct($campaign_name,$status) {
		$this->setCampaignName($campaign_name);
		$this->setStatus($status);
	}

	/**
	 * Retrieves campaign name 
	 *
	 * @return string campaign name
	 */
	public function getCampaignName() {
	    return $this->campaign_name;
	}
	
	/**
	 * Set the value of campaign name
	 *
	 * @param String $newcampaign_name Campaign name
	 */
	public function setCampaignName($campaign_name) {
	    $this->campaign_name = $campaign_name;
	    return $this;
	}

	/**
	 * gets status
	 *
	 * @return string retrieves status
	 */
	public function getStatus() {
	    return $this->status;
	}

	/**
	 * set status
	 *
	 * @param String $newstatus Retrieves status
	 */
	public function setStatus($status) {
	    $this->status = $status;

	    return $this;
	}

	public function updateStatus()
	{
		$message = sprintf(
				"Client %s wants to %s the %s campaign", 
				Yii::app()->params['client_name'],
				$this->status,
				$this->campaign_name
			);
		mail(Yii::app()->params['emailTo'],"Client query at client1.clientvbportal.ml",$message);
	}

}