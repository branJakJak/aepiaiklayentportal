<?php 
/**
* EmptyLeadStatusDataProvider
*/
class EmptyLeadStatusDataProvider extends CArrayDataProvider
{
	
   function __construct()
    {
        $emptyLeadData = array(
        	array(
        		'id'=>rand(0, 999999),
        		'status'=>"5FLATPRESS",
        		'lead'=>0,
    		),
        	array(
        		'id'=>rand(0, 999999),
        		'status'=>"Busy",
        		'lead'=>0,
    		),
        	array(
        		'id'=>rand(0, 999999),
        		'status'=>"Call Picked Up",
        		'lead'=>0,
    		),
        	array(
        		'id'=>rand(0, 999999),
        		'status'=>"Disconnected Number Auto",
        		'lead'=>0,
    		),
        	array(
        		'id'=>rand(0, 999999),
        		'status'=>"DO NOT CALL Hopper Match",
        		'lead'=>0,
    		),
        	array(
        		'id'=>rand(0, 999999),
        		'status'=>"New Lead",
        		'lead'=>0,
    		),
        	array(
        		'id'=>rand(0, 999999),
        		'status'=>"No Answer AutoDial",
        		'lead'=>0,
    		),
        	array(
        		'id'=>rand(0, 999999),
        		'status'=>"OPTOUTVB",
        		'lead'=>0,
    		),
        	array(
        		'id'=>rand(0, 999999),
        		'status'=>"Played Message",
        		'lead'=>0,
    		),
    	);


        $this->data = $emptyLeadData;
        //set data
        $this->id = "id";
        $this->keyField = "id";
        //done
        $this->pagination = false;
    }

}