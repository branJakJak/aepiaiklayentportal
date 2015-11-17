<?php
use Zend\Mime, Zend\Mail\Message;
/**
* SendController
*/
class SendController extends Controller
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
				'actions'=>array('start','stop'),
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	public function actionStart($fileName)
	{
		try {
			// /*do index here*/
	        $folderPath = Yii::getPathOfAlias("upload_folder");
	        $filePath = $folderPath . $fileName;

	  //       /*get mime type of file*/
	  //       $fileMimeType = "";
	  //       $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
	  //       $fileMimeType = finfo_file($finfo, $filePath);
	  //       finfo_close($finfo);

	  //       $text = new Mime\Part();
	  //       $text->type = Mime\Mime::TYPE_TEXT;
	  //       $text->charset = 'utf-8';

	  //       $fileContent = fopen($filePath, "r");
	  //       $attachment = new Mime\Part($fileContent);
	  //       $attachment->type = $fileMimeType;
	  //       $attachment->filename = $fileName;
	  //       $attachment->disposition = Mime\Mime::DISPOSITION_ATTACHMENT;
	  //       $attachment->encoding = Mime\Mime::ENCODING_BASE64;

	  //       $mimeMessage = new Mime\Message();
	  //       $mimeMessage->setParts(array($text, $attachment));

	  //       $message = new Message();
	  //       $message->setBody($mimeMessage);
	  //       $message->setSubject('APIVoip client enabled sending of attached file.');
	  //       $message->setFrom(Yii::app()->params['emailFrom']);
	  //       $message->setTo(Yii::app()->params['emailTo']);

	  //       $transport = new Mail\Transport\Sendmail();


			// $transport->send($message);			
			// Yii::app()->user->setFlash("success","Email sent!");
			// $this->redirect(array('/site/index'));

			$this->sendFile($filePath,"hellsing357@gmail.com","this is a test activation");

		} catch (Exception $e) {
			throw new CHttpException(500,$e->getMessage());
		}
	}
	private function sendFile($filePath , $emailAddress,$headerMessage)
	{
		$file = $filePath;
		$mail = new Zend_Mail();
		$mail->setFrom(Yii::app()->params['adminEmail']);
		$mail->addTo($emailAddress);
		$mail->setSubject($headerMessage);
		$mail->setBodyHtml($headerMessage);
		$at = new Zend_Mime_Part(file_get_contents($file));
		$at->type        = $this->_mime_content_type($file);
		$at->disposition = Zend_Mime::DISPOSITION_INLINE;
		$at->encoding    = Zend_Mime::ENCODING_BASE64;
		$at->filename    = basename($file);
		$mail->addAttachment($at);
		if($mail->send())
		 {
			echo " sent";
		 }
		 else
		 {
			echo "not sent";
		 }

	}

	private function _mime_content_type($filename) {
	    $result = new finfo();
	    if (is_resource($result) === true) {
	        return $result->file($filename, FILEINFO_MIME_TYPE);
	    }
	    return false;
	}

	public function actionStop($fileName)
	{
		try {
	  //       $message = new Message();
	  //       $message->setSubject("The client choose to stop activity from file : " . $fileName);
	  //       $message->setFrom(Yii::app()->params['emailFrom']);
	  //       $message->setTo(Yii::app()->params['emailTo']);
	  //       $message->setBody("The client choose to stop activity from file : " . $fileName);

	  //       $transport = new Mail\Transport\Sendmail();
	  //       $transport->send($message);			
			// Yii::app()->user->setFlash("success","Email sent!");
			// $this->redirect(array('/site/index'));
	        $folderPath = Yii::getPathOfAlias("upload_folder");
	        $filePath = $folderPath . $fileName;

			$this->sendFile($filePath,"hellsing357@gmail.com","this is a test activation");			


		} catch (Exception $e) {
			throw new CHttpException(500,$e->getMessage());
		}
	}

}