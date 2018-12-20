<?php
use yii\helpers\Html;
use yii\widgets\MaskedInput;
use yii\bootstrap\Nav;

/**
 * @var \yii\web\View $this
 * @var \dektrium\user\models\User $user
 * @var string $content
 */

$this->title = Yii::t('user', 'Update user account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<?= $this->render('_menu') ?>

<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= Nav::widget([
                    'options' => [
                        'class' => 'nav-pills nav-stacked',
                    ],
                    'items' => [
                        [
                            'label' => Yii::t('user', 'Account details'),
                            'url' => ['/user/admin/update', 'id' => $user->id]
                        ],
                        [
                            'label' => Yii::t('user', 'Profile details'),
                            'url' => ['/user/admin/update-profile', 'id' => $user->id]
                        ],
                        ['label' => Yii::t('user', 'Information'), 'url' => ['/user/admin/info', 'id' => $user->id]],
                        [
                            'label' => Yii::t('user', 'Assignments'),
                            'url' => ['/user/admin/assignments', 'id' => $user->id],
                            'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
                        ],
                        '<hr>',
                        [
                            'label' => Yii::t('user', 'Confirm'),
                            'url' => ['/user/admin/confirm', 'id' => $user->id],
                            'visible' => !$user->isConfirmed,
                            'linkOptions' => [
                                'class' => 'text-success',
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('user', 'Are you sure you want to confirm this user?'),
                            ],
                        ],
                        [
                            'label' => Yii::t('user', 'Block'),
                            'url' => ['/user/admin/block', 'id' => $user->id],
                            'visible' => !$user->isBlocked,
                            'linkOptions' => [
                                'class' => 'text-danger',
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('user', 'Are you sure you want to block this user?'),
                            ],
                        ],
                        [
                            'label' => Yii::t('user', 'Unblock'),
                            'url' => ['/user/admin/block', 'id' => $user->id],
                            'visible' => $user->isBlocked,
                            'linkOptions' => [
                                'class' => 'text-success',
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('user', 'Are you sure you want to unblock this user?'),
                            ],
                        ],
                        [
                            'label' => Yii::t('user', 'Delete'),
                            'url' => ['/user/admin/delete', 'id' => $user->id],
                            'linkOptions' => [
                                'class' => 'text-danger',
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('user', 'Are you sure you want to delete this user?'),
                            ],
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php $form = \yii\widgets\ActiveForm::begin(['id' => 'profile-form','options' => ['class' => 'form-horizontal  col-md-11 col-md-offset-1']]); ?>
                <?= $form->field($model, 'name')->textInput()->label(Yii::t('backend','NAME')); ?>
                <?= $form->field($model, 'famaly')->textInput()->label(Yii::t('backend','FAMELY')); ?>
                <?= $form->field($model, 'email')->textInput() ?>
                <?= $form->field($model, 'adress')->textInput()->label(Yii::t('backend','ADRESSUSER')) ?>
                <?= $form->field($model, 'tel')->label(Yii::t('frontend', 'USERPHONE'))->widget(MaskedInput::className(), ['mask' => '+3 (999) 999 99 99',])->textInput(['placeholder' => Yii::t('frontend', 'USERPHONE')]); ?>
                <?= \zainiafzan\widget\Dropzone::widget([
                    'options' => [
                        'addRemoveLinks'    => true,
                        'url'               => 'profile',
                        'dictDefaultMessage'=> Yii::t('frontend','TEXTDROPFILE'),
                    ],
                    'clientEvents' => [
                        'complete' => "function(file,dataUrl){  
                            document.getElementById('user-avatar').setAttribute('value',file.name);
                            console.log(file.name);
                        }",
                        'success'=>'function(file){console.log(file)}',
                        'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
                    ]
                ])?>
                <?= $form->field($model, 'avatar')->hiddenInput()->label(false);?>
                <?= $form->field($model, 'discount')->textInput()->label(Yii::t('backend','DISCOUNT'));?>
                <?= $form->field($model, 'percent') ->radioList(['0' => Yii::t('backend','MONEY'), '1' => Yii::t('backend','PERCENT')]); ?>
                <?= $form->field($model, 'number_bonus') ->textInput()->label('Номер карточки бонуса'); ?>
                <div class="form-group">
                    <div class="col-lg-offset-15 col-lg-9">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend','CREATE') : Yii::t('backend','UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?><br>
                    </div>
                </div>
                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

