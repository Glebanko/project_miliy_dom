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
use backend\models\SignupForm;
use backend\models\User;
use frontend\models\ContactForm;
use backend\models\Category;
use backend\models\Goods;
use backend\models\Basket;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex(){
        return $this->render('index');
    }
    public function actionGobasket(){
        $idGoods = $_POST['id'];
        $model = new Basket;
                $model -> id_goods = $_POST['id'];
                $model -> id_user = Yii::$app->user->identity->id;
                $model -> active = '1';
                $model -> amount = '1';
                $model -> save();
    }
    public function actionSearchgoods()
    {
       if (Yii::$app->request->post()){
           $namegoods = Yii::$app->request->post('goods');
           $goods = Goods::find()->with(['article', 'image', 'price', 'size'])->andFilterWhere(['like', 'title', $namegoods])->asArray()->all();
           return $this->render('searchgoods', ['goods' => $goods, 'namegoods' => $namegoods]);
       }
    }
    public function actionAmountgoods(){
        $idUser = Yii::$app->user->identity->id;
        $amountbasket = Basket::find()->where(['id_user' => $idUser])->where(['active' => '1'])->asArray()->all();
        $amount = count($amountbasket);
        return $amount;
    }
    public function actionGoods(){
        if (Yii::$app -> request -> get('id')) {
            $good = Category::find()->with(['goods.article', 'goods.image', 'goods.price', 'goods.size', 'parent'])->where(['slug_category' => Yii::$app -> request -> get('id')]) -> asArray() -> one();
            return $this -> render('goods', ['goods' => $good]);
        }else {
            return $this->render('error');
        }
    }
    public function actionProfile()
    {
            if(!Yii::$app->user->isGuest){
                return $this->render('profile');
            }else{
                return $this->redirect('/');
            }
    }
    public function actionFilter()
    {
        if (Yii::$app->request->get('sortCategory')){
            $key = Yii::$app -> request -> get('sortCategory');
            $good = Category::find()->with(['goods.article', 'goods.image', 'goods.price', 'goods.size', 'parent'])->where(['slug_category' => $key])-> asArray() -> many();
            return $this -> render('goods', ['good' => $good]);
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

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */

    public function actionSignup(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignupForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $user = new User();
            $user->username = $model->username;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            if($user->save()){
                return $this->goHome();
            }
        }

        return $this->render('signup', compact('model'));
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
