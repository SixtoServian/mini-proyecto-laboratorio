<?php
require_once __DIR__ . '/PricingStrategy.php';

final class PrepaidStrategy implements PricingStrategy
{
    public function calculate(float $amount): float
    {
        return $amount * 0.85; // 15% de descuento
    }
}