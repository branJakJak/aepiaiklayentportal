<?php 

/**
* ClientDashboardVariables
*/
class ClientDashboardVariables
{
	protected $listid;
	protected $leadsAndStatusDataProvider;
	protected $updatedInitBalance;
	function __construct($listid) {
		$this->listid = $listid;
	}
	public function getVars()
	{
		$clientDashboard = Yii::app()->askteriskDb->createCommand("select * from client_panel")->queryAll();
		$rawsecondsSqlCommandStr = <<<EOL
SELECT SUM(vicidial_log.length_in_sec)
  FROM asterisk.vicidial_log vicidial_log
 WHERE (vicidial_log.length_in_sec > 0) AND (vicidial_log.list_id = :list_id)
EOL;
		$rawSecondsCommandObj = Yii::app()->askteriskDb->createCommand($rawsecondsSqlCommandStr);
		$rawSecondsCommandObj->bindParam(":list_id" , $this->listid,PDO::PARAM_INT);
		$rawSeconds = $rawSecondsCommandObj->queryColumn();

		// $totalRawSeconds = $clientDashboard[0]['seconds'];
		// 
		$totalRawSeconds = intval($rawSeconds[0]);
		$ppminc = $clientDashboard[0]['ppminc'];
		$diallableLeads = $clientDashboard[0]['leads'];
		//look for the lead value
		foreach ($this->leadsAndStatusDataProvider->data as $key => $value) {
			if ($value['status'] === 'New Lead' || $value['status'] === 'New Leads') {
				$diallableLeads = $value['lead'];
			}
		}
		$totalExpended = ( $totalRawSeconds / 60 ) * doubleval($ppminc);
		$remainingBalance = $this->updatedInitBalance - $totalExpended;
		$hours = $totalRawSeconds / (60*60);
		$minutes = intval($totalRawSeconds / 60);
		$seconds = $totalRawSeconds % 60;
		$leads = BarryOptLog::getCountToday();

		
		return array(
				"totalRawSeconds"=>$totalRawSeconds,
				"ppminc"=>$ppminc,
				"diallableLeads"=>$diallableLeads,
				"totalExpended"=>$totalExpended,
				"remainingBalance"=>$remainingBalance,
				"hours"=>$hours,
				"minutes"=>$minutes,
				"seconds"=>$seconds,
				"leads" =>$leads
		);
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
}