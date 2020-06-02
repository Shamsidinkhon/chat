<?php


namespace console\controllers;


use common\botHelpers\CommonHelper;
use common\components\TelegramBot;
use Longman\TelegramBot\Exception\TelegramException;
use Yii;
use yii\console\Controller;

class HelperController extends Controller
{
    public function actionMatchUsers()
    {
        try {
            $params = Yii::$app->params['bot'];
            $telegram = new TelegramBot($params['bot_api_key'], $params['bot_username']);
            $count = CommonHelper::matchUsers();
        } catch (TelegramException $e) {
            set_error_handler('var_dump', 0); // Never called because of empty mask.
            @trigger_error("");
            restore_error_handler();
            // log telegram errors
            echo $e->getMessage();
        }
        return 'Users matched: ' . $count;
    }

    public function actionMatchUser($from, $to)
    {
        try {
            $params = Yii::$app->params['bot'];
            $telegram = new TelegramBot($params['bot_api_key'], $params['bot_username']);
            CommonHelper::matchUser($from, $to);
        } catch (TelegramException $e) {
            set_error_handler('var_dump', 0); // Never called because of empty mask.
            @trigger_error("");
            restore_error_handler();
            // log telegram errors
            echo $e->getMessage();
        }
        return 'Done';
    }
}