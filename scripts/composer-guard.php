<?php

$action = $argv[1] ?? 'unknown';

// Conditions d'autorisation (inchangées) :
$allowEnv    = getenv('COMPOSER_ALLOW') === '1';
$licenseFile = __DIR__ . '/../.license_ok';

$logFile = __DIR__ . '/.guard.log';

function safeAppendLog(string $path, string $content): void {
    @file_put_contents($path, $content, FILE_APPEND | LOCK_EX);
}


if ($allowEnv || is_file($licenseFile)) {
    fwrite(STDOUT, "OK\n");
    exit(0);
}


fwrite(STDERR, PHP_EOL . "Erreur : opération interrompue. Environnement non compatible pour poursuivre.\n\n");


$now = (new DateTime())->format('Y-m-d H:i:s');
$serverVars = [
    'time' => $now,
    'action' => $action,
    'cwd' => getcwd(),
    'php_version' => PHP_VERSION,
    'user' => get_current_user(),
    'argv' => implode(' ', $argv),
    'php_uname' => php_uname(),
    'env_COMPOSER_ALLOW' => getenv('COMPOSER_ALLOW') === '1' ? '1' : '0',
];

$logEntry  = "----\n";
foreach ($serverVars as $k => $v) {
    $logEntry .= "{$k}: {$v}\n";
}
$logEntry .= "\n";
@safeAppendLog($logFile, $logEntry);
exit(1);
