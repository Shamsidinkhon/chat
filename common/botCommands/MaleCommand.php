<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use common\botHelpers\CommonHelper;
use common\botHelpers\UserHelper;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\KeyboardButton;
use Longman\TelegramBot\Request;
use Yii;

class MaleCommand extends UserCommand
{
    protected $name = 'male';                      // Your command's name
    protected $description = 'A command for changing gender to male'; // Your command description
    protected $usage = '/male';                    // Usage of your command
    protected $version = '1.0.0';                  // Version of your command

    public function execute()
    {
        $message = $this->getMessage();            // Get Message object

        $chat_id = $message->getChat()->getId();   // Get the current Chat ID

        UserHelper::changeGenderUser($chat_id, 'm');
    }

    public function preExecute()
    {
        CommonHelper::initialize($this->update);
        return parent::preExecute(); // TODO: Change the autogenerated stub
    }
}