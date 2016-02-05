<?php

/**
 * Created by JetBrains PhpStorm.
 * User: kevin
 * Date: 1/12/16
 * Time: 1:04 AM
 * To change this template use File | Settings | File Templates.
 */
class LeadDataFetcher
{
    /**
     *
     * example : http://dial.roadtoriches.co.uk/vicidial/getlist.php?ADD=2356&listid=888
     * @param $list_id
     * @return array
     */
    public function getDataFromDialer($list_id)
    {
        $leadCollection = array();
        $curlURL = "http://dial.roadtoriches.co.uk/vicidial/getlist.php?";
        $httpParam = array(
            "ADD" => "2356",
            "listid" => $list_id,
        );
        $curlURL .= http_build_query($httpParam);
        $curlres = curl_init($curlURL);
        curl_setopt($curlres, CURLOPT_RETURNTRANSFER, true);
        $curlResRaw = curl_exec($curlres);

        $arrResult = json_decode($curlResRaw, true);
        /*iterate and extract*/
        if (isset($arrResult[0]['data'])) {
            foreach ($arrResult[0]['data'] as $key => $value) {
                $val = $arrResult[0]['data'][$key];
                $status = $arrResult[1]['data'][$key];
                $newLead = new LeadData($status, $val);
                $leadCollection[] = $newLead;
            }
        }

        return $leadCollection;
    }
    public function retrieveRemoteData()
    {
        return Yii::app()->askteriskDb->createCommand("select * from clientj_stats")->queryAll();
    }

    /**
     * // https://roadtoriches.co.uk/rr_list_total_v2.php?list_id=555&starting_date=2016-01-16
     * @param $list_id
     * @param $starting_date
     * @throws Exception
     * @return float
     */
    public function getTotalRevenue($list_id, $starting_date)
    {
        /*make sure its in Y-m-d*/
        $startingDateObj = strtotime($starting_date);
        if (date("Y-m-d", $startingDateObj) != $starting_date) {
            throw new Exception("Make sure starting_date is in Y-m-d format");
        }
        $curlURL = "https://roadtoriches.co.uk/rr_list_total_v2.php?";
        $httpParam = array(
            "list_id" => $list_id,
            "starting_date" => date("Y-m-d", $startingDateObj)
        );
        $curlURL .= http_build_query($httpParam);
        $curlres = curl_init($curlURL);
        curl_setopt($curlres, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlres, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curlres, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curlres, CURLOPT_USERPWD, "client:BCK7VWfvkrYCa0Ks");
        $curlResRaw = curl_exec($curlres);
        $resultArr = json_decode($curlResRaw, true);
        return $resultArr['total'];
    }


}