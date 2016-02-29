<?php 

/**
* TestLeadStatusDataProvider
*/
class TestLeadStatusDataProvider extends CArrayDataProvider
{
	function __construct()
	{
        $combinedLeadData = array();
        foreach (range(0, 10) as $currentRowKey => $currentRowValue) {
            $combinedLeadData[] = array(
            	"id"=>$currentRowKey,
                "status"=>uniqid(),
                "lead"=>rand(0, 5000)
            );
        }
        $this->data = $combinedLeadData;
        //set data
        $this->id = "id";
        $this->keyField = "id";
		
		$this->pagination = false;
	}
}