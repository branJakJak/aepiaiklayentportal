<?php 
/**
* LeadsStatusDataProvider
*/
class LeadsStatusDataProvider extends CArrayDataProvider
{
    public $listid;
    function __construct($listid)
    {
        // get all leads from 1501
        $fetcher = new LeadDataFetcher();
        $rawData = $fetcher->retrieveRemoteData($listid);
        $combinedLeadData = array();
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
        $this->setListid($listid);
    }

    /**
     * Gets list id property
     *
     * @return integer listid
     */
    public function getListid() {
        return $this->listid;
    }
    
    /**
     * sets listid value
     *
     * @param Integer $newlistid Listid
     */
    public function setListid($listid) {
        $this->listid = $listid;
        return $this;
    }
}