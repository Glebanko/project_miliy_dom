<?php if(isset($url)){ ?>
    <p class="dateText"><?= Yii::t('backend','URLPARSER');?> <?= date('d:m:Y',$url->vaelye) ?></p>
<?php } ?>
<?php if(isset($xml)){ ?>
    <p class="dateText"><?= Yii::t('backend','XMLPARSER');?> <?=date('d:m:Y',$xml->vaelye) ?></p>
<?php } ?>