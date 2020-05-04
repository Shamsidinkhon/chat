<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use common\botHelpers\CommonHelper;
use common\botHelpers\UserHelper;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\KeyboardButton;
use Longman\TelegramBot\Request;
use Yii;

class UzbekCommand extends UserCommand
{
    protected $name = 'uzbek';                      // Your command's name
    protected $description = 'A command for changing language to uzbek'; // Your command description
    protected $usage = '/uzbek';                    // Usage of your command
    protected $version = '1.0.0';                  // Version of your command

    public function execute()
    {
        Yii::$app->language = 'oz';
        $message = $this->getMessage();            // Get Message object

        $chat_id = $message->getChat()->getId();   // Get the current Chat ID

        $keyboards = new Keyboard(
            [Yii::t('main', 'Female')],
            [Yii::t('main', 'Male')]
        );

        $keyboards = $keyboards
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true);

        $data = [                                  // Set up the new message data
            'chat_id' => $chat_id,                 // Set Chat ID to send the message to
            'text' => 'Iltimos, jinsingizni tanlang', // Set message to send
            'reply_markup' => $keyboards
        ];
        UserHelper::changeLanguageUser($chat_id, 'oz');
        return Request::sendMessage($data);        // Send message!
    }

    public function preExecute()
    {
        CommonHelper::initialize($this->update);
        return parent::preExecute(); // TODO: Change the autogenerated stub
    }
}