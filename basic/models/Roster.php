<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rosters".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $group_id
 * @property string $title
 * @property integer $participant_id
 */
class Roster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rosters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id', 'title', 'participant_id'], 'required'],
            [['user_id', 'group_id', 'participant_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'group_id' => 'Group ID',
            'title' => 'Title',
            'participant_id' => 'Participant ID',
        ];
    }
}
