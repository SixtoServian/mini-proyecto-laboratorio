<?php
require_once __DIR__ . '/PricingStrategy.php';

final class JubiladoStrategy implements PricingStrategy
{
    public function calculate(float $amount): float
    {
        return $amount * 0.5; // Descuento del 50%
    }
}