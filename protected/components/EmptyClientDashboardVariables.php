<?php 

/**
* EmptyClientDashboardVariables
*/
class EmptyClientDashboardVariables
{
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
			);
		return $clientDashboardVars;
	}
}