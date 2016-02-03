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
        $httpClient = new \GuzzleHttp\Client(['defaults'=>[
            'verify'=>false
        ]]);
        $response= $httpClient->request("GET", $resetUrl);
        if($response->getStatusCode() === 200){
            $is_successful = true;
        }
        return $is_successful;
    }
} 