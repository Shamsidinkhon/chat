<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bot_users".
 *
 * @property int $id
 * @property int $chat_id
 * @property int|null $current_partner_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $user_info
 * @property string|null $lang
 * @property string|null $gender
 * @property int|null $status
 */
class BotUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bot_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_id'], 'required'],
            [['chat_id', 'current_partner_id', 'status'], 'integer'],
            [['user_info'], 'string'],
            [['created_at', 'updated_at'], 'string', 'max' => 255],
            [['lang'], 'string', 'max' => 2],
            [['gender'], 'string', 'max' => 1],
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
            'current_partner_id' => 'Current Partner ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_info' => 'User Info',
            'lang' => 'Lang',
            'gender' => 'Gender',
            'status' => 'Status',
        ];
    }
}
