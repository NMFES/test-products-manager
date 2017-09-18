<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\Products;
use yii\data\Pagination;
use app\models\Users;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'add', 'error'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login', 'registration'],
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'edit'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex() {
        $query = Products::find()->orderBy('id DESC');

        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => Products::PRODUCTS_PER_PAGE,
            'forcePageParam' => false,
        ]);

        $products = $query->with('user')->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('index', [
                    'products' => $products,
                    'pagination' => $pagination
        ]);
    }

    public function actionAdd() {
        $model = new Products();

        if (Yii::$app->request->isPost) {
            $model->attributes = Yii::$app->request->post();

            if ($model->validate()) {
                $model->user_id = Yii::$app->user->isGuest ? 0 : Yii::$app->user->id;

                $model->save(false);

                Yii::$app->session->setFlash(Products::PRODUCT_ADDED);
                return $this->redirect(['site/add']);
            }
        }

        return $this->render('add', [
                    'model' => $model
        ]);
    }

    public function actionEdit($id) {
        $model = Products::findOne((int) $id);

        if (!is_object($model)) {
            throw new \yii\web\BadRequestHttpException('Товар не найден');
        }

        if ($model->user_id != Yii::$app->user->id) {
            throw new \yii\web\BadRequestHttpException('Вы не можете редактировать не свои товары');
        }

        if (Yii::$app->request->isPost) {
            $model->attributes = Yii::$app->request->post();

            if ($model->validate()) {
                $model->save(false);

                Yii::$app->session->setFlash(Products::PRODUCT_EDITED);
            }
        }

        return $this->render('edit', [
                    'model' => $model
        ]);
    }

    public function actionLogin() {
        $model = new LoginForm();

        if (Yii::$app->request->isPost) {
            $model->attributes = Yii::$app->request->post();

            if ($model->login()) {
                return $this->goHome();
            }
        }

        return $this->render('login', [
                    'model' => $model
        ]);
    }

    public function actionRegistration() {
        $model = new Users();

        if (Yii::$app->request->isPost) {
            $model->attributes = Yii::$app->request->post();

            if ($model->validate()) {
                $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                $model->auth_key = Yii::$app->security->generateRandomString();

                $model->save(false);

                Yii::$app->session->setFlash(Users::USER_REGISTERED);
                return $this->redirect(['site/registration']);
            }
        }

        return $this->render('registration', [
                    'model' => $model
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
