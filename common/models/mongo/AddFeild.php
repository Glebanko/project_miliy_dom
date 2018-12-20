<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 01.12.17
 * Time: 16:05
 */

namespace common\models\mongo;
use yii\mongodb\ActiveRecord;

class AddFeild extends \yii2tech\embedded\mongodb\ActiveRecord
{
    public function attributes()
    {
        return ['_id','key','value'];
    }

}