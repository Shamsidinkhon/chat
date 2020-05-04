<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "conversation".
 *
 * @property int $id
 * @property int $from_chat_id
 * @property int $to_chat_id
 * @property string $content
 * @property string|null $created_at
 */
class Conversation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'conversation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_chat_id', 'to_chat_id', 'content'], 'required'],
            [['from_chat_id', 'to_chat_id'], 'integer'],
            [['content'], 'string'],
            [['created_at'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_chat_id' => 'From Chat ID',
            'to_chat_id' => 'To Chat ID',
            'content' => 'Content',
            'created_at' => 'Created At',
        ];
    }
}
