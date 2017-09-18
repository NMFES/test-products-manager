<?php

namespace app\models;

use Yii;
use app\models\Users;

/**
 * This is the model class for table "products".
 *
 * @property string $id
 * @property string $title
 * @property string $price
 * @property string $user_id
 */
class Products extends \yii\db\ActiveRecord {

    // кол-во продуктов на странице
    const PRODUCTS_PER_PAGE = 10;
    // ИД флеш-сообщения об успешном добавлении
    const PRODUCT_ADDED = 'product_added';
    // товар отредактирован
    const PRODUCT_EDITED = 'product_edited';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['price', 'required'],
            ['price', 'double'],
            ['title', 'required'],
            ['title', 'trim'],
            ['title', 'string', 'min' => 4, 'max' => 100]
        ];
    }

    public function getUser() {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'price' => 'Цена'
        ];
    }

}
