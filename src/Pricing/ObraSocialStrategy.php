<?php
require_once __DIR__ . '/PricingStrategy.php';

final class ObraSocialStrategy implements PricingStrategy
{
    public function calculate(float $amount): float
    {
        return $amount * 0.7; // Descuento del 30%
    }
}