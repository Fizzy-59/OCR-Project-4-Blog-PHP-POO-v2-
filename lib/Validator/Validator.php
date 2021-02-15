<?php


namespace Blog\Validator;


class Validator
{
    static function isEmpty($value)
    {
        if (empty($value)) {
            return true;
        }
        return false;
    }

    static function isNotAnEmail($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    static function checkMinMaxSmall($value) {
        $count = strlen($value);
        if($count < 3 || $count > 30) {
            return true;
        }
        return false;
    }

    static function checkMinMaxBig($value) {
        $count = strlen($value);
        if($count < 3 || $count > 200) {
            return true;
        }
        return false;
    }

}