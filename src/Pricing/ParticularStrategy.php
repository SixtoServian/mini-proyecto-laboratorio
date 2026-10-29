<?php
require_once __DIR__ . '/PricingStrategy.php';

final class ParticularStrategy implements PricingStrategy
{
    public function calculate(float $amount): float
    {
        return $amount;
    }
}