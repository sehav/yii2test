<?php

use yii\db\Migration;

/**
 * Handles the creation of table `groups`.
 */
class m170124_025130_create_groups_table extends Migration
{
	/**
	 * @inheritdoc
	 */
	public function up()
	{
		$this->createTable('groups', [
			'id'    => $this->primaryKey(),
			'title' => $this->string()->notNull()->unique(),
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function down()
	{
		$this->dropTable('groups');
	}
}
