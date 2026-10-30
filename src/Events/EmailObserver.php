<?php
require_once __DIR__ . '/OrderObserver.php';
require_once __DIR__ . '/../Notifications/EmailNotification.php';

final class EmailObserver implements OrderObserver
{
    public function update(Order $order): void
    {
        $email = new EmailNotification();
        $email->enviarEmail('paciente@mail.com', 'Pedido creado', "Pedido {$order->id}");
    }
}