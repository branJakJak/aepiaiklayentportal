<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2/4/2016
 * Time: 2:26 AM
 */
class BarryOptLog {
    protected $mobile_number;

    /**
     * @return mixed
     */
    public function getMobileNumber()
    {
        return $this->mobile_number;
    }

    /**
     * @param mixed $mobile_number
     */
    public function setMobileNumber($mobile_number)
    {
        $this->mobile_number = $mobile_number;
    }

    /**
     * Retrieves all submitted leads of given listid
     * @return array Returns collection of BarryOptLog objects
     */
    public static function getAllData($listid){
        $resultCollection = array();
        $sqlCommand = <<<EOL
        SELECT  phone_number
        FROM    vicidial_list
        WHERE  vicidial_list.list_id = :listid AND security_phrase='5'
EOL;
        $commandObj = Yii::app()->askteriskDb->createCommand($sqlCommand);
        $commandObj->bindParam(":listid",$listid);
        $resultRawArr = $commandObj->queryAll();
        foreach ($resultRawArr as $currentRow) {
            $model = new BarryOptLog();
            $model->setMobileNumber($currentRow['phone_number']);
            $resultCollection[] = $model;
        }
        return $resultCollection;
    }
    /**
     * @return array Returns collection ofBarryOptLog objects
     */
    public static function getAllDataRange($listid,$dateFrom, $dateTo){
        $resultCollection = array();
        $sqlCommand = <<<EOL
        SELECT  phone_number
        FROM    vicidial_list
        WHERE  
            vicidial_list.list_id = :listid AND
            security_phrase='5' AND
            (last_local_call_time >= :date_from && last_local_call_time <= :date_to)
EOL;
        $commandObj = Yii::app()->askteriskDb->createCommand($sqlCommand);
        $commandObj->bindParam(":listid"  , $listid);
        $commandObj->bindParam(":date_from"  , $dateFrom);
        $commandObj->bindParam(":date_to"  , $dateTo);
        $resultRawArr = $commandObj->queryAll();
        $resultCollection = array();
        foreach ($resultRawArr as $currentRow) {
            $model = new BarryOptLog();
            $model->setMobileNumber($currentRow['phone_number']);
            $resultCollection[] = $model;
        }
        return $resultCollection;
    }
    public function getAllToday($listid)
    {
        $resultCollection = array();
        $sqlCommand = <<<EOL
        SELECT  phone_number
        FROM    vicidial_list
        WHERE  
            vicidial_list.list_id = :listid AND 
            security_phrase='5' AND
            date(last_local_call_time) = DATE(NOW())
EOL;
        $commandObj = Yii::app()->askteriskDb->createCommand($sqlCommand);
        $commandObj->bindParam(":listid"  , $listid);
        $resultRawArr = $commandObj->queryAll();
        foreach ($resultRawArr as $currentRow) {
            $model = new BarryOptLog();
            $model->setMobileNumber($currentRow['phone_number']);
            $resultCollection[] = $model;
        }
        return $resultCollection;
    }
    public static function getCountToday($listid)
    {
        $sqlCommand = <<<EOL
        SELECT  count(phone_number)
        FROM    vicidial_list
        WHERE  
            vicidial_list.list_id = :listid AND 
            security_phrase='5'  AND 
            DATE(last_local_call_time) = DATE(NOW())        
EOL;
        $commandObj = Yii::app()->askteriskDb->createCommand($sqlCommand);
        $commandObj->bindParam(":listid",$listid);
        $countAsterisk = $commandObj->queryColumn();
        return $countAsterisk[0];
    }
    public static function getCountAll($listid)
    {
        $sqlCommand = <<<EOL
        SELECT  count(phone_number)
        FROM    vicidial_list
        WHERE  
            vicidial_list.list_id = :listid AND 
            security_phrase='5'
EOL;
        $commandObj = Yii::app()->askteriskDb->createCommand($sqlCommand);
        $commandObj->bindParam(":listid",$listid);
        $countAsterisk = $commandObj->queryColumn();
        return $countAsterisk[0];
    }
} 