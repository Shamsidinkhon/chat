<?php

namespace common\botHelpers;

use common\models\BlockedUsers;
use common\models\BotUsersSearch;
use common\models\Conversation;
use common\models\NewChats;
use common\models\Updates;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Request;
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
        if ($update->getMessage() && isset($commands[$update->getMessage()->getText()])) {
            return $commands[$update->getMessage()->getText()];
        }
        return null;
    }

    public static function logging($input)
    {
        $model = new Updates();
        $model->update_data = $input;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
    }

    public static function logConversation($from_chat_id, $to_chat_id, $content)
    {
        $model = new Conversation();
        $model->from_chat_id = $from_chat_id;
        $model->to_chat_id = $to_chat_id;
        $model->content = $content;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
    }

    public static function matchUsers()
    {
        $users = BotUsersSearch::findAll(['gender' => 'f', 'current_partner_id' => null]);
		
        foreach ($users as $user) {
            Yii::$app->language = $user->lang;
            $gender = $user->gender == 'm' ? 'f' : 'm';
            $blockedUsers = BlockedUsers::find()->select('blocked_chat_id')->andWhere(['chat_id' => $user->chat_id])->column();
            $partner = NewChats::find()
                ->andWhere(['gender' => $gender])
                ->andWhere(['not in', 'chat_id', $blockedUsers])
                ->orderBy(['id' => SORT_ASC])->one();
            if ($partner) {
                NewChats::deleteAll(['chat_id' => $partner->chat_id]);
                $user->current_partner_id = $partner->chat_id;
                $pUser = BotUsersSearch::findOne(['chat_id' => $user->current_partner_id]);
                $pUser->current_partner_id = $user->chat_id;
                $pUser->save();
                $data = [                                  // Set up the new message data
                    'chat_id' => $pUser->chat_id,                 // Set Chat ID to send the message to
                    'text' => Yii::t('main', 'New conversation partner'),
                ];
                Request::sendMessage($data);
            }
            $user->save();
            $data = [                                  // Set up the new message data
                'chat_id' => $user->chat_id,                 // Set Chat ID to send the message to
                'text' => Yii::t('main', 'New conversation partner'),
            ];

            Request::sendMessage($data);        // Send message!
        }
		
        return count($users);
    }

    public static function matchUser($from, $to)
    {
        $user = BotUsersSearch::findOne(['chat_id' => $from]);

        if($user->current_partner_id){
            $model = BotUsersSearch::findOne(['chat_id' => $user->current_partner_id]);
            if($model){
                $model->current_partner_id = null;
                $model->save();
                $data = [                                  // Set up the new message data
                    'chat_id' => $model->chat_id,                 // Set Chat ID to send the message to
                    'text' =>  Yii::t('main', 'Your conversation partner has left'),
                ];
                Request::sendMessage($data);
            }
        }

        Yii::$app->language = $user->lang;
        $partner = BotUsersSearch::findOne(['chat_id' => $to]);
        if ($partner) {
            if($partner->current_partner_id){
                $model = BotUsersSearch::findOne(['chat_id' => $partner->current_partner_id]);
                if($model){
                    $model->current_partner_id = null;
                    $model->save();
                    $data = [                                  // Set up the new message data
                        'chat_id' => $model->chat_id,                 // Set Chat ID to send the message to
                        'text' =>  Yii::t('main', 'Your conversation partner has left'),
                    ];
                    Request::sendMessage($data);
                }
            }
            $user->current_partner_id = $partner->chat_id;
            $pUser = BotUsersSearch::findOne(['chat_id' => $user->current_partner_id]);
            $pUser->current_partner_id = $user->chat_id;
            $pUser->save();
            $data = [                                  // Set up the new message data
                'chat_id' => $pUser->chat_id,                 // Set Chat ID to send the message to
                'text' => Yii::t('main', 'New conversation partner'),
            ];
            Request::sendMessage($data);
        }
        $user->save();
        $data = [                                  // Set up the new message data
            'chat_id' => $user->chat_id,                 // Set Chat ID to send the message to
            'text' => Yii::t('main', 'New conversation partner'),
        ];

        return Request::sendMessage($data);        // Send message!
    }
}