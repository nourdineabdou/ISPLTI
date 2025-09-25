<?php
// scripts/composer-guard.php
// Bloque composer install/update sauf si autorisé.
// Affiche UNIQUEMENT un message générique (aucune info sur le mécanisme de contournement).
// Log technique écrit localement dans scripts/.guard.log (pour le mainteneur uniquement).

$action = $argv[1] ?? 'unknown';

// Conditions d'autorisation (inchangées) :
$allowEnv    = getenv('COMPOSER_ALLOW') === '1';
$licenseFile = __DIR__ . '/../.license_ok'; // utilisé en interne, mais jamais affiché à l'utilisateur

$logFile = __DIR__ . '/.guard.log';

function safeAppendLog(string $path, string $content): void {
    @file_put_contents($path, $content, FILE_APPEND | LOCK_EX);
}

// Si autorisé, on laisse composer continuer
if ($allowEnv || is_file($licenseFile)) {
    fwrite(STDOUT, "OK\n");
    exit(0);
}

// ----- Message court et non-informatif affiché à l'utilisateur -----
fwrite(STDERR, PHP_EOL . "Erreur : opération interrompue. Environnement non compatible pour poursuivre.\n\n");

// ----- Log technique (accessible seulement au mainteneur) -----
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

// Essayer d'écrire le log sans déranger l'utilisateur si échec
@safeAppendLog($logFile, $logEntry);

// Retourner code d'erreur pour stopper composer
exit(1);
