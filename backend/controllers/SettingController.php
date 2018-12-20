<?php

namespace backend\controllers;

use backend\models\User;
use dektrium\user\controllers\AdminController;
use common\models\Image;
use yii\web\UploadedFile;
use backend\models\Imageresize;
use backend\models\Translit;
use Yii;

class SettingController extends AdminController
{

    public function actionUpdateProfile($id)
    {
        $model=User::findOne($id);
        if(empty($model)){
            $model = new User();}
        $imageModel=new Image();
        $transliterator= new Translit();
        $imagine= new Imageresize();
        $basepath='user/'.date('Y').'/'.date('m').'/';
        if (Yii::$app->request->isAjax) {
            $fileName = 'file';
            $uploadPath =Yii::getAlias('@frontend/web/image/').$basepath;
            if (isset($_FILES[$fileName])) {
                if (file_exists($uploadPath)) {
                } else {
                    mkdir($uploadPath, 0775, true);
                }
                $file = \yii\web\UploadedFile::getInstanceByName($fileName);
                $filenames=$transliterator->traranslitImg($file);
                if ($file->saveAs($uploadPath . '/' . $filenames)) {
                    $imagine->imagerisizeUser($uploadPath,$filenames,$file);
                    return $this->render('profile', [
                        'model'     => $model,
                        'user'      => $model
                    ]);
                }
            }
        }
        if($model->load(Yii::$app->request->post())){
            $profuser=Yii::$app->request->post('User');
            if(isset($profuser['avatar'])) {
                if ($model->avatar != $profuser['avatar']) {
                    $filenames = $transliterator->traranslitImg($profuser['avatar']);
                    $model->avatar = $basepath . '' . $filenames;
                }
            }
            if(isset($profuser['name'])) {
                if ($model->name != $profuser['name']) {
                    $model->name = $profuser['name'];
                }
            }
            if(isset($profuser['addres'])) {
                if ($model->addres != $profuser['addres']) {
                    $model->addres = $profuser['addres'];
                }
            }
            if(isset($profuser['tel'])) {
                if ($model->tel != $profuser['tel']) {
                    $model->tel = $profuser['tel'];
                }
            }
            if(isset($profuser['email'])) {
                if ($model->email != $profuser['email']) {
                    $model->email= $profuser['email'];
                }
            }
            if(isset($profuser['discount'])) {
                if ($model->discount != $profuser['discount']) {
                    $model->discount= $profuser['discount'];
                }
            }
            $model->save();
        }
        return $this->render('@backend/views/setting/profile.php', [
            'model' => $model,
            'user'      => $model
        ]);
    }

}