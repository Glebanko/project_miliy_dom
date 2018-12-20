<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 09.09.17
 * Time: 10:41
 */

namespace backend\controllers;
use yii\web\Controller;
use backend\widget\chat\Chats;
class ChatController extends Controller
{
    public function actionSendChat() {
        if (!empty($_POST)) {
            echo Chats::sendChat($_POST);
        }
    }
}