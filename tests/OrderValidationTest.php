<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Models/Order.php';

class OrderValidationTest extends TestCase
{
    // CASO POSITIVO: Se crea correctamente
    public function test_orden_valida()
    {
        $order = new Order(1, "Juan", 100, "particular");
        $this->assertEquals("Juan", $order->patient);
    }

    // CASO NEGATIVO: Monto negativo debe lanzar excepción
    public function test_orden_con_monto_negativo_lanza_excepcion()
    {
        $this->expectException(InvalidArgumentException::class);
        new Order(1, "Juan", -100, "particular");
    }
}