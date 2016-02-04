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

    public function actionIndex()
    {
        $fileName = sprintf("%s-%s","barry-export-data",date("Y-m-d"));
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$fileName.csv\";" );
        header("Content-Transfer-Encoding: binary");

        $barryOptOutLogs = new BarryOptLog();
        $allDataColl = $barryOptOutLogs->getAllData();
        /*write to file*/
        $exporter = new ExportLeadData();
        $filePath = $exporter->exportContents($allDataColl);
        /*stream the contents*/
        echo file_get_contents($filePath);
    }
    public function actionRange($dateFrom, $dateTo)
    {
        $fileName = sprintf("%s-%s","barry-export-data",date("Y-m-d"));
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$fileName.csv\";" );
        header("Content-Transfer-Encoding: binary");
        
        $dateFrom = strtotime($dateFrom);
        $dateTo = strtotime($dateTo);
        $barryOptOutLogs = new BarryOptLog();
        $allDataColl = $barryOptOutLogs->getAllDataRange($dateFrom, $dateTo);
        $exporter = new ExportLeadData();
        $filePath = $exporter->exportContents($allDataColl);
        /*stream the contents*/
        echo file_get_contents($filePath);
    }
    public function actionToday()
    {
        $fileName = sprintf("%s-%s","barry-export-data",date("Y-m-d"));
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$fileName.csv\";" );
        header("Content-Transfer-Encoding: binary");
        $barryOptOutLogs = new BarryOptLog();
        $allDataColl = $barryOptOutLogs->getAllToday();
        $exporter = new ExportLeadData();
        $filePath = $exporter->exportContents($allDataColl);
        /*stream the contents*/
        echo file_get_contents($filePath);
    }

} 