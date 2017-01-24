<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rosters`.
 */
class m170124_025410_create_rosters_table extends Migration
{
	/**
	 * @inheritdoc
	 */
	public function up()
	{
		$this->createTable('rosters', [
			'id'       => $this->primaryKey(),
			'user_id'  => $this->integer()->notNull(),
			'group_id' => $this->integer()->notNull(),
			'title' => $this->string()->notNull(),
			'participant_id' => $this->integer()->notNull(),
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function down()
	{
		$this->dropTable('rosters');
	}
}
