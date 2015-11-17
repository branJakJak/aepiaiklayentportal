<?php


class ClientUploadedData {
    /**
     * @return array
     */
    public function getListUploaded()
    {
        /**
         * @var DirectoryIterator $currentFile
         */
        $uploadedDataArr = array();
        /*get list of files*/
        $targetDir = Yii::getPathOfAlias("upload_folder");
        $splObjFileIter = new DirectoryIterator($targetDir);

        foreach($splObjFileIter as $currentFile){
            if($currentFile->isFile() && !$currentFile->isDot()){
                $uploadedDataArr[] = array(
                        "id"=>uniqid(),
                        "file_name"=>$currentFile->getFilename(),
                        "last_modified"=>$currentFile->getMTime(),
                    );
            }
        }
        return $uploadedDataArr;
    }
}