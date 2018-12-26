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
class BasketController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function actionBasket(){
        if(Yii::$app->user->isGuest){
            $goodsCookie = unserialize($_COOKIE['goods']);
            $amount = count($goodsCookie['goods']);
            $model = new \frontend\models\validate\validateFormBasket;
            $model->load(\Yii::$app->request->post());
            if ($model->validate()) {
                
            }else{
                $errors = $model->errors;
            }
            foreach ($goodsCookie['goods'] as $good) {
                $goodsId[] = $good['idGoods'];
            }
            foreach ($goodsCookie['goods'] as $good) {
                $goodsToCookie[] = $good;
            }
            $goods = Goods::find()->with(['article', 'image', 'price', 'size'])->where(['id' => $goodsId])->asArray()->all();
            //echo "<pre>"; var_dump($goodsi); echo "</pre>";
            return $this->render('basket', ['goods' => $goods, 'goodsId' => $goodsId, 'goodsToCookie' => $goodsToCookie, 'model' => $model, 'error' => $error]);
        }else{
            $model = new \frontend\models\validate\validateFormBasket;
            $model->load(\Yii::$app->request->post());
            if ($model->validate()) {
                
            }else{
                $errors = $model->errors;
            }
            $goods = Basket::find()->with(['goods', 'goods.article', 'goods.image', 'goods.price', 'goods.size'])->where(['confirmed' => '0'])->asArray()->all(); 
                return $this->render('basket', ['goods' => $goods, 'model' => $model, 'error' => $error]);
           
        }
    }
    public function actionMassivecookie(){
        $goodsCookie = unserialize($_COOKIE['goods']);
        $emptyCookie['goods'][] = null; 
        if(empty($goodsCookie)){
           setcookie('goods', serialize($emptyCookie));
        }
    }
    public function actionDeletebasketform(){
        if(Yii::$app->user->isGuest){
            if (Yii::$app->request->post()){
               $keyGoods = Yii::$app->request->post('keyGoods');
               $goodsCookie = unserialize($_COOKIE['goods']);
               unset($goodsCookie['goods'][$keyGoods]);
               $newArray['goods'] = array_values($goodsCookie['goods']);
               setcookie('goods', serialize($newArray));
               return $this->redirect('basket');
           }
       }else{
            if (Yii::$app->request->post()){
               $idGoods = Yii::$app->request->post('idGoods');
               $goods = Basket::find()->where(['id_goods' => $idGoods])->one();
               $goods->delete();
               return $this->redirect('basket');
           }
       }
    }
   public function actionGobasket(){
    $idGoods = $_POST['id'];
    $price = $_POST['price'];
    $model = new Basket;
            $model -> id_goods = $idGoods;
            $model -> id_user = Yii::$app->user->identity->id;
            $model -> active = '1';
            $model -> amount = '1';
            $model -> confirmed = '0';
            $model -> price = $price;
            $model -> save();
    }
    public function actionBasketrequest(){
        if (Yii::$app->request->post()){
            if(Yii::$app->user->isGuest){
                $goodsCookie = unserialize($_COOKIE['goods']);
                foreach ($goodsCookie['goods'] as $goods) {
                    $model = new Basket;
                        $model -> name = $_POST['validateFormBasket']['name'];
                        $model -> surname = $_POST['validateFormBasket']['surname'];
                        $model -> email = $_POST['validateFormBasket']['email'];
                        $model -> phone = $_POST['validateFormBasket']['phone'];
                        $model -> city = $_POST['validateFormBasket']['city'];
                        $model -> deliveryAddress = $_POST['validateFormBasket']['deliveryAddress'];
                        $model -> postOffice = $_POST['validateFormBasket']['postOffice'];
                        $model -> comments = $_POST['validateFormBasket']['comments'];
                        $model -> id_goods = $goods['idGoods'];
                        $model -> id_user = '0';
                        $model -> active = '0';
                        $model -> amount = $goods['amount'];
                        $model -> confirmed = '1';
                        $model -> price = $goods['price'];
                        $model -> color = $goods['color'];
                        $model -> size = $goods['size'];
                        $model -> save();
                }
                $psevdCookie['goods'][] = null;
                setcookie('goods', serialize($psevdCookie));
                return "
                    <h3 style='text-align: center;'>Спасибо! Ваш заказ принят.</h3>
                    <h3 style='text-align: center;'>В ближайшее время мы свяжемся с Вами!</h3></div>
                ";
            }else{
                $idUser = Yii::$app->user->identity->id;
                $models = Basket::find()->where(['id_user'=>$idUser])->all();
                foreach ($models as $model) {
                    $model -> name = $_POST['validateFormBasket']['name'];
                    $model -> surname = $_POST['validateFormBasket']['surname'];
                    $model -> email = $_POST['validateFormBasket']['email'];
                    $model -> phone = $_POST['validateFormBasket']['phone'];
                    $model -> city = $_POST['validateFormBasket']['city'];
                    $model -> deliveryAddress = $_POST['validateFormBasket']['deliveryAddress'];
                    $model -> postOffice = $_POST['validateFormBasket']['postOffice'];
                    $model -> comments = $_POST['validateFormBasket']['comments'];
                    $model -> confirmed = '1';
                    $model -> active = '0';
                    $model -> save();
                }
                return "
                    <h3 style='text-align: center;'>Спасибо! Ваш заказ принят.</h3>
                    <h3 style='text-align: center;'>В ближайшее время мы свяжемся с Вами!</h3></div>
                ";
            }
            
        }
    }
    public function actionGobasketcookie(){
        if(Yii::$app->user->isGuest){
            $idGoods = $_POST['id'];
            $color = $_POST['color'];
            $size = $_POST['size'];
            $price = $_POST['price'];
            $goodsCookie = unserialize($_COOKIE['goods']);
            if(empty($goodsCookie['goods'][0])){
                unset($goodsCookie);
            }
            $amount = count($goodsCookie["goods"]);
            $goodsCookie['goods'][$amount]['idGoods'] = $idGoods;
            $goodsCookie['goods'][$amount]['price'] = $price;
            $goodsCookie['goods'][$amount]['amount'] = 1;
            if($color == null){
                $goodsCookie['goods'][$amount]['color'] = "Не указан";
            }else{
                $goodsCookie['goods'][$amount]['color'] = $color;
            }
            if($size == null){
                $goodsCookie['goods'][$amount]['size'] = "Не указан";
            }else{
                $goodsCookie['goods'][$amount]['size'] = $size;
            }
            setcookie('goods', serialize($goodsCookie));
        }else{
            $idGoods = $_POST['id'];
            $color = $_POST['color'];
            $size = $_POST['size'];
            $price = $_POST['price'];
            $model = new Basket;
                $model -> id_goods = $idGoods;
                $model -> id_user = Yii::$app->user->identity->id;
                $model -> active = '1';
                $model -> amount = '1';
                $model -> confirmed = '0';
                $model -> color = $color;
                $model -> size = $size;
                $model -> price = $price;
                $model -> save();
        }
    }
    public function actionSearchcookie(){
        $goods = unserialize($_COOKIE['goods']);
        if(isset($goods['goods']) and $goods['goods'][0] != null){
           $amount = count($goods['goods']);
           return $amount;
        }else{
            return 0;
        }
    }
    public function actionAmountgoods(){
        $idUser = Yii::$app->user->identity->id;
        $amountbasket = Basket::find()->where(['id_user' => $idUser])->where(['active' => '1'])->asArray()->all();
        $amount = count($amountbasket);
        return $amount;
    }
}
