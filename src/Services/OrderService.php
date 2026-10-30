<?php
require_once __DIR__ . '/../Pricing/PriceCalculator.php';
require_once __DIR__ . '/../Notifications/NotificationFactory.php';
require_once __DIR__ . '/../Events/OrderEvents.php';
require_once __DIR__ . '/../Reports/ReportGenerator.php';
require_once __DIR__ . '/../Models/Order.php';

class OrderService
{
    /**
     * ✅ FACADE: orquesta los servicios cohesivos (Strategy, Factory, Observer, Decorator).
     * El método se redujo drásticamente y ya no tiene lógica de negocio embebida.
     */
    public function procesarPedidoCompleto(
        int $id,
        string $paciente,
        float $monto,
        string $tipoPaciente,
        string $tipoNotificacion,
        string $destino
    ): void {
        // 1. Validacion
        if (trim($paciente) === '') { echo 'Falta el paciente<br>'; return; }
        if ($monto <= 0) { echo 'Monto invalido<br>'; return; }

        // 2. Cálculo (Strategy)
        $total = (new PriceCalculator())->calcular($monto, $tipoPaciente);

        // 3. Persistencia
        $order = new Order($id, $paciente, $total, $tipoPaciente);
        $order->guardar();

        // 4. Notificación (Factory)
        NotificationFactory::create($tipoNotificacion, $destino)->send("Pedido {$id} por $ {$total}");

        // 5. Avisos internos (Observer)
        (new OrderEvents())->pedidoCreado($order);

        // 6. Reporte y presentación (Decorator)
        echo (new ReportGenerator())->generate("Pedido {$id}", true, true, false) . '<br>';
        echo "<p>Pedido {$id} procesado. Total: $ {$total}</p>";
    }
}