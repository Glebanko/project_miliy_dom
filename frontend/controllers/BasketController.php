<?php
namespace frontend\controllers;

use Shop\Entities\Basket;
use Shop\Forms\BasketForm;
use Shop\Forms\ValidateFormBasket;
use Shop\Services\BasketService;
use Yii;
use yii\web\Controller;

//use frontend\models\validate\validateFormBasket;

/**
 * Site controller
 */
class BasketController extends Controller
{
    public $service;

    public function __construct($id, $module,BasketService $service, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service=$service;
    }

    /**
     * {@inheritdoc}
     */

    public function actionBasket(){
        $form= new  ValidateFormBasket();
        if($form->load(Yii::$app->request->post())&&$form->validate()){
            if(Yii::$app->user->isGuest) {
                $goodsCookie = unserialize($_COOKIE['goods']);// todo хранить товар в куках плохая мысль используй redis
                $goods = $this->service->IsGuest($goodsCookie);
            }else{
                $goods =  $this->service->usertIdentity();
            }
            return $this->render(
                'basket', [
                    $goods,
                    'model' => $form]);
        }
        Yii::error($form->errors); //todo тут надо что то вернуть пустое
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
        $form=new BasketForm();
        if($form->load(Yii::$app->request->post(),'')&&$form->validate()){
            try{
                $this->service->create($form,Yii::$app->user->identity->id);
            }catch (\RuntimeException $e){
                Yii::error($e);
                Yii::$app->session->setFlash('error','Корзина не сохраниласьть обратитесь к администратору');
            }
        }
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
