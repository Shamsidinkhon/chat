<?php

namespace frontend\controllers;

use common\botHelpers\CommonHelper;
use common\components\TelegramBot;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class ApiController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $commands_paths = [
            Yii::getAlias('@common/botCommands/'),
        ];
        try {

            $params = Yii::$app->params['bot'];
            $telegram = new TelegramBot($params['bot_api_key'], $params['bot_username']);
            $telegram->addCommandsPaths($commands_paths);
//            $telegram->useGetUpdatesWithoutDatabase();
//            $telegram->handleGetUpdates();
            $telegram->handle();
            CommonHelper::logging($telegram->getCustomInput());
            $telegram->afterExecuteCommands();
        } catch (TelegramException $e) {
            // log telegram errors
            echo $e->getMessage();
        }
        return true;
    }

}
