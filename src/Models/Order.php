<?php
/**
 * ============================================================================
 *  MODELO Order
 * ============================================================================
 *  ✅ Propiedades readonly y validación en constructor.
 *  ✅ Persistencia delegada a OrderRepository.
 *  ✅ Cálculo de precio delegado a PriceCalculator (Strategy).
 * ============================================================================
 */

class Order
{
    public function __construct(
        public readonly int $id,
        public readonly string $patient,
        public readonly float $amount,
        public readonly string $patientType
    ) {
        if ($amount < 0) {
            throw new InvalidArgumentException('El importe no puede ser negativo');
        }
        if (trim($patient) === '') {
            throw new InvalidArgumentException('El paciente es obligatorio');
        }
    }
}