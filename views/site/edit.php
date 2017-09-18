<?php

use app\components\Helper;
use app\models\Products;

$this->title = 'Редактирование товара';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash(Products::PRODUCT_EDITED)): ?>
    <div class="alert alert-success text-center" role="alert">
        Товар отредактирован
    </div>
<?php endif; ?>
<?php if ($model->hasErrors()): ?>
    <div class="alert alert-danger" role="alert">
        <?= Helper::getErrorMessage($model->getErrors()); ?>
    </div>
<?php endif; ?>
<?=
$this->render('product_form', [
    'model' => $model
])
?>