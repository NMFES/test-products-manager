<?php

use app\components\Html;
?>
<form class="form-horizontal" method="post">
    <div class="form-group">
        <label for="inputTitle" class="col-sm-4 control-label">Название</label>
        <div class="col-sm-4">
            <input type="text" name="title" class="form-control" id="inputTitle" value="<?= Html::encode($model->title); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPrice" class="col-sm-4 control-label">Цена</label>
        <div class="col-sm-4">
            <input type="text" name="price" class="form-control" id="inputPrice" placeholder="0.00" value="<?= Html::encode($model->price); ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-default">Сoхранить</button>
        </div>
    </div>
</form>