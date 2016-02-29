<?php 

/**
* LeadsStatusUrlDataProvider
*/
class LeadsStatusUrlDataProvider extends CArrayDataProvider
{
    function __construct()
    {
        // get all leads from 1501
        $fetcher = new LeadDataFetcher();
        // $rawData = $fetcher->retrieveRemoteData();
        $rawData = $fetcher->getDataFromDialer("888");
        foreach ($rawData as $currentRowKey => $currentRowValue) {
            $combinedLeadData[] = array(
                "id"=>$currentRowKey,
                "status"=>$currentRowValue->getLeadStatus(),
                "lead"=>$currentRowValue->getLeadValue()
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