<?php

/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2/4/2016
 * Time: 4:12 AM
 */
class ClearDataController extends Controller
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
            array(
                'allow',
                'actions' => array('index'),
                'roles' => array('administrator'),
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        /*send the clear command*/
        $resetObj = new ResetContentAPI();
        if ($resetObj->resetData()) {
            Yii::app()->user->setFlash("success", "Success : Data cleared!");
        } else {
            Yii::app()->user->setFlash("error", "We cant clear the data at the moment. Try again later");
        }
        $this->redirect("/site/index");
    }

} 