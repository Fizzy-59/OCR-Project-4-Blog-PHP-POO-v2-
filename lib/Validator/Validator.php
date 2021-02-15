<?php


namespace Blog\Validator;


class Validator
{
    static public function isEmpty($value)
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

}