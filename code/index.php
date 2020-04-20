<?php
setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');
date_default_timezone_set('Europe/Moscow');

function regModel($classname)
{
    $path = '../code/' . $classname . '.php';
    $path = str_replace('\\', '/', $path);
    require_once($path);
}

spl_autoload_register('regModel');

require_once('../code/config/router.php');