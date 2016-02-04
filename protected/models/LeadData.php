<?php 

/**
* LeadData
*/
class LeadData
{
	protected $lead_value;	
	protected $lead_status;

    function __construct($lead_status, $lead_value)
    {
        $this->lead_status = $lead_status;
        $this->lead_value = $lead_value;
    }

    public function setLeadStatus($lead_status)
    {
        $this->lead_status = $lead_status;
    }

    public function getLeadStatus()
    {
        return $this->lead_status;
    }

    public function setLeadValue($lead_value)
    {
        $this->lead_value = $lead_value;
    }

    public function getLeadValue()
    {
        return $this->lead_value;
    }

}