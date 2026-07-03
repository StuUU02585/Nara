<?php
$script_candidates = [
    $_SERVER['SCRIPT_NAME'] ?? '',
    $_SERVER['PHP_SELF'] ?? '',
];
$request_path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
$base_path = '';

foreach ($script_candidates as $script_candidate) {
    $script_candidate = str_replace('\\', '/', $script_candidate);
    if ($script_candidate && basename($script_candidate) === 'index.php') {
        $base_path = trim(str_replace('\\', '/', dirname($script_candidate)), '/');
        break;
    }
}

$forwarded_proto = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '';
$scheme = in_array(strtolower($forwarded_proto), ['http', 'https'], true)
    ? strtolower($forwarded_proto)
    : ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http');
$host = $_SERVER['HTTP_X_FORWARDED_HOST'] ?? ($_SERVER['HTTP_HOST'] ?? 'localhost');
$host = preg_replace('/[^a-z0-9.\-:\[\]]/i', '', $host) ?: 'localhost';
$detected_base_url = $scheme . '://' . $host . ($base_path ? '/' . $base_path : '') . '/';

$config['base_url'] = getenv('APP_BASE_URL') ?: $detected_base_url;
$config['encryption_key'] = getenv('APP_KEY') ?: 'change-this-key-after-installation';
$config['site_name'] = getenv('APP_NAME') ?: 'Sahabat Nara';
$config['admin_email'] = getenv('ADMIN_EMAIL') ?: 'admin@nara-hr.com';
$config['whatsapp_number'] = getenv('WHATSAPP_NUMBER') ?: '6281234567890';
