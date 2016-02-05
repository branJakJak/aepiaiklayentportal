<?php 
/**
* LeadsStatusDataProvider
*/
class LeadsStatusDataProvider extends CArrayDataProvider
{
    function __construct()
    {
        // get all leads from 1501
        $fetcher = new LeadDataFetcher();
        $rawData = $fetcher->retrieveRemoteData();
        foreach ($rawData as $currentRowKey => $currentRowValue) {
            $combinedLeadData[] = array(
                "id"=>$currentRowKey,
                "status"=>$currentRowValue['status_name'],
                "lead"=>intval($currentRowValue['COUNT(vicidial_list.lead_id)'])
            );
        }
        $this->data = $combinedLeadData;
        //set data
        $this->id = "id";
        $this->keyField = "id";
        //done
        $this->pagination = false;
    }

}