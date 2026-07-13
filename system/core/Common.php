<?php

function config_item($item)
{
    static $config;
    if ($config === null) {
        $config = [];
        $path = APPPATH . 'config/config.php';
        if (is_file($path)) {
            require $path;
        }
    }
    return $config[$item] ?? null;
}

function base_url($uri = '')
{
    $base = rtrim(config_item('base_url') ?: '/', '/');
    return $base . '/' . ltrim($uri, '/');
}

function site_url($uri = '')
{
    return base_url($uri);
}

function html_escape($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect($uri)
{
    header('Location: ' . site_url($uri));
    exit;
}

function show_404()
{
    http_response_code(404);
    echo '404 - Halaman tidak ditemukan';
    exit;
}

function show_403()
{
    http_response_code(403);
    echo '403 - Permintaan tidak dapat diverifikasi';
    exit;
}

function set_value($field, $default = '')
{
    return html_escape($_POST[$field] ?? $default);
}

function set_controller_instance($instance)
{
    CI_Controller::$instance = $instance;
}

function get_instance()
{
    return CI_Controller::$instance;
}
