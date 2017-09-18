<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use app\components\Html;
use app\components\Helper;

$this->title = 'Логин';
$this->params['breadcrumbs'][] = $this->title;
?>
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
        <div class="col-sm-offset-4 col-sm-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="rememberMe" value="1"> Запомнить меня
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-default">Войти</button>
        </div>
    </div>
</form>
