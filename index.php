<?php
function load_env_file($path)
{
    if (!is_file($path) || !is_readable($path)) {
        return;
    }

    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0 || strpos($line, '=') === false) {
            continue;
        }

        list($key, $value) = array_map('trim', explode('=', $line, 2));
        $value = trim($value, "\"'");
        if ($key !== '' && getenv($key) === false) {
            putenv($key . '=' . $value);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

load_env_file(__DIR__ . DIRECTORY_SEPARATOR . '.env');

// GUA UBAH DI SINI: Paksa ke mode development untuk tracking error flyer
defined('ENVIRONMENT') || define('ENVIRONMENT', 'development');
date_default_timezone_set('Asia/Jakarta');

if (ENVIRONMENT === 'production') {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    ini_set('log_errors', '1');
    error_reporting(E_ALL);
    set_exception_handler(function ($exception) {
        error_log(sprintf(
            '[Nara-HR] %s in %s:%d',
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine()
        ));
        if (!headers_sent()) {
            http_response_code(500);
            header('Content-Type: text/plain; charset=UTF-8');
        }
        echo 'Terjadi gangguan sementara. Silakan coba kembali beberapa saat lagi.';
    });
}else {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
}

if (!headers_sent()) {
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
    $forwarded_proto = strtolower((string) ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ''));
    if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $forwarded_proto === 'https') {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
}

$system_path = 'system';
$application_folder = 'application';

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', __DIR__ . DIRECTORY_SEPARATOR . $system_path . DIRECTORY_SEPARATOR);
define('APPPATH', __DIR__ . DIRECTORY_SEPARATOR . $application_folder . DIRECTORY_SEPARATOR);
define('VIEWPATH', APPPATH . 'views' . DIRECTORY_SEPARATOR);
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

require_once BASEPATH . 'core/CodeIgniter.php';