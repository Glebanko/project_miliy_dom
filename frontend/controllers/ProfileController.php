<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use common\model\SignupForm;
use common\model\User;
use frontend\models\ContactForm;
use common\model\Category;
use common\model\Goods;
use common\model\Basket;
use common\model\Color;
use frontend\models\validate\validateFormBasket;

/**
 * Site controller
 */
class ProfileController extends Controller
{
    /**
     * {@inheritdoc}
     */

   public function actionProfile()
    {
            if(!Yii::$app->user->isGuest){
                return $this->render('profile');
            }else{
                return $this->redirect('/');
            }
    }
    public function actionSettingsProfile(){
        if (Yii::$app->request->post()){
            $id = Yii::$app->request->post('id');
            $phone = Yii::$app->request->post('phone');
            $email = Yii::$app->request->post('email');
            $address = Yii::$app->request->post('address');
        }
        $model = User::find()->where(['id'=>$id])->one();
        $model->phone = $phone;
        $model->email = $email;
        $model->address = $address;
        $model->save();
        return $this->redirect('profile');
    }
    public function actionUploadImage(){
        $uploaddir =  $_SERVER['DOCUMENT_ROOT'] . '/frontend/web/userImage';
        $uploadfile = $uploaddir . '/' . basename($_FILES['userimage']['name']);

        if(Yii::$app->user->identity->image != null) {
            if (file_exists($uploaddir . '/' . Yii::$app->user->identity->image)) {
                unlink($uploaddir . '/' . Yii::$app->user->identity->image);
                move_uploaded_file($_FILES['userimage']['tmp_name'], $uploadfile);
                $id = Yii::$app->request->post('id');
                $image = $_FILES['userimage']['name'];

                $model = User::find()->where(['id' => $id])->one();
                $model->image = $image;
                $model->save();
                return $this->redirect('/profile');

            } else {
                move_uploaded_file($_FILES['userimage']['tmp_name'], $uploadfile);
                $id = Yii::$app->request->post('id');
                $image = $_FILES['userimage']['name'];

                $model = User::find()->where(['id' => $id])->one();
                $model->image = $image;
                $model->save();
                return $this->redirect('/profile');
            }
        }else{
            move_uploaded_file($_FILES['userimage']['tmp_name'], $uploadfile);
            $id = Yii::$app->request->post('id');
            $image = $_FILES['userimage']['name'];

            $model = User::find()->where(['id' => $id])->one();
            $model->image = $image;
            $model->save();
            return $this->redirect('/profile');
        }
    }
}
