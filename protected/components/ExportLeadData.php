<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2/4/2016
 * Time: 1:42 AM
 */

class ExportLeadData {
    protected $dataArr;

    /**
     * Exports the content data to file
     * @return string Path to exported file
     */
    public function exportContents(array $logsCollection){
        $tempFile = tempnam(sys_get_temp_dir(), "temp");
        $fileRes = fopen($tempFile, "w+");
        fputcsv($fileRes, array("Mobile Number"));
        foreach ($logsCollection as $currentBarryObj) {
            /* @var $currentBarryObj BarryOptLog*/
            fputcsv($fileRes, array($currentBarryObj->getMobileNumber()));
        }
        fclose($fileRes);
        return $tempFile;
    }
    /**
     * @return mixed
     */
    public function getDataArr()
    {
        return $this->dataArr;
    }

    /**
     * @param mixed $dataArr
     */
    public function setDataArr($dataArr)
    {
        $this->dataArr = $dataArr;
    }


} 