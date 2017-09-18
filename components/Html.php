<?php

namespace app\components;

use Yii;

class Html extends \yii\helpers\Html {

    public static function encode($content, $doubleEncode = true) {
        $content = is_array($content) ? '' : (string) $content;

        return htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, Yii::$app ? Yii::$app->charset : 'UTF-8', $doubleEncode);
    }

}
