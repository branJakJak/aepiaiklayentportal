<?php

class SiteController extends Controller
{

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
				'actions'=>array('error','login'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('index','logout','upload'),
				'users'=>array('@'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		/* client data */
		$clientVb = Yii::app()->askteriskDb->createCommand("select * from client_panel")->queryAll();
		foreach ($clientVb as $key => $value) {
			$tempContainer = $clientVb[$key];
			$tempContainer['id'] = uniqid();
			$tempContainer['total'] = (  ( doubleval($value['seconds']) ) / 60  ) * doubleval($value['ppminc']);
			$tempContainer['balance'] = doubleval($value['balance']) + 300;
			$tempContainer['balance'] -= doubleval($tempContainer['total']);
			$tempContainer['balance'] = '£ '.$tempContainer['balance'];
			$clientVb[$key] =  $tempContainer;
		}
		/*compute the total*/

		/*file uploaded*/
		$fileUploadedObj = new ClientUploadedData;
		$fileUploadedArr = $fileUploadedObj->getListUploaded();

		$this->render('index',compact('clientVb','fileUploadedArr'));
	}
	public function actionUpload()
	{
   		Yii::import("ext.EAjaxUpload.qqFileUploader");
        $folder=Yii::getPathOfAlias('upload_folder');// folder for uploaded files
        $allowedExtensions = array("csv","jpg",'txt','xlsx','xls');//array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
 
        $fileSize=filesize($folder.DIRECTORY_SEPARATOR.$result['filename']);//GETTING FILE SIZE
        $fileName=$result['filename'];//GETTING FILE NAME
 
        echo $return;// it's array		
	}


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->redirect(array('user/login'));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		$this->redirect(array('user/logout'));
	}
}