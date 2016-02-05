<?php 

/**
* ChartDataProvider
*/
class ChartDataProvider
{
	protected $rawData;
	function __construct($rawData) {
		$this->rawData = $rawData;
	}
	public function getData()
	{
		$chartDataProvider = array();
		foreach ($this->rawData as $key => $value) {
        $chartDataProvider[]  = array(
        			"name"=>$value['status'],
        			"y"=>$value['lead'],
        	);		
    	}
        return $chartDataProvider;
	}


}