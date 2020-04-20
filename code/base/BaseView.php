<?php


namespace base;


class BaseView
{
    private static $layout = 'layout';
    private static $params = [];
    private static $template;

    public static function render()
    {
        $path = require_once 'views/' . self::$layout . '.php';
        return $path;
    }

    public function __construct($params = [], $template)
    {
        self::$params = $params;
        self::$template = $template;
        self::render();
    }
}