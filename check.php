<?php
/**
 * Script de verificación para Render
 * Verifica que todas las extensiones necesarias estén disponibles
 */

echo "=== Verificación de Extensiones PHP ===\n\n";

$required_extensions = [
    'pdo',
    'pdo_pgsql',
    'pgsql'
];

$missing = [];
foreach ($required_extensions as $ext) {
    if (extension_loaded($ext)) {
        echo "✅ $ext: DISPONIBLE\n";
    } else {
        echo "❌ $ext: NO DISPONIBLE\n";
        $missing[] = $ext;
    }
}

echo "\n=== Información PHP ===\n";
echo "Versión PHP: " . PHP_VERSION . "\n";
echo "Versión PDO: " . (extension_loaded('pdo') ? PDO::VERSION : 'NO DISPONIBLE') . "\n";

echo "\n=== Variables de Entorno ===\n";
echo "DB_HOST: " . (getenv('DB_HOST') ?: 'NO CONFIGURADA') . "\n";
echo "DB_USER: " . (getenv('DB_USER') ?: 'NO CONFIGURADA') . "\n";
echo "DB_NAME: " . (getenv('DB_NAME') ?: 'NO CONFIGURADA') . "\n";
echo "DB_PORT: " . (getenv('DB_PORT') ?: 'NO CONFIGURADA') . "\n";

if (!empty($missing)) {
    echo "\n⚠️ ADVERTENCIA: Faltan extensiones requeridas: " . implode(', ', $missing) . "\n";
    exit(1);
} else {
    echo "\n✅ Todas las extensiones están disponibles\n";
    exit(0);
}
