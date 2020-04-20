<?php
if ($_SERVER['REQUEST_URI'] == '/') {
    header("Location: main/show");
    exit;

} elseif ($_SERVER['REQUEST_URI'] != '/') {
    $url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    $controller = ucfirst($url[0]) . 'Controller';
    $action = 'action' . ucfirst($url[1]);

    require_once('../code/controllers/' . $controller . '.php');
    $controller = 'controllers\\' . $controller;
    $classController = new $controller();

    if (!method_exists($classController, $action)) {
        echo 'ERROR 404';
    } else {
        $classController->$action();
    }
}