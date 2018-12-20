<?php
namespace backend\models;
use yii\imagine\Image;
use yii\base\Model;
use Yii;
class Imageresize extends Model{
    public function imagerisizegods($uploadPath,$filenames,$model){
        $path = $uploadPath;
        $img = Image::getImagine()->open($path . '' . $filenames);
        $size = $img->getSize();
        $ratio = $size->getWidth() / $size->getHeight();
        Image::thumbnail($path . $filenames, 122,122)->save($path . 'avatar-' . $filenames, ['quality' => 90]);//+
        $heightgods = round( 187 / $ratio);
        $heightgods = round( 180 / $ratio);
        Image::thumbnail($path . $filenames, 180,$heightgods)->save($path . 'recomended-' . $filenames, ['quality' => 90]);//+
        return true;
    }
    public function imagerisizenews($uploadPath,$filenames,$model){
        $path = $uploadPath;
        $img = Image::getImagine()->open($path . '' . $filenames);
        $size = $img->getSize();
        $ratio = $size->getWidth() / $size->getHeight();
        $heightgods = round( 187 / $ratio);
        Image::thumbnail($path . $filenames, 180,$heightgods)->save($path . 'gods-' . $filenames, ['quality' => 70]);//+ news
        $heightgods = round( 180 / $ratio);
        Image::thumbnail($path . $filenames, 510,345)->save($path . 'news-' . $filenames, ['quality' => 70]);//+ news

        return true;
    }

    public function imagerisizeCar($uploadPath,$filenames){
        $path = $uploadPath;
        Image::thumbnail($path . '/' . $filenames, 50,42)->save($path . 'car-' . $filenames, ['quality' => 70]);
        return true;
    }

}
