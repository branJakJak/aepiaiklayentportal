<?php 

/**
* RemoteViciBalance
*/
class RemoteViciBalance
{
	protected $currentBalance;
	protected $clientname;

	function __construct($clientname) {
		$this->clientname = $clientname;
		// initialize the value of current balance
		// Yii::app()->askteriskDb->createCommand("")
	}

	/**
	 * Updates the current balance to vici remote
	 * @return boolean Whether the action completed or not
	 */
	public function updateBalance()
	{
		//@TOdo - implement code here
	}

	/**
	 * Retrieves current balance
	 *
	 * @return integer currentBalance
	 */
	public function getCurrentBalance() {
	    return $this->currentBalance;
	}
	
	/**
	 * Sets new value for currentBalance
	 *
	 * @param Integer $newcurrentBalance CurrentBalance
	 */
	public function setCurrentBalance($currentBalance) {
	    $this->currentBalance = $currentBalance;
	
	    return $this;
	}

	/**
	 * Retrieves the clientname
	 *
	 * @return string the client name
	 */
	public function getClientname() {
	    return $this->clientname;
	}
	
	/**
	 * sets the clientname
	 *
	 * @param String $newclientname The client name
	 */
	public function setClientname($clientname) {
	    $this->clientname = $clientname;
	
	    return $this;
	}


}