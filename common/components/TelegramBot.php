<?php


namespace common\components;


use common\botHelpers\CommonHelper;
use Longman\TelegramBot\Telegram;

class TelegramBot extends Telegram
{
    public function afterExecuteCommands()
    {
        $command = CommonHelper::mapCommands($this->update);
        $skip = false;
        if ($command) {
            $skip = true;
            $this->executeCommand($command);
            if(in_array($command, ['Female', 'Male']))
                $this->executeCommand('Chat');
        }
        if(!$this->update->getMessage()->getCommand() && !$skip){
            $this->executeCommand('SendTextToUser');
        }
    }
}