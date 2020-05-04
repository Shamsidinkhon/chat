<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "updates".
 *
 * @property int $id
 * @property string $update_data
 * @property string|null $created_at
 */
class Updates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'updates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['update_data'], 'required'],
            [['update_data'], 'string'],
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
            'update_data' => 'Update Data',
            'created_at' => 'Created At',
        ];
    }
}
