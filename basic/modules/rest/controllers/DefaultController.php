<?php

namespace app\modules\rest\controllers;

use app\models\User;
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
		return ['aas' => 'asd', 2, 3];
	}

	public function actionGetroster()
	{
		$uuid = \Yii::$app->request->get('uuid');

		if ($user = User::findOne(['uuid' => $uuid])) {

		} else {
			return [
				'result'  => 'error',
				'message' => 'User not found',
			];
		}
	}

	public function actionCreateuser()
	{
		$uuid = \Yii::$app->request->get('uuid');

		$user = new User();
		$user->uuid = $uuid;
		$user->title = $uuid;

		if ($user->save()) {
			return [
				'result' => 'ok',
			];
		} else {
			return [
				'result'  => 'error',
				'message' => 'User not unique',
			];
		}
	}

	public function actionAddParticipant($uuid)
	{

	}

	public function actionRemoveParticipant()
	{

	}

	public function actionRenameParticipant()
	{

	}
}
