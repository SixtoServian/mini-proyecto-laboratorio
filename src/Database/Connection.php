<?php
/**
 * ============================================================================
 *  CONEXION A LA BASE DE DATOS — SINGLETON
 * ============================================================================
 *  ✅ Constructor privado + instancia estatica + obtener() como punto unico.
 *  ✅ La excepcion se relanza: fallar rapido y fuerte.
 * ============================================================================
 */

class Connection
{
    /** Almacen en memoria compartido (demo sin MySQL). */
    private static array $tablaEnMemoria = [];

    /** ✅ Instancia unica. */
    private static ?Connection $instance = null;

    /** ✅ Constructor privado: nadie puede instanciar Connection desde afuera. */
    private function __construct() {}

    /**
     * ✅ Punto unico de acceso. Devuelve siempre la misma instancia.
     */
    public static function obtener(): Connection
    {
        if (self::$instance === null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function ejecutar(string $sql): void
    {
        try {
            self::$tablaEnMemoria[] = $sql;
        } catch (Throwable $e) {
            // ✅ Loguear y relanzar: nunca tragarse el error.
            throw new RuntimeException('Error al ejecutar consulta', 0, $e);
        }
    }

    public function consultas(): array
    {
        return self::$tablaEnMemoria;
    }
}