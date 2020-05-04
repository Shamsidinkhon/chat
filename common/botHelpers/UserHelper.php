<?php

namespace common\botHelpers;

use common\models\BotUsersSearch;
use Longman\TelegramBot\Entities\Update;
use Yii;

class UserHelper
{
    public static function createOrUpdateUser(Update $update)
    {
        $from = $update->getMessage()->getFrom();
        if ($from) {
            $user = BotUsersSearch::findOne(['chat_id' => $from->getId()]);
            if ($user == null)
                $user = new BotUsersSearch();
            $user->chat_id = $from->getId();
            $user->user_info = json_encode($from);
            $user->save();
            if ($user->lang)
                Yii::$app->language = $user->lang;
        }
    }

    public static function changeLanguageUser($chat_id, $lang)
    {
        $user = BotUsersSearch::findOne(['chat_id' => $chat_id]);
        if ($user) {
            $user->lang = $lang;
            $user->save();
        }
    }

    public static function changeGenderUser($chat_id, $gender)
    {
        $user = BotUsersSearch::findOne(['chat_id' => $chat_id]);
        if ($user) {
            $user->gender = $gender;
            $user->save();
        }
    }
}