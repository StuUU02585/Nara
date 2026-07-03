<?php

class CI_Session
{
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            $forwarded_proto = strtolower((string) ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ''));
            $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $forwarded_proto === 'https';
            ini_set('session.use_strict_mode', '1');
            ini_set('session.use_only_cookies', '1');
            session_name('NARAHRSESSID');
            if (PHP_VERSION_ID >= 70300) {
                session_set_cookie_params([
                    'lifetime' => 0,
                    'path' => '/',
                    'secure' => $secure,
                    'httponly' => true,
                    'samesite' => 'Lax',
                ]);
            } else {
                session_set_cookie_params(0, '/', '', $secure, true);
            }
            session_start();
        }
    }

    public function set_userdata($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $item => $item_value) {
                $_SESSION[$item] = $item_value;
            }
            return;
        }
        $_SESSION[$key] = $value;
    }

    public function userdata($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function unset_userdata($key)
    {
        unset($_SESSION[$key]);
    }

    public function regenerate()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
    }

    public function csrf_token()
    {
        if (empty($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['_csrf_token'];
    }

    public function validate_csrf($token)
    {
        $stored = $_SESSION['_csrf_token'] ?? '';
        return is_string($token) && $stored !== '' && hash_equals($stored, $token);
    }

    public function set_flashdata($key, $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public function flashdata($key)
    {
        $value = $_SESSION['_flash'][$key] ?? null;
        unset($_SESSION['_flash'][$key]);
        return $value;
    }
}
