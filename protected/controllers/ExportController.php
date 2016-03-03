<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2/4/2016
 * Time: 4:10 AM
 */

class ExportController extends Controller{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index','range','today'),
                'users'=>array('@'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex($listid)
    {
        $fileName = sprintf("%s-%s","export-data",date("Y-m-d"));
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$fileName.csv\";" );
        header("Content-Transfer-Encoding: binary");

        $listid = intval($listid);
        $barryOptOutLogs = new BarryOptLog();
        $allDataColl = $barryOptOutLogs->getAllData($listid);
        /*write to file*/
        $exporter = new ExportLeadData();
        $filePath = $exporter->exportContents($allDataColl);
        /*stream the contents*/
        echo file_get_contents($filePath);
    }
    public function actionRange($listid,$dateFrom, $dateTo)
    {
        $fileName = sprintf("%s-%s","export-data",date("Y-m-d"));
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$fileName.csv\";" );
        header("Content-Transfer-Encoding: binary");
        
        $dateFrom = strtotime($dateFrom);
        $dateFrom = date("Y-m-d H:i:s", $dateFrom);
        $dateTo = strtotime($dateTo);
        $dateTo = date("Y-m-d H:i:s", $dateTo);
        $barryOptOutLogs = new BarryOptLog();
        $allDataColl = $barryOptOutLogs->getAllDataRange($listid,$dateFrom, $dateTo);
        $exporter = new ExportLeadData();
        $filePath = $exporter->exportContents($allDataColl);
        /*stream the contents*/
        echo file_get_contents($filePath);
    }
    public function actionToday($listid)
    {
        $fileName = sprintf("%s-%s","export-data",date("Y-m-d"));
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$fileName.csv\";" );
        header("Content-Transfer-Encoding: binary");
        $barryOptOutLogs = new BarryOptLog();
        $allDataColl = $barryOptOutLogs->getAllToday($listid);
        $exporter = new ExportLeadData();
        $filePath = $exporter->exportContents($allDataColl);
        /*stream the contents*/
        echo file_get_contents($filePath);
    }

} 