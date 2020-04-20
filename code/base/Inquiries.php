<?php

namespace base;

class Inquiries
{
    public static $params = [];

    public static function post($post = null)
    {
        foreach($post ?? $_POST as $key => $items) {
            if ($key == 'submit') {
                continue;
            }
            self::$params[$key] = $items;
        }
        return self::$params;
    }

}