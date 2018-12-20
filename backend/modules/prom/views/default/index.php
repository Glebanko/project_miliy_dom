<?php
use yii\helpers\Html;
$writer = new XMLWriter();
$writer->openUri('php://output');

$writer->startDocument('1.0', 'UTF-8');
$writer->startDtd('yml_catalog SYSTEM "shops.dtd"');
$writer->endDtd();

$writer->startElement('yml_catalog');
$writer->writeAttribute('date', date('Y-m-d H:i'));
$writer->startElement('shop');

$writer->writeElement('name', Html::encode($shop->name));
$writer->writeElement('company', Html::encode($shop->company));
$writer->writeElement('url', Html::encode($shop->url));

foreach ($shop->optionalAttributes as $attribute) {
    if (empty($shop->$attribute)) {
        continue;
    }

    if (is_array($shop->$attribute)) {
        foreach ($shop->$attribute as $value) {
            $writer->writeElement($attribute, Html::encode($value));
        }
    } else {
        $writer->writeElement($attribute, Html::encode($shop->$attribute));
    }
}

// <currencies>
$writer->startElement('currencies');
foreach ($shop->currencies as $currency) {
    $writer->startElement('currency');
    $writer->writeAttribute('id', Html::encode($currency['id']));
    $writer->writeAttribute('rate', Html::encode($currency['rate']));
    $writer->endElement();
}
$writer->endElement();
$writer->startElement('categories');
foreach ($shop->categories as $category) {
    $writer->startElement('category');

    $writer->writeAttribute('id', Html::encode($category['id']));
    if ($category['parentId']) {
        $writer->writeAttribute('parentId', Html::encode($category['parentId']));
    }
    $writer->writeRaw(Html::encode($category['name']));

    $writer->endElement();
}
$writer->endElement();
$writer->startElement('offers');

foreach ($shop->offers as $offer) {
    $arrId=array();
    foreach ($offer->offerElementAttributes as $attribute) {
        foreach ($offer->offerElementAttributes as $attribute) {
            if($attribute=='id'){
                $arrId=$offer->$attribute;

            }
        }
    }

    /** @var $offer \backend\modules\prom\models\promOffer */
if ($offer->errors) {
        continue;
    }
    if(isset($offer->categoryId)){
        foreach ($offer->categoryId as $cat) {
            if($cat!=95){
                $writer->startElement('offer');
                foreach ($offer->offerElementAttributes as $attribute) {
                    if (!empty($offer->$attribute)) {
                        if ($attribute == 'id') {
    
                            $writer->writeAttribute($attribute, $arrId[$cat]);
                        } else {
                            $writer->writeAttribute($attribute, Html::encode($offer->$attribute));
                        }
                    }
                }
    
                foreach ($offer->getOfferElements() as $attribute) {
                    if (empty($offer->$attribute)) {
                        continue;
                    }
                    if (is_array($offer->$attribute)) {
                        foreach ($offer->$attribute as $name => $value) {
                            if ($attribute != 'customAttributes') {
                                if ($attribute == 'categoryId') {
                                } else {
                                    $writer->writeElement($attribute, Html::encode($value));
                                }
                            }
                        }
                    } else {
                        $writer->writeElement($attribute, Html::encode($offer->$attribute));
                    }
                }
                $writer->writeElement('categoryId', $cat);
                if (is_array($offer->param)) {
                    foreach ($offer->param as $param) {
                        $writer->startElement('param');
                        $writer->writeAttribute('name', $param['name']);
                        $writer->text($param['value']);
                        $writer->endElement();
                    }
                }
                if (is_array($offer->customAttributes)) {
                    foreach ($offer->customAttributes as $name => $value) {
                        $writer->writeElement($name, Html::encode($value));
                    }
                }
                $writer->endElement();
            }
        }
    }else {
        $writer->startElement('offer');

        foreach ($offer->offerElementAttributes as $attribute) {
            if (!empty($offer->$attribute)) {
                $writer->writeAttribute($attribute, Html::encode($offer->$attribute));
            }
        }
        foreach ($offer->getOfferElements() as $attribute) {
            if (empty($offer->$attribute)) {
                continue;
            }
            if (is_array($offer->$attribute)) {
                foreach ($offer->$attribute as $name => $value) {
                    if ($name != 'keywords') {
                        $writer->writeElement($attribute, Html::encode($value));
                    }
                }
            } else {
                $writer->writeElement($attribute, Html::encode($offer->$attribute));
            }
        }
        if (is_array($offer->param)) {
            foreach ($offer->param as $param) {
                $writer->startElement('param');
                $writer->writeAttribute('name', $param['name']);
                $writer->text($param['value']);
                $writer->endElement();
            }
        }
        if (is_array($offer->customAttributes)) {
            foreach ($offer->customAttributes as $name => $value) {
                $writer->writeElement($name, Html::encode($value));
            }
        }
        $writer->endElement();
    }
}
$writer->endElement();
$writer->fullEndElement();
$writer->fullEndElement();
$writer->endDocument();