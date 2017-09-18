<?php

namespace app\components;

class Helper {

    public static function getError(array $errors) {
        if (!count($errors)) {
            return [];
        }

        $keys = array_keys($errors);

        $error = [
            'attribute' => $keys[0],
            'message' => $errors[$keys[0]][0]
        ];

        return $error;
    }

    public static function getErrorMessage(array $errors) {
        if (!count($errors)) {
            return '';
        }

        $error = self::getError($errors);

        return $error['message'];
    }

}
