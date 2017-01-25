<?php

namespace app\modules\rest\controllers;

use app\models\Group;
use app\models\Roster;
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

	/**
	 * Вывод ростера
	 * uuid
	 * @return array
	 */
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

	public function actionAddparticipant()
	{
		$uuid = \Yii::$app->request->get('uuid');
		$participantUuid = \Yii::$app->request->get('participant');
		$title = \Yii::$app->request->get('title');
		$groupTitle = \Yii::$app->request->get('group');


		//Проверяем есть ли пользователь
		if (!$user = User::findOne(['uuid' => $uuid])) {
			return [
				'result'  => 'error',
				'message' => 'User not found',
			];
		}

		//Проверяем существование группы
		if (!$group = Group::findOne(['title' => $groupTitle])) {
			$group = new Group();
			$group->title = $groupTitle;
			$group->save();
		}

		//Проверяем существование participant в users
		if (!$participant = User::findOne(['uuid' => $participantUuid])) {
			$participant = new User();
			$participant->uuid = $participantUuid;
			$participant->save();
		}

		//Если уже есть ростер с пользователем в группе вывод ошибки
		if ($roster = Roster::findOne([
			'user_id'        => $user->id,
			'group_id'       => $group->id,
			'participant_id' => $participant->id,
		])
		) {
			return [
				'result'  => 'error',
				'message' => 'Participant is already in group',
			];
		} else {
			//Создаем запись в ростере
			$roster = new Roster();
			$roster->user_id = $user->id;
			$roster->group_id = $group->id;
			$roster->participant_id = $participant->id;
			$roster->title = $title;

			if ($roster->save()) {
				return [
					'result' => 'ok',
				];
			} else {
				return [
					'result'  => 'error',
					'message' => $roster->errors,
				];
			}
		}
	}

	/**
	 * Удаление записи из ростера
	 * uuid, participant, group
	 */
	public function actionRemoveparticipant()
	{
		$uuid = \Yii::$app->request->get('uuid');
		$participantUuid = \Yii::$app->request->get('participant');
		$groupTitle = \Yii::$app->request->get('group');

		//Проверяем есть ли пользователь
		if (!$user = User::findOne(['uuid' => $uuid])) {
			return [
				'result'  => 'error',
				'message' => 'User not found',
			];
		}

		//Проверяем существование группы
		if (!$group = Group::findOne(['title' => $groupTitle])) {
			return [
				'result'  => 'error',
				'message' => 'Group not found',
			];
		}

		//Проверяем существование participant в users
		if (!$participant = User::findOne(['uuid' => $participantUuid])) {
			return [
				'result'  => 'error',
				'message' => 'Participant not found',
			];
		}

		//Если уже есть ростер с пользователем в группе - удаляем
		if ($roster = Roster::findOne([
			'user_id'        => $user->id,
			'group_id'       => $group->id,
			'participant_id' => $participant->id,
		])
		) {
			if ($roster->delete()) {
				return [
					'result' => 'ok',
				];
			} else {
				return [
					'result'  => 'error',
					'message' => $roster->errors,
				];
			}
		} else {
			return [
				'result'  => 'error',
				'message' => 'Participant not found in roster',
			];
		}
	}

	/**
	 * Изменение title записи в ростере
	 * uuid, participant, title, group
	 */
	public function actionRenameparticipant()
	{
		$uuid = \Yii::$app->request->get('uuid');
		$participantUuid = \Yii::$app->request->get('participant');
		$title = \Yii::$app->request->get('title');
		$groupTitle = \Yii::$app->request->get('group');

		//Проверяем есть ли пользователь
		if (!$user = User::findOne(['uuid' => $uuid])) {
			return [
				'result'  => 'error',
				'message' => 'User not found',
			];
		}

		//Проверяем существование группы
		if (!$group = Group::findOne(['title' => $groupTitle])) {
			return [
				'result'  => 'error',
				'message' => 'Group not found',
			];
		}

		//Проверяем существование participant в users
		if (!$participant = User::findOne(['uuid' => $participantUuid])) {
			return [
				'result'  => 'error',
				'message' => 'Participant not found',
			];
		}

		//Если уже есть ростер с пользователем в группе - меняем title
		if ($roster = Roster::findOne([
			'user_id'        => $user->id,
			'group_id'       => $group->id,
			'participant_id' => $participant->id,
		])
		) {
			$roster->title = $title;
			if ($roster->save()) {
				return [
					'result' => 'ok',
				];
			} else {
				return [
					'result'  => 'error',
					'message' => $roster->errors,
				];
			}
		} else {
			return [
				'result'  => 'error',
				'message' => 'User not found in group',
			];
		}
	}
}
