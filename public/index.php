<?php
/**
 * ============================================================================
 *  PUNTO DE ENTRADA — Autoload + Config + Rutas
 * ============================================================================
 */

// 1. ✅ AUTOLOAD: Mapea clases a sus carpetas automáticamente.
spl_autoload_register(function (string $class): void {
    $paths = [
        __DIR__ . '/../src/Controllers/',
        __DIR__ . '/../src/Database/',
        __DIR__ . '/../src/Events/',
        __DIR__ . '/../src/Legacy/',
        __DIR__ . '/../src/Models/',
        __DIR__ . '/../src/Notifications/',
        __DIR__ . '/../src/Pricing/',
        __DIR__ . '/../src/Reports/',
        __DIR__ . '/../src/Services/',
        __DIR__ . '/../src/Repositories/',
    ];
    
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (is_file($file)) {
            require_once $file;
            return;
        }
    }
});

// 2. ✅ CONFIG EXTERNA: Las credenciales ya no están en el código.
$config = file_exists(__DIR__ . '/../config/database.php')
    ? require __DIR__ . '/../config/database.php'
    : require __DIR__ . '/../config/database.example.php';

// 3. ✅ TABLA DE RUTAS: Sin cadenas de if/elseif.
$accion = $_GET['accion'] ?? 'crear';
$controller = new OrderController();

$rutas = [
    'crear'   => fn() => $controller->create(),
    'listar'  => fn() => $controller->index(),
    'reporte' => fn() => $controller->report(),
];

if (isset($rutas[$accion])) {
    $rutas[$accion]();
} else {
    http_response_code(404);
    echo 'Accion no encontrada';
}