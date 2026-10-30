<?php
/**
 * ============================================================================
 *  SISTEMA HEREDADO DEL LABORATORIO — ADAPTER
 * ============================================================================
 *  ✅ La clase de terceros queda intacta: solo su metodo original.
 *  ✅ La adaptacion vive afuera, en LegacyNotifierAdapter.
 * ============================================================================
 */

class LegacyNotifier
{
    /** Metodo original del proveedor. No lo tocamos. */
    public function sendMessage(string $text): void
    {
        echo "[LEGACY] {$text}<br>";
    }
}