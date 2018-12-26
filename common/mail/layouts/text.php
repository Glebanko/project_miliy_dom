<?php
use yii\helpers\Html;

/* @var $this \yii\web\View views component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main views render result */
?>
<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<?php $this->endPage() ?>
