<?php

use app\components\Helper;
use app\models\Products;
use yii\helpers\Url;

$this->title = 'Добавление товара';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash(Products::PRODUCT_ADDED)): ?>
    <div class="alert alert-success text-center" role="alert">
        Товар добавлен<br/>
        <a href="<?= Url::to(); ?>">Добавить еще один</a>
    </div>
<?php else: ?>
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
<?php endif; ?>
