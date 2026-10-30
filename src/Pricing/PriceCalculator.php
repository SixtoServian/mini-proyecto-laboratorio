<?php
require_once __DIR__ . '/PricingStrategy.php';
require_once __DIR__ . '/ParticularStrategy.php';
require_once __DIR__ . '/ObraSocialStrategy.php';
require_once __DIR__ . '/JubiladoStrategy.php';
require_once __DIR__ . '/PrepaidStrategy.php';

class PriceCalculator
{
    private PricingStrategy $strategy;

    public function __construct(?PricingStrategy $strategy = null)
    {
        // Por defecto usamos Particular, pero se puede inyectar otra.
        $this->strategy = $strategy ?? new ParticularStrategy();
    }

    public function calcular(float $monto, string $tipoPaciente): float
    {
        // Mantenemos la firma para no romper el sistema actual,
        // pero la lógica ahora delega en las estrategias.
        $strategy = match ($tipoPaciente) {
            'obra_social' => new ObraSocialStrategy(),
            'jubilado'    => new JubiladoStrategy(),
            'prepaga'     => new PrepaidStrategy(),
            default       => new ParticularStrategy(),
        };

        return $strategy->calculate($monto);
    }

    public function calcularConIva(float $monto, string $tipoPaciente): float
    {
        // Eliminamos la duplicación del 0.7. Ahora reutiliza el método calcular().
        return $this->calcular($monto, $tipoPaciente) * 1.21;
    }
}