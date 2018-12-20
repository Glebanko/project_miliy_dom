<?php
namespace backend\models;


use backend\modules\yandex\models\Category;
use common\models\Addlfeild;
use common\models\Catgodpost;
use common\models\Gods;
use common\models\Image;
use Intervention\Image\ImageManager;
use backend\models\Imageresize;
use yii\base\Model;
use Yii;
use dosamigos\transliterator\TransliteratorHelper;
class Parserphp extends Model
{
    public $files;
    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'txt, php']
        ];
    }

    public function upload($path, $years, $mounts, $files_to)
    {
        if (file_exists(Yii::getAlias('@frontend/web/') . $path . '/' . $years . '/' . $mounts . '/')) {
        } else {
            mkdir(Yii::getAlias('@frontend/web/') . $path . '/' . $years . '/' . $mounts . '/', 0775, true);
        }
        if($this->files->saveAs(Yii::getAlias('@frontend/web/') . $path . '/' . $years . '/' . $mounts . '/' . $files_to)){
            return true;}else{return false;}
    }

    public function PHPparses($arr){
        if ($arr['kat'] == "Котон" || $arr['kat'] == "Бязь" || $arr['kat'] == "Бязь Ранфорс" || $arr['kat'] == "Бязь Gold" || $arr['kat'] == "Поплин" || $arr['kat'] == "Атлас" || $arr['kat'] == "Сатин" || $arr['kat'] == "Атлас-Сатин" || $arr['kat'] == "Детское" || $arr['kat'] == "Дамаст" || $arr['kat'] == "Поликотон" || $arr['kat'] == "3D" || $arr['kat'] == "Микрофибра" || $arr['kat'] == "Полисатин") {
            if ($arr['id_prise'] == "1" || $arr['id_prise'] == "4" || $arr['id_prise'] == "119" || $arr['id_prise'] == "175") {
                $title = 'Постельное белье "' . $arr["title"] . '" бязь Ранфорс';
            } else if ($arr['id_prise'] == "127") {
                $title = 'Постельное белье "' . $arr["title"] . '" бязь Gold';
            }
        } else {
            $title = $arr["title"];
        }
        $goods=Gods::find()->where(['title'=>$title,'discription_gods'=>$arr['opisanie']])->one();
        if(isset($goods)){}else {
            $strArr = array('/', '\\', ',', '<', '>', '"', "ь", "ъ",);
            $theSlug = explode('(', strval($arr['title']));
            $slug = str_replace($strArr, '', $theSlug[0]);
            $slug = str_replace(' ', '-', $slug);
            $slugs = TransliteratorHelper::process($slug, '', 'en');
            $descriptions = strip_tags($arr['opisanie']);
            $descriptions = str_replace("&nbsp;", ' ', $descriptions);
            $descriptions = substr($descriptions, 0, 300);
            $descriptions = substr($descriptions, 0, strrpos($descriptions, ' '));
            $title = '';
            $errorSave = array();
            if ($arr['sale'] != 0) {
                $price_selling = $arr['sale'];
            } else {
                $price_selling = null;
            }
            if ($arr['pododeyalnik'] == 0) {
                $goods = new Gods([
                    'title' => $title,
                    'slug_gods' => $slugs,
                    'discription_gods' => $arr['opisanie'],
                    'id_prise' => $arr['id_prise'],
                    'create_at' => time(),
                    'price_selling' => $price_selling,
                    'quote' => $descriptions,
                    'linens' => 1,
                    'have' => $arr['nalichie'],
                    'idlenens' => 35
                ]);
            } elseif ($arr['prostyn'] == 0) {
                $goods = new Gods([
                    'title' => $title,
                    'slug_gods' => $slugs,
                    'discription_gods' => $arr['opisanie'],
                    'id_prise' => $arr['id_prise'],
                    'create_at' => time(),
                    'price_selling' => $price_selling,
                    'quote' => $descriptions,
                    'linens' => 1,
                    'have' => $arr['nalichie'],
                    'idlenens' => 41
                ]);
            } elseif ($arr['navolochka'] == 0) {
                $goods = new Gods([
                    'title' => $title,
                    'slug_gods' => $slugs,
                    'discription_gods' => $arr['opisanie'],
                    'id_prise' => $arr['id_prise'],
                    'create_at' => time(),
                    'price_selling' => $price_selling,
                    'quote' => $descriptions,
                    'linens' => 1,
                    'idlenens' => 69,
                    'have' => $arr['nalichie'],
                ]);
            } else {
                $goods = new Gods([
                    'title' => $title,
                    'slug_gods' => $slugs,
                    'discription_gods' => $arr['opisanie'],
                    'id_prise' => $arr['id_prise'],
                    'create_at' => time(),
                    'price_selling' => $price_selling,
                    'quote' => $descriptions,
                    'have' => $arr['nalichie'],
                ]);
            }
            if ($goods->save()) {
            } else {
                $errorSave[] = $goods->getErrors();
            }
            $category = Category::findOne(['name' => $arr['kat']]);
            if (isset($category)) {
                $catGoods = new Catgodpost([
                    'id_cat' => $category->id,
                    'id_gods' => $goods->id
                ]);
                if ($catGoods->save()) {
                } else {
                    $errorSave[] = $catGoods->getErrors();
                }
            }
            if ($arr['sale'] != 0) {
                $catSale = new Catgodpost([
                    'id_cat' => 64,
                    'id_gods' => $goods->id
                ]);
                if ($catSale->save()) {
                } else {
                    $errorSave[] = $catSale->getErrors();
                }
            }
            if ($arr['sport'] != 0) {
                $catSport = new Catgodpost([
                    'id_cat' => 48,
                    'id_gods' => $goods->id
                ]);
                if ($catSport->save()) {
                } else {
                    $errorSave[] = $catSport->getErrors();
                }
            }
            if ($arr['sport'] != 0) {
                $catSport = new Catgodpost([
                    'id_cat' => 48,
                    'id_gods' => $goods->id
                ]);
                if ($catSport->save()) {
                } else {
                    $errorSave[] = $catSport->getErrors();
                }
            }
            if ($arr['sportm'] != 0) {
                $catSportm = new Catgodpost([
                    'id_cat' => 49,
                    'id_gods' => $goods->id
                ]);
                if ($catSportm->save()) {
                } else {
                    $errorSave[] = $catSportm->getErrors();
                }
            }
            if ($arr['hit'] != 0) {
                $catHit = new Catgodpost([
                    'id_cat' => 49,
                    'id_gods' => $goods->id
                ]);
                if ($catHit->save()) {
                } else {
                    $errorSave[] = $catHit->getErrors();
                }
            }
            if ($arr['big'] != 0) {
                $catBig = new Catgodpost([
                    'id_cat' => 7,
                    'id_gods' => $goods->id
                ]);
                if ($catBig->save()) {
                } else {
                    $errorSave[] = $catBig->getErrors();
                }
            }
            if ($arr['big_m'] != 0) {
                $catBigm = new Catgodpost([
                    'id_cat' => 70,
                    'id_gods' => $goods->id
                ]);
                if ($catBigm->save()) {
                } else {
                    $errorSave[] = $catBigm->getErrors();
                }
            }
            if ($arr['tynika'] != 0) {
                $catTynika = new Catgodpost([
                    'id_cat' => 50,
                    'id_gods' => $goods->id
                ]);
                if ($catTynika->save()) {
                } else {
                    $errorSave[] = $catTynika->getErrors();
                }
            }
            if ($arr['ubka'] != 0) {
                $catUbka = new Catgodpost([
                    'id_cat' => 54,
                    'id_gods' => $goods->id
                ]);
                if ($catUbka->save()) {
                } else {
                    $errorSave[] = $catUbka->getErrors();
                }
            }
            if ($arr['pajamas'] != 0) {
                $catPajamas = new Catgodpost([
                    'id_cat' => 32,
                    'id_gods' => $goods->id
                ]);
                if ($catPajamas->save()) {
                } else {
                    $errorSave[] = $catPajamas->getErrors();
                }
            }
            if ($arr['prostyn'] != 0) {
                $catProstyn = new Catgodpost([
                    'id_cat' => 41,
                    'id_gods' => $goods->id
                ]);
                if ($catProstyn->save()) {
                } else {
                    $errorSave[] = $catProstyn->getErrors();
                }
            }
            if ($arr['pododeyalnik'] != 0) {
                $catPododeyalnik = new Catgodpost([
                    'id_cat' => 35,
                    'id_gods' => $goods->id
                ]);
                if ($catPododeyalnik->save()) {
                } else {
                    $errorSave[] = $catPododeyalnik->getErrors();
                }
            }
            if ($arr['navolochka'] != 0) {
                $catNavolochka = new Catgodpost([
                    'id_cat' => 69,
                    'id_gods' => $goods->id
                ]);
                if ($catNavolochka->save()) {
                } else {
                    $errorSave[] = $catNavolochka->getErrors();
                }
            }
            if ($arr['baby'] != 0) {
                $catBaby = new Catgodpost([
                    'id_cat' => 14,
                    'id_gods' => $goods->id
                ]);
                if ($catBaby->save()) {
                } else {
                    $errorSave[] = $catBaby->getErrors();
                }
            }
            if ($arr['3d'] != 0) {
                $catTreeD = new Catgodpost([
                    'id_cat' => 1,
                    'id_gods' => $goods->id
                ]);
                if ($catTreeD->save()) {
                } else {
                    $errorSave[] = $catTreeD->getErrors();
                }
            }
            if ($arr['3d'] != 0) {
                $catTreeD = new Catgodpost([
                    'id_cat' => 1,
                    'id_gods' => $goods->id
                ]);
                if ($catTreeD->save()) {
                } else {
                    $errorSave[] = $catTreeD->getErrors();
                }
            }
            if ($arr['animals'] != 0) {
                $catAnimals = new Catgodpost([
                    'id_cat' => 71,
                    'id_gods' => $goods->id
                ]);
                if ($catAnimals->save()) {
                } else {
                    $errorSave[] = $catAnimals->getErrors();
                }
            }
            if ($arr['shirts'] != 0) {
                $catShirts = new Catgodpost([
                    'id_cat' => 25,
                    'id_gods' => $goods->id
                ]);
                if ($catShirts->save()) {
                } else {
                    $errorSave[] = $catShirts->getErrors();
                }
            }
            if (isset($arr['artikul'])) {
                $size = $this->addFeild('article', $goods->id, $arr['artikul']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['size1'])) {
                $size = $this->addFeild('size1', $goods->id, $arr['size1']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['size2'])) {
                $size = $this->addFeild('size2', $goods->id, $arr['size2']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['size3'])) {
                $size = $this->addFeild('size3', $goods->id, $arr['size3']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['size4'])) {
                $size = $this->addFeild('size4', $goods->id, $arr['size4']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['size6'])) {
                $size = $this->addFeild('size3', $goods->id, $arr['size6']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['size6'])) {
                $size = $this->addFeild('size4', $goods->id, $arr['size6']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['shop'])) {
                $size = $this->addFeild('shop', $goods->id, $arr['shop']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['url'])) {
                $size = $this->addFeild('link_site', $goods->id, $arr['url']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['sostav'])) {
                $size = $this->addFeild('composition', $goods->id, $arr['sostav']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['country'])) {
                $size = $this->addFeild('country', $goods->id, $arr['country']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['days'])) {
                $size = $this->addFeild('delivery', $goods->id, $arr['days']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['sait'])) {
                $size = $this->addFeild('site', $goods->id, $arr['sait']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['dop'])) {
                $size = $this->addFeild('name_provider', $goods->id, $arr['dop']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['winter'])) {
                $size = $this->addFeild('winter', $goods->id, $arr['winter']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['spring'])) {
                $size = $this->addFeild('spring', $goods->id, $arr['spring']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['summer'])) {
                $size = $this->addFeild('summer', $goods->id, $arr['summer']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['fall'])) {
                $size = $this->addFeild('fall', $goods->id, $arr['fall']);
                if ($size) {
                    $errorSave[] = $size;
                }
            }
            if (isset($arr['img'])) {
                $picture = 'http://miliydom.com.ua/' . $arr['img'];
                if (empty($arr['img1'])) {
                    $this->saveImg($goods->id, $picture, 1, 1);
                } else {
                    $this->saveImg($goods->id, $picture, 0, 1);
                }
            }
            if ($arr['img1'] != 0) {
                $picture = 'http://miliydom.com.ua/' . $arr['img1'];
                $error=$this->saveImg($goods->id, $picture, 1, 0);
                return $error;
            }
            if ($arr['img2'] != 0) {
                $picture = 'http://miliydom.com.ua/' . $arr['img2'];
                $this->saveImg($goods->id, $picture);
            }
            if ($arr['img3'] != 0) {
                $picture = 'http://miliydom.com.ua/' . $arr['img3'];
                $this->saveImg($goods->id, $picture);
            }
            if ($arr['img4'] != 0) {
                $picture = 'http://miliydom.com.ua/' . $arr['img4'];
                $this->saveImg($goods->id, $picture);
            }
            if ($arr['img5'] != 0) {
                $picture = 'http://miliydom.com.ua/' . $arr['img5'];
                $this->saveImg($goods->id, $picture);
            }
            if ($arr['img6'] != 0) {
                $picture = 'http://miliydom.com.ua/' . $arr['img6'];
                $this->saveImg($goods->id, $picture);
            }
            if ($arr['img6'] != 0) {
                $picture = 'http://miliydom.com.ua/' . $arr['img6'];
                $this->saveImg($goods->id, $picture);
            }
            if ($arr['img7'] != 0) {
                $picture = 'http://miliydom.com.ua/' . $arr['img7'];
                $this->saveImg($goods->id, $picture);
            }
            return $arr['img1'];
        }
    }

    public function addFeild($key,$goodsId,$value){
        $addField =   new Addlfeild([
            'id_gods'    =>  $goodsId,
            'key_feild' =>  $key,
            'value'     =>  $value
        ]);
        if($addField->save()){
            return false;
        }else{
            return $addField->getErrors();
        }
    }

    public function saveImg($id,$picture,$forHome=0,$forFanky=0){
        $arrImg= explode("/",$picture);
        $files_to=array_pop($arrImg);
        $files_to=time().''.$files_to;
        $imageModel= Image::findOne(['id_gods'=>$id,"name"=>$files_to]);
        if(!isset($imageModel)) {
            $theModelImage= new Image();
            $years = date('Y');
            $mounts = date('m');
            if (file_exists(Yii::getAlias('@frontend/web/image/gods/'). $years . '/' . $mounts . '/')) {
            } else {
                mkdir(Yii::getAlias('@frontend/web/image/gods/'). $years . '/' . $mounts . '/', 0775, true);
            }
            $manager = new ImageManager(array('driver' => 'imagick'));
            try {
                $imag = $manager->make($picture);
                $imag->save(Yii::getAlias('@frontend') . '/web/image/gods/' . $years . '/' . $mounts . '/' . $files_to);
            }catch (\Intervention\Image\Exception\NotReadableException $e){
                $imag = $manager->make('http://miliydom.com.ua/logo/404.jpg');
                $imag->save(Yii::getAlias('@frontend') . '/web/image/gods/' . $years . '/' . $mounts . '/' . $files_to);
            }
            $theModelImage->path='gods/'. $years . '/' . $mounts . '/';
            $theModelImage->name=$files_to;
            $theModelImage->id_gods=$id;
            $theModelImage->forHome=$forHome;
            $theModelImage->forFancy=$forFanky;
            $theModelImage->save();
            $imageresize = new Imageresize();
            $uploadPath= Yii::getAlias('@frontend') .'/web/image/gods/' . $years . '/' . $mounts . '/';
            $imageresize->imagerisize($uploadPath,$files_to,$theModelImage);
        }
    }

}