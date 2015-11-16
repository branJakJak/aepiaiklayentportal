<?php


class CampaignsController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
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
                'actions' => array('activate','deactivate'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    public function actionIndex()
    {
        $campaignRetriever = new VicidialCampaignRetriever();
        $listCampaignsArr = $campaignRetriever->retrieve();
        $gridDataProvider = new CArrayDataProvider($listCampaignsArr);
        $this->render('index',compact('gridDataProvider'));
    }
    public function actionActivate()
    {
        $campaignNames = array("clientj6","clientj8");
        foreach ($campaignNames as $key => $currentCampaignName) {
            $activateObj = new ActivateCampaign($currentCampaignName);
            $activateObj->activate();            
        }
        Yii::app()->user->setFlash('success', "<strong>Campaign Activated!</strong> Campaign is now activated.");
        $this->redirect(Yii::app()->homeUrl);
    }
    public function actionDeactivate()
    {
        $campaignNames = array("clientj6","clientj8");
        foreach ($campaignNames as $key => $currentCampaignName) {
            $activateObj = new DeactivateCampaign($currentCampaignName);
            $activateObj->deactivate();            
        }
        Yii::app()->user->setFlash('success', "<strong>Campaign Deactivated!</strong> Campaign is now deactivated.");
        $this->redirect(Yii::app()->homeUrl);
    }

}