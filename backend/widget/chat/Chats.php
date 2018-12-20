<?php

namespace backend\widget\chat;

use Yii;
use sintret\chat\ChatRoom;
use sintret\chat\ChatJs;
use backend\widget\chat\models\Chat;
/**
 * chat module definition class
 */
class Chats extends ChatRoom
{
    public $userModel;
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\chat\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function run() {
        parent::init();
        ChatJs::register($this->view);
        $model = new Chat();
        $cahtRoom = new ChatRoom();
        $model->userModel = $cahtRoom->userModel;
        $model->userField = $this->userField;
        $data = $model->data();
        return $this->render('index', [
            'data' => $data,
            'url' => $this->url,
            'userModel' => $cahtRoom->userModel,
            'userField' => $this->userField,
            'loading' => $cahtRoom->loadingImage
        ]);
    }

    public static function sendChat($post) {
        $cahtRoom= new ChatRoom();
        if (isset($post['message']))
            $message = $post['message'];
        if (isset($post['userfield']))
            $userField = $post['userfield'];
        if (isset($post['model']))
            $userModel = $post['model'];
        else
            $userModel = Yii::$app->getUser()->identityClass;

        $model = new Chat;
        $model->userModel = $userModel;
        if ($userField)
            $model->userField = $userField;
        if ($message) {
            $model->message = $message;
            $model->userId = Yii::$app->user->id;

            if ($model->save()) {
                echo $model->data();
            } else {
                print_r($model->getErrors());
                exit(0);
            }
        } else {
            echo $model->data();
        }
    }
}
