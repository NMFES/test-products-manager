<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $login
 * @property string $password
 * @property string $auth_key
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    // пользователь зарегистрировался
    const USER_REGISTERED = 'user_registered';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['login', 'required'],
            ['login', 'trim'],
            [['login'], 'string', 'max' => 20],
            ['password', 'required'],
            [['password'], 'string', 'max' => 32],
            [['login'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

}
