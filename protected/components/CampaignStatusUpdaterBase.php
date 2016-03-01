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
		// $url = "https://162.250.124.167/vicidial/non_agent_api.php?";
		$url = "https://216.158.235.129/stick/non_agent_api.php?";
		$httpParams = array(
			"function"=>"toggle_campaign",
			"source"=>"CAMPUPDATE",
			"user"=>"admin",
			"pass"=>"Mad4itNOW",
			"camp"=>$this->getCampaignName(),
			"activate"=>$this->getStatus(),
		);
		$curlURL = $url.http_build_query($httpParams);
		$curlres = curl_init($curlURL);
		curl_setopt($curlres, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlres, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curlres, CURLOPT_SSL_VERIFYPEER, false);
		$curlResRaw = curl_exec($curlres);
		Yii::log($curlResRaw, CLogger::LEVEL_INFO,'info');
	}

}