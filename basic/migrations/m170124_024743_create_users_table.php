<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m170124_024743_create_users_table extends Migration
{
	/**
	 * @inheritdoc
	 */
	public function up()
	{
		$this->createTable('users', [
			'id'    => $this->primaryKey(),
			'uuid'  => $this->string()->notNull()->unique(),
			'title' => $this->string()->notNull(),
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function down()
	{
		$this->dropTable('users');
	}
}
