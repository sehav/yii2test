<?php

namespace app\modules\rest;

/**
 * rest module definition class
 */
class Module extends \yii\base\Module
{
	/**
	 * @inheritdoc
	 */
	public $controllerNamespace = 'app\modules\rest\controllers';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		\Yii::$app->response->format = 'json';//Делаем весь вывод в формате json
		// custom initialization code goes here
	}
}
