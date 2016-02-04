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
     * @return array Returns collection ofBarryOptLog objects
     */
    public static function getAllData(){
        $resultRawArr = Yii::app()->askteriskDb->createCommand("SELECT * FROM asterisk.barry_5s")->queryAll();
        $resultCollection = array();
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
    public static function getAllDataRange($dateFrom, $dateTo){
        $commandObj= Yii::app()->askteriskDb->createCommand("SELECT * FROM asterisk.barry_5s where (entry_time >= :date_from && entry_time <= :date_to)");
        $commandObj->params = array(
                "date_from"=>date("Y-m-d H:i:s"),
                "date_to"=>date("Y-m-d H:i:s")
            );
        $resultRawArr = $commandObj->queryAll();
        $resultCollection = array();
        foreach ($resultRawArr as $currentRow) {
            $model = new BarryOptLog();
            $model->setMobileNumber($currentRow['phone_number']);
            $resultCollection[] = $model;
        }
        return $resultCollection;
    }
    public function getAllToday()
    {
        $commandObj= Yii::app()->askteriskDb->createCommand("SELECT * FROM asterisk.barry_5s where date(entry_time) = date(NOW()) ");
        $resultRawArr = $commandObj->queryAll();
        $resultCollection = array();
        foreach ($resultRawArr as $currentRow) {
            $model = new BarryOptLog();
            $model->setMobileNumber($currentRow['phone_number']);
            $resultCollection[] = $model;
        }
        return $resultCollection;
    }
    public static function getCountToday()
    {
        $obj = new BarryOptLog;
        $resColl = $obj->getAllToday();
        return count($resColl);
    }
    public static function getCountAll()
    {
        $obj = new BarryOptLog;
        $resColl = $obj->getAllData();
        return count($resColl);
    }
} 