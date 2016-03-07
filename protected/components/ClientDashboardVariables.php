<?php 

/**
* ClientDashboardVariables
*/
class ClientDashboardVariables
{
	protected $listid;
	protected $leadsAndStatusDataProvider;
	protected $updatedInitBalance;
	protected $listIds;
	function __construct($listid) {
		$this->listid = $listid;
		$listIds = array();
	}
	public function getVars()
	{
		/*initialize variables*/
		$diallableLeads = 0;
		$ppminc = Yii::app()->params['ppminc'];

		$this->updatedInitBalance = $this->getClientBalance(Yii::app()->params['client_name']);
		$this->updatedInitBalance = doubleval($this->updatedInitBalance);

		//look for the lead value
		foreach ($this->leadsAndStatusDataProvider->data as $key => $value) {
			if ($value['status'] === 'New Lead' || $value['status'] === 'New Leads') {
				$diallableLeads = $value['lead'];
			}
		}

		$rawSeconds = $this->getRawSeconds();
		$totalRawSeconds = doubleval($rawSeconds);
		$totalExpended = ( $totalRawSeconds / 60 ) * doubleval($ppminc);

		/* Compute remaining balance*/

		// $remainingBalance = $this->updatedInitBalance - $totalExpended;
		$remainingBalance = $this->getRemainingBalance();


		$hours = $totalRawSeconds / (60*60);
		$minutes = intval($totalRawSeconds / 60);
		$seconds = $totalRawSeconds % 60;
		$leads = BarryOptLog::getCountToday(@$_GET['listid']);
		return array(
				"totalRawSeconds"=>$totalRawSeconds,
				"ppminc"=>$ppminc,
				"diallableLeads"=>$diallableLeads,
				"totalExpended"=>$totalExpended,
				"remainingBalance"=>$remainingBalance,
				"hours"=>$hours,
				"minutes"=>$minutes,
				"seconds"=>$seconds,
				"leads" =>$leads,
				"totalSecondsToday" =>$this->getTotalSecondsToday()
		);
	}

	public function getRemainingBalance()
	{
		// get listids
		$totalSeconds = 0;
		foreach ($this->listIds as $key => $currentListId) {
			$this->listid = $currentListId;
			$totalSecRaw = $this->getRawSeconds();
			$totalSeconds += doubleval($totalSecRaw);
		}
		$totalMinutes = $totalSeconds / 60;

		return ($this->updatedInitBalance - ($totalMinutes * Yii::app()->params['ppminc']));
	}
	/**
	 * Returns the current client balance
	 * @param  string $client_name name of the client
	 * @return double              the balance
	 */
	public function getClientBalance($client_name)
	{
		$rawGetClientBalanceQueryStr = <<<EOL
		SELECT balance FROM asterisk.balance_client WHERE client_name = :client_name
EOL;
		$rawGetClientBalanceQueryObj = Yii::app()->askteriskDb->createCommand($rawGetClientBalanceQueryStr);
		$rawGetClientBalanceQueryObj->bindParam(":client_name" , $client_name);
		$returnedRes = $rawGetClientBalanceQueryObj->queryColumn();
		return $returnedRes[0];
	}

	public function getRawSeconds()
	{
		$rawsecondsSqlCommandStr = <<<EOL
SELECT SUM(vicidial_log.length_in_sec) as 'seconds'
  FROM asterisk.vicidial_log vicidial_log
 WHERE (vicidial_log.length_in_sec > 0) AND (vicidial_log.list_id = :list_id)
EOL;
		$rawSecondsCommandObj = Yii::app()->askteriskDb->createCommand($rawsecondsSqlCommandStr);
		$rawSecondsCommandObj->bindParam(":list_id" , $this->listid,PDO::PARAM_INT);
		$rowRes = $rawSecondsCommandObj->queryRow();
		$rawSeconds = $rowRes['seconds'];
		return intval($rawSeconds);

// 		$client_name = Yii::app()->params['client_name'];
// 		$rawsecondsSqlCommandStr = <<<EOL
// 		select 
// 		sum(vicidial_log.length_in_sec) AS seconds,
// 		vicidial_log.call_date AS from_last_updated,
// 		vicidial_campaigns.client_name AS client_name 
// 		from ((balance_client balance_client_1 join 
// 		(vicidial_campaigns join balance_client on((vicidial_campaigns.client_name = :client_name)))) join vicidial_log on((vicidial_log.campaign_id = vicidial_campaigns.campaign_id))) where ((vicidial_log.length_in_sec > 0) and (vicidial_log.call_date >= balance_client.updated_date)) group by vicidial_campaigns.client_name;
// EOL;
// 		$rawSecondsCommandObj = Yii::app()->askteriskDb->createCommand($rawsecondsSqlCommandStr);
// 		$rawSecondsCommandObj->bindParam(":client_name" , $client_name);
// 		$tempRawSecondsContainer = $rawSecondsCommandObj->queryRow();
// 		$tempRawSecondsContainer = @$tempRawSecondsContainer['seconds'];
// 		$tempRawSecondsContainer = doubleval($tempRawSecondsContainer);
// 		return $tempRawSecondsContainer;
	}

	/**
	 * get leadsAndStatusDataProvider
	 *
	 * @return mixed retrieves leadsAndStatusDataProvider
	 */
	public function getLeadsAndStatusDataProvider() {
	    return $this->leadsAndStatusDataProvider;
	}
	
	/**
	 * sets leadsAndStatusDataProvider value
	 *
	 * @param mixed $newleadsAndStatusDataProvider Retrieves leadsAndStatusDataProvider
	 */
	public function setLeadsAndStatusDataProvider($leadsAndStatusDataProvider) {
	    $this->leadsAndStatusDataProvider = $leadsAndStatusDataProvider;
	    return $this;
	}

	/**
	 * gets updatedInitBalance
	 *
	 * @return mixed gets updatedInitBalance
	 */
	public function getUpdatedInitBalance() {
	    return $this->updatedInitBalance;
	}
	
	/**
	 * sets updatedInitBalance
	 *
	 * @param Mixed $newupdatedInitBalance Gets updatedInitBalance
	 */
	public function setUpdatedInitBalance($updatedInitBalance) {
	    $this->updatedInitBalance = $updatedInitBalance;
	    return $this;
	}

	/**
	 * retrieves listid
	 *
	 * @return mixed listid
	 */
	public function getListid() {
	    return $this->listid;
	}
	
	/**
	 * sets the listid
	 *
	 * @param [type] $newlistid Listid
	 */
	public function setListid($listid) {
	    $this->listid = $listid;
	
	    return $this;
	}


	/**
	 * Get list ids
	 *
	 * @return array listids
	 */
	public function getListIds() {
	    return $this->listIds;
	}
	
	/**
	 * set list ids
	 *
	 * @param Array $newlistIds Listids
	 */
	public function setListIds($listIds) {
	    $this->listIds = $listIds;
	    return $this;
	}
	public function getTotalSecondsToday()
	{
		$sqlCommand = <<<EOL
SELECT SUM(vicidial_log.length_in_sec) as 'seconds',
       vicidial_campaigns.client_name,
       vicidial_log.call_date
  FROM asterisk.vicidial_log vicidial_log
       INNER JOIN asterisk.vicidial_campaigns vicidial_campaigns
          ON (vicidial_log.campaign_id = vicidial_campaigns.campaign_id)
 WHERE     (vicidial_log.length_in_sec > 0)
       AND (vicidial_campaigns.client_name = :client_name)
       AND (vicidial_log.call_date >= CURDATE())
EOL;
		$rawSecondsCommandObj = Yii::app()->askteriskDb->createCommand($sqlCommand);
		$rawSecondsCommandObj->bindParam(":client_name" , Yii::app()->params['client_name']);
		$rowRes = $rawSecondsCommandObj->queryRow();
		$rawSeconds = $rowRes['seconds'];
		return intval($rawSeconds);	
	}

}