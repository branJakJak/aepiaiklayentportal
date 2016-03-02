<?php 

/**
* RemoteBalanceLog
*/
class RemoteBalanceLog
{
	public function update($dateUpdated , $clientname)
	{
		$updateString = <<<EOL
UPDATE asterisk.balance_client
SET updated_date = ':dateUpdated'
  WHERE client_name = ':clientname'
EOL;
		$commandObj = Yii::app()->askteriskDb->createCommand($updateString);
		$commandObj->bindParam(":dateUpdated",$dateUpdated);
		$commandObj->bindParam(":clientname",$clientname);
		$commandObj->execute();
		return true;
	}

}