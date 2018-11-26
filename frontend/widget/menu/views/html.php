
<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<ul>
    <?= Html::tag('li',Html::a('Главная',Yii::$app->homeUrl)); ?>

    <?php foreach($menuArray as $menu ) {
        $count = 1;
        if (empty($menu['child'])) {
            echo Html::tag('li', Html::a($menu['name'], Url::to('goods/' . $menu['slug_category'])));
        } else { ?>
            <li>
                <?= Html::a($menu['name'], Url::to('goods/' . $menu['slug_category'])); ?>
                <ul>
                    <div class="col-md-3">
                        <?php foreach ($menu['child'] as $key => $arr) { ?>
                            <?= Html::tag('li', Html::a($arr['name'], Url::to('goods/' . $arr['slug_category']))); ?>
                            <?php if ($count % 3 == 0) {
                                echo "</div><div  class='col-md-3'>";
                            }
                            $count++;
                        } ?>
                    </div>
                </ul>
            </li>
        <?php }
    }?>

    <?= Html::tag('li',Html::a('Новости',Url::to(['/post/post/category']))); ?>
    <?= Html::tag('li',Html::a('Отзывы',Url::to(['/office/office/category','alias'=>'Otzyvy']))); ?>
</ul>