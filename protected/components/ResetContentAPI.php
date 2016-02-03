<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2/4/2016
 * Time: 1:42 AM
 */

class ResetContentAPI {
    /**
     * Sends get request to reset the data
     * @return boolean Returns true if everything went well, false otherwise
     */
    public function resetData()
    {
        $is_successful = false;
        $resetUrl = Yii::app()->params['reset_url'];
        $curlRes = curl_init($resetUrl);
        curl_setopt($curlRes, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curlRes, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curlRes, CURLOPT_RETURNTRANSFER, true);
        $returnedData = curl_exec($curlRes);
        $httpcode = curl_getinfo($curlRes, CURLINFO_HTTP_CODE);
        if ($httpcode == '200') {
            $is_successful = true;
        }
        Yii::log(CVarDumper::dumpAsString($returnedData), CLogger::LEVEL_INFO, "reset");
        return $is_successful;
    }
} 