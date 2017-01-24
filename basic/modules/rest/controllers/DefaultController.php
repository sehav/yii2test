<?php

namespace app\modules\rest\controllers;

use yii\web\Controller;

/**
 * Default controller for the `rest` module
 */
class DefaultController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return ['aas'=>'asd',2,3];
    }

	public function actionGetroster(){
		return 'getRoster';
	}

	public function actionCreateUser(){

	}

	public function actionAddParticipant($uuid){

	}

	public function actionRemoveParticipant(){

	}

	public function actionRenameParticipant(){

	}
}
