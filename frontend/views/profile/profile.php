<div class="container">
    <h1 class="profile-h1">Профиль</h1>
    <h2 class="profile-username"><?echo Yii::$app->user->identity->username?></h2>
    <div class="photo col-md-3">
        <img src="/userImage/<?if(Yii::$app->user->identity->image == "noImage" || Yii::$app->user->identity->image == null){echo "no-image/no-image.png";}else{echo"/" . Yii::$app->user->identity->image;}?>" width="255" height="255">

        <form enctype="multipart/form-data" action="upload-image" method="POST">
            <input name="userimage" type="file" class="form-control" />
            <input type="hidden" name="id" value="<? echo Yii::$app->user->identity->id?>">
            <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
            <input type="submit" class="form-control" value="Загрузить фото" />
        </form>
    </div>
    <div class="col-md-9">
        <div>
            <form action="settings-profile" method="post">
                <label class="control-label">Введите телефон</label>
                <input type="text" name="phone" class="form-control" value="<? echo Yii::$app->user->identity->phone?>">
                <label class="control-label">Введите Email</label>
                <input type="text" name="email" class="form-control" value="<? echo Yii::$app->user->identity->email?>">
                <label class="control-label">Введите Адрес</label>
                <input type="text" name="address" class="form-control" value="<? echo Yii::$app->user->identity->address?>">
                <input type="hidden" value="<? echo Yii::$app->user->identity->id?>" name="id">
                <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
                <button type="submit" class="btn btn-success profile-submit">Сохранить</button>
            </form>
        </div>
    </div>
</div>
<style>
    .profile-h1, .profile-username{
        text-align: center;
        margin: 0px;
    }
    .profile-submit{
        margin-top: 5px;
        float: right;
    }
</style>