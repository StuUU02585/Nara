<?php

if (PHP_SAPI !== 'cli') {
    exit("This script must be run from CLI.\n");
}

$name = $argv[1] ?? null;
$email = $argv[2] ?? null;
$password = $argv[3] ?? null;

if (!$name || !$email || !$password || strlen($password) < 10) {
    exit("Usage: php tools/create_admin.php \"Nama Admin\" email@example.com \"password-minimal-10-karakter\"\n");
}

require __DIR__ . '/../application/config/database.php';
$cfg = $db['default'];

$mysqli = new mysqli($cfg['hostname'], $cfg['username'], $cfg['password'], $cfg['database']);
if ($mysqli->connect_errno) {
    exit("Database connection failed: {$mysqli->connect_error}\n");
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $mysqli->prepare('INSERT INTO admins (name, email, password_hash) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE name = VALUES(name), password_hash = VALUES(password_hash), is_active = 1');
$stmt->bind_param('sss', $name, $email, $hash);
$stmt->execute();

echo "Admin saved for {$email}\n";
