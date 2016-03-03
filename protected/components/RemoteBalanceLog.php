<?php 

/**
* RemoteBalanceLog
*/
class RemoteBalanceLog
{
	public function update($balance , $dateUpdated , $clientname)
	{
		/*update the balance using */
		$updateString = <<<EOL
		UPDATE asterisk.balance_client
		SET updated_date = :dateUpdated , balance = :balance
  		WHERE client_name = :clientname
EOL;
		$commandObj = Yii::app()->askteriskDb->createCommand($updateString);
		$commandObj->bindParam(":dateUpdated",$dateUpdated);
		$commandObj->bindParam(":balance",$balancem ,PDO::PARAM_STR);
		$commandObj->bindParam(":clientname",$clientname);
		$commandObj->execute();
		return true;
	}

}