<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Pricing/ObraSocialStrategy.php';
require_once __DIR__ . '/../src/Pricing/ParticularStrategy.php';

class PricingStrategyTest extends TestCase
{
    // CASO POSITIVO: Obra social aplica el 30% de descuento
    public function test_obra_social_calcula_descuento()
    {
        $strategy = new ObraSocialStrategy();
        $total = $strategy->calculate(1000);
        $this->assertEquals(700, $total); // 1000 * 0.7
    }

    // CASO NEGATIVO (Borde): Particular no aplica descuento
    public function test_particular_no_aplica_descuento()
    {
        $strategy = new ParticularStrategy();
        $total = $strategy->calculate(1000);
        $this->assertEquals(1000, $total);
    }
}