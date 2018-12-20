<?php
use \common\models\Addlfeild;
use yii\helpers\Html;

foreach ($gods as $g){
    if(isset($g->sale)&&$g->sale!='0'&&$g->sale!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'sales' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->sport)&&$g->sport!='0'&&$g->sport!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'sport' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->sportm)&&$g->sportm!='0'&&$g->sportm!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'sportm' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->big)&&$g->big!='0'&&$g->big!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'big' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->bigm)&&$g->bigm!='0'&&$g->bigm!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'bigm' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->ubka)&&$g->ubka!='0'&&$g->ubka!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'skirt' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->tynika)&&$g->tynika!='0'&&$g->tynika!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'tunic' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->pajamas)&&$g->pajamas!='0'&&$g->pajamas!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'pajamas' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->prostyn)&&$g->prostyn!='0'&&$g->prostyn!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'sheet' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->pododeyalnik)&&$g->pododeyalnik!='0'&&$g->pododeyalnik!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'duvcover' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->navolochka)&&$g->navolochka!='0'&&$g->navolochka!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'pillowcase' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->baby)&&$g->baby!='0'&&$g->baby!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'baby' ,
            'value' => '1'
        ]);
            $model->save();
    }

    if(isset($g->d3)&&$g->d3!='0'&&$g->d3!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'3d' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->animals)&&$g->animals!='0'&&$g->animals!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'animal' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->byaz)&&$g->byaz!='0'&&$g->byaz!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'uncalico' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->winter)&&$g->winter!='0'&&$g->winter!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'winter' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->summer)&&$g->summer!='0'&&$g->summer!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'summer' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->spring)&&$g->spring!='0'&&$g->spring!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'spring' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->fall)&&$g->fall!='0'&&$g->fall!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'fall' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->article)&&$g->article!='0'&&$g->article!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'article' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->availability)&&$g->availability!='0'&&$g->availability!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'availability' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->composition)&&$g->composition!='0'&&$g->composition!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'composition' ,
            'value' => '1'
        ]);
            $model->save();
    }
    if(isset($g->text)&&$g->text!='0'&&$g->text!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'keywords' ,
            'value' => (string)$g->text
        ]);
            $model->save();
    }
    if(isset($g->country)&&$g->country!='0'&&$g->country!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'country' ,
            'value' => $g->country
        ]);
            $model->save();
    }
    if(isset($g->days)&&$g->days!='0'&&$g->days!=''){
        $model=new Addlfeild([
            'id_gods'=>$g->id,
            'key_feild' =>'delivery' ,
            'value' => $g->days
        ]);
            $model->save();
    }

}