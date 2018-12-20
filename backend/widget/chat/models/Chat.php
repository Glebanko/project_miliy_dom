<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 09.09.17
 * Time: 11:30
 */

namespace backend\widget\chat\models;
use Yii;
use sintret\chat\ChatRoom;
use yii\helpers\Html;
use sintret\chat\models\Chat as Chats;
class Chat extends Chats
{
    public $userField;
    
    public function data() {
        $cahtRoom= new ChatRoom();
        $userField = $this->userField;
        $output = '';
        $models = Chat::records();
        if ($models)
            foreach ($models as $model) {
                if (isset($model->user->$userField)) {
                    $avatar = Yii::getAlias('@frontendWebroot').'/image/'.$model->user->$userField;
                } else{
                    $avatar = Yii::$app->assetManager->getPublishedUrl("@vendor/sintret/yii2-chat-adminlte/assets/img/avatar.png");
                }
                $output .= '<div class="item">'. Html::img($avatar).'
                <p class="message">
                    <a class="name" href="#">
                        <small class="text-muted pull-right" style="color:green"><i class="fa fa-clock-o"></i> ' . \kartik\helpers\Enum::timeElapsed(date('d-m-Y H:i:s',(strtotime($model->updateDate)+(7 * 60 * 60)))) . '</small>
                        ' . $model->user->username . '
                    </a>
                   ' . $model->message . '
                </p>
            </div>';
            }

        return $output;
    }

}