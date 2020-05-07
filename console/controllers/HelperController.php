<?php


namespace console\controllers;


use common\botHelpers\CommonHelper;
use common\components\TelegramBot;
use Yii;
use yii\console\Controller;

class HelperController extends Controller
{
    public function actionMatchUsers()
    {
        $params = Yii::$app->params['bot'];
        $telegram = new TelegramBot($params['bot_api_key'], $params['bot_username']);
        $count = CommonHelper::matchUsers();
        return 'Users matched: ' . $count;
    }
}