<?php 

/**
* LastStatusUpdate
*/
class LastStatusUpdate extends CApplicationComponent
{
	public $defaultLastActionMessage = "No last action detected";
	public $logFile;
	public function init()
	{
		//last log file 
		$this->logFile = Yii::getPathOfAlias("application.data").DIRECTORY_SEPARATOR.'last_action_update';
		if (!file_exists($this->logFile)) {
			file_put_contents($this->logFile, $this->defaultLastActionMessage);
		}
	}
	public function write($newAction='')
	{
		file_put_contents($this->logFile, $newAction);
	}
	public function read()
	{
		return file_get_contents($this->logFile);
	}
}