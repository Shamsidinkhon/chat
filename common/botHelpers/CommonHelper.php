<?php

namespace common\botHelpers;

use common\models\Conversation;
use common\models\Updates;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Telegram;
use Yii;

class CommonHelper
{
    public static function initialize(Update $update)
    {
        UserHelper::createOrUpdateUser($update);
    }

    public static function mapCommands(Update $update)
    {
        $commands = [
            "O'zbekcha" => 'Uzbek',
            "Русский" => 'Russian',
            'Ayol' => 'Female',
            'Женский' => 'Female',
            'Erkak' => 'Male',
            'Мужской' => 'Male',
            'Yangi suhbatdosh' => 'NewChat',
            'Новый собеседник' => 'NewChat',
            'Заблокировать собеседника' => 'BlockUser',
            'Suhbatdoshni bloklash' => 'BlockUser',
        ];
        if (isset($commands[$update->getMessage()->getText()])) {
            return $commands[$update->getMessage()->getText()];
        }
        return null;
    }

    public static function logging($input){
        $model = new Updates();
        $model->update_data = $input;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
    }

    public static function logConversation($from_chat_id, $to_chat_id, $content){
        $model = new Conversation();
        $model->from_chat_id = $from_chat_id;
        $model->to_chat_id = $to_chat_id;
        $model->content = $content;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
    }
}