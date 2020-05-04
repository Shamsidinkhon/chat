<?php


namespace common\models;


use yii\behaviors\TimestampBehavior;

class BotUsersSearch extends BotUsers
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }
}