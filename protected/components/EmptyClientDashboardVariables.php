<?php 

/**
* EmptyClientDashboardVariables
*/
class EmptyClientDashboardVariables
{
	protected $listIds;
	protected $listid;
	protected $updatedInitBalance;
	public function getVars()
	{
		$clientDashboardVars = array(
				"totalRawSeconds"=>"0",
				"ppminc"=>"0",
				"diallableLeads"=>"0",
				"totalExpended"=>"0",
				"remainingBalance"=>"0",
				"hours"=>"0",
				"minutes"=>"0",
				"seconds"=>"0",
				"leads" =>"0",
				"totalSecondsToday" =>"0",
			);

		$this->updatedInitBalance = $this->getClientBalance(Yii::app()->params['client_name']);
		$this->updatedInitBalance = doubleval($this->updatedInitBalance);

		$clientDashboardVars['remainingBalance'] = $this->getRemainingBalance();
		$clientDashboardVars['totalSecondsToday'] = $this->getTotalSecondsToday();
		return $clientDashboardVars;
	}
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
	public function getRemainingBalance()
	{
		// get listids
		$totalSeconds = 0;
		// foreach ($this->listIds as $key => $currentListId) {
		// 	$this->listid = $currentListId;
		// 	$totalSecRaw = $this->getRawSeconds();
		// 	$totalSeconds += doubleval($totalSecRaw);
		// }
		$totalSeconds = $this->getTotalSecondsToday();
		$totalMinutes = $totalSeconds / 60;
		return ($this->updatedInitBalance - ($totalMinutes * Yii::app()->params['ppminc']));
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
	 * gets listIds
	 *
	 * @return array gets listIds
	 */
	public function getListIds() {
	    return $this->listIds;
	}
	
	/**
	 * sets listIds
	 *
	 * @param Array $newlistIds  gets listIds
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
		$clientName = Yii::app()->params['client_name'];
		$rawSecondsCommandObj->bindParam(":client_name" , $clientName);
		$rowRes = $rawSecondsCommandObj->queryRow();
		$rawSeconds = $rowRes['seconds'];
		return intval($rawSeconds);	
	}
}