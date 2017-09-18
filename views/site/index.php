<?php
/* @var $this yii\web\View */

$this->title = 'My Yii Application';

use app\components\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-xs-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Цена</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product->id; ?></td>
                        <td><?= Html::encode($product->title); ?></td>
                        <td><?= $product->user_id ? Html::encode($product->user->login) : '<span style="color: #999">Неизвестный</span>'; ?></td>
                        <td><?= number_format($product->price, 2); ?></td>
                        <td>
                            <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->id == $product->user_id)): ?>
                                <a href="<?= Url::to(['site/edit', 'id' => $product->id]); ?>"><span class="glyphicon glyphicon-edit"></span></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="text-align: center">
            <?=
            LinkPager::widget([
                'pagination' => $pagination,
            ]);
            ?>
        </div>
    </div>
</div>
