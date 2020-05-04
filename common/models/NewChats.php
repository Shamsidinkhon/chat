<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "new_chats".
 *
 * @property int $id
 * @property int $chat_id
 * @property string $gender
 */
class NewChats extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'new_chats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_id', 'gender'], 'required'],
            [['chat_id'], 'integer'],
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
            'gender' => 'Gender',
        ];
    }
}
