<?php
require_once __DIR__ . '/../Pricing/PriceCalculator.php';
require_once __DIR__ . '/../Notifications/NotificationFactory.php';
require_once __DIR__ . '/../Events/OrderEvents.php';
require_once __DIR__ . '/../Reports/ReportGenerator.php';
require_once __DIR__ . '/../Models/Order.php';
require_once __DIR__ . '/../Repositories/OrderRepository.php';

class OrderService
{
    public function procesarPedidoCompleto(
        int $id,
        string $paciente,
        float $monto,
        string $tipoPaciente,
        string $tipoNotificacion,
        string $destino
    ): void {
        if (trim($paciente) === '') { echo 'Falta el paciente<br>'; return; }
        if ($monto <= 0) { echo 'Monto invalido<br>'; return; }

        // El precio ahora se calcula con Strategy
        $total = (new PriceCalculator())->calcular($monto, $tipoPaciente);
        
        // El modelo ahora es inmutable y la persistencia va al Repositorio
        $order = new Order($id, $paciente, $total, $tipoPaciente);
        (new OrderRepository())->save($order);

        NotificationFactory::create($tipoNotificacion, $destino)->send("Pedido {$id} por $ {$total}");
        (new OrderEvents())->pedidoCreado($order);
        echo (new ReportGenerator())->generate("Pedido {$id}", true, true, false) . '<br>';
        echo "<p>Pedido {$id} procesado. Total: $ {$total}</p>";
    }
}