<?php 
/**
* LeadsStatusDataProvider
*/
class LeadsStatusDataProvider extends CArrayDataProvider
{
	public $listIds = array('1501','1502');
//	public $listIds = array('888','888');

    function __construct()
    {
        // get all leads from 1501
        $fetcher = new LeadDataFetcher();
        $leadDataCollection1501 = $fetcher->getDataFromDialer($this->listIds[0]);
        // get all leads from 1502
        $leadDataCollection1502 = $fetcher->getDataFromDialer($this->listIds[1]);
        // combine record
        $combinedLeadData = array();
        foreach ($leadDataCollection1501 as $currentRowKey => $currentRowValue) {
            /**
             * @var $temp1Container LeadData
             * @var $temp2Container LeadData
             */
            $temp1Container = $leadDataCollection1501[$currentRowKey];
            $temp2Container = $leadDataCollection1502[$currentRowKey];
            $combinedLeadData[] = array(
                "id"=>$currentRowKey,
                "status"=>$temp1Container->getLeadStatus(),
                "lead"=>intval($temp1Container->getLeadValue()) + intval($temp2Container->getLeadValue())
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