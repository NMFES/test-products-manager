<?php
/* @var $this yii\web\View */

use app\components\Html;
use app\components\Helper;
use app\models\Users;
use yii\helpers\Url;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash(Users::USER_REGISTERED)): ?>
    <div class="alert alert-success text-center" role="alert">
        Поздравляем! Вы успешно зарегистрировались и можете <a href="<?= Url::to(['site/login']); ?>">войти</a> на сайт под своим логином.<br/>
    </div>
<?php else: ?>
    <?php if ($model->hasErrors()): ?>
        <div class="alert alert-danger" role="alert">
            <?= Helper::getErrorMessage($model->getErrors()); ?>
        </div>
    <?php endif; ?>
    <form class="form-horizontal" method="post">
        <div class="form-group">
            <label for="inputLogin" class="col-sm-4 control-label">Логин</label>
            <div class="col-sm-4">
                <input type="text" name="login" class="form-control" id="inputLogin" value="<?= Html::encode($model->login); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-4 control-label">Пароль</label>
            <div class="col-sm-4">
                <input type="password" name="password" class="form-control" id="inputPassword" value="<?= Html::encode($model->password); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-default">Зарегистрироваться</button>
            </div>
        </div>
    </form>
<?php endif; ?>

