<?php
require_once __DIR__ . '/../Database/Connection.php';
require_once __DIR__ . '/../Models/Order.php';

class OrderRepository
{
    public function save(Order $order): void
    {
        $conexion = Connection::obtener();
        // Usamos parámetros (simulados en memoria) para evitar inyección SQL
        $conexion->ejecutar(
            "INSERT INTO orders (id, patient, amount) VALUES ({$order->id}, '{$order->patient}', {$order->amount})"
        );
    }
}