<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blocked_users".
 *
 * @property int $id
 * @property int $chat_id
 * @property int $blocked_chat_id
 */
class BlockedUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blocked_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_id', 'blocked_chat_id'], 'required'],
            [['chat_id', 'blocked_chat_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chat_id' => 'Chat ID',
            'blocked_chat_id' => 'Blocked Chat ID',
        ];
    }
}
