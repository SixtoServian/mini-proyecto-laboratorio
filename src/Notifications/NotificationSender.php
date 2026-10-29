<?php
require_once __DIR__ . '/NotificationFactory.php';

class NotificationSender
{
    /**
     * ✅ Delegacion en la fabrica: este archivo ya no conoce las clases concretas.
     */
    public function enviar(string $tipo, string $destino, string $mensaje): void
    {
        NotificationFactory::create($tipo, $destino)->send($mensaje);
    }
}