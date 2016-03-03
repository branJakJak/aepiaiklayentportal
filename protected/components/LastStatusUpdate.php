<?php 

/**
* LastStatusUpdate
*/
class LastStatusUpdate extends CApplicationComponent
{
	public $defaultLastActionMessage = "No last action detected";
	public $logFile;
	public $logFileMap = array(
		"22920161"=>"PENSION1",
		"22920162"=>"Funeral1"
	);
	public function init()
	{
		//last log file 
		
		$tempFile1 = Yii::getPathOfAlias("application.data").DIRECTORY_SEPARATOR.'last_action_update_'.$this->logFileMap['22920161'];
		if (!file_exists($tempFile1)) {
			file_put_contents($tempFile1, $this->defaultLastActionMessage);
		}
		
		$tempFile2 = Yii::getPathOfAlias("application.data").DIRECTORY_SEPARATOR.'last_action_update_'.$this->logFileMap['22920162'];
		if (!file_exists($tempFile2)) {
			file_put_contents($tempFile2, $this->defaultLastActionMessage);
		}
	}
	public function write($keyFile,$newAction='')
	{
		$logFile = $this->logFileMap[$keyFile];
		file_put_contents($logFile, $newAction);
	}
	public function read($keyFile)
	{
		$logFile = $this->logFileMap[$keyFile];
		return file_get_contents($logFile);
	}
}