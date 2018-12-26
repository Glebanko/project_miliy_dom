<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@commonRoot', "http://".$_SERVER['SERVER_NAME'].'/common/');
Yii::setAlias('@frontendWebroot', "http://".$_SERVER['HTTP_HOST'].'/frontend/web/');
Yii::setAlias('@backendWebroot',  "http://".$_SERVER['HTTP_HOST'].'/backend/web/');
Yii::setAlias('@backendWeb', "http://".$_SERVER['HTTP_HOST'].'/backend/');
Yii::setAlias('@home', "http://".$_SERVER['HTTP_HOST']);
Yii::setAlias('@shop', dirname(dirname(__DIR__)) . '/shop');
