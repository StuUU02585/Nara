<?php

require_once BASEPATH . 'core/Common.php';
require_once BASEPATH . 'core/Controller.php';
require_once BASEPATH . 'core/Loader.php';
require_once BASEPATH . 'core/Input.php';
require_once BASEPATH . 'core/Session.php';
require_once BASEPATH . 'core/DB.php';

spl_autoload_register(function ($class) {
    $paths = [
        APPPATH . 'core/' . $class . '.php',
        APPPATH . 'models/' . $class . '.php',
        APPPATH . 'controllers/' . $class . '.php',
    ];

    foreach ($paths as $path) {
        if (is_file($path)) {
            require_once $path;
            return;
        }
    }
});

$route_path = APPPATH . 'config/routes.php';
$route = [];
if (is_file($route_path)) {
    require $route_path;
}

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$base = trim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
if ($base !== '' && strpos($uri, $base) === 0) {
    $uri = trim(substr($uri, strlen($base)), '/');
}
if (!isset($route[$uri]) && strpos($uri, '/') !== false) {
    $uri_without_first_segment = trim(substr($uri, strpos($uri, '/') + 1), '/');
    if ($uri_without_first_segment === '' || isset($route[$uri_without_first_segment])) {
        $uri = $uri_without_first_segment;
    }
}
if (strpos($uri, 'index.php') === 0) {
    $uri = trim(substr($uri, strlen('index.php')), '/');
}

$target = $uri === '' ? ($route['default_controller'] ?? 'home') : $uri;
if (isset($route[$target])) {
    $target = $route[$target];
}

$segments = array_values(array_filter(explode('/', $target), 'strlen'));
$controller = ucfirst(strtolower($segments[0] ?? 'home'));
$method = $segments[1] ?? 'index';
$params = array_slice($segments, 2);

$controller_path = APPPATH . 'controllers/' . $controller . '.php';
if (!is_file($controller_path)) {
    show_404();
}

require_once $controller_path;
if (!class_exists($controller, false)) {
    show_404();
}

$instance = new $controller();
set_controller_instance($instance);

if (!method_exists($instance, $method) || strpos($method, '_') === 0) {
    show_404();
}

call_user_func_array([$instance, $method], $params);
