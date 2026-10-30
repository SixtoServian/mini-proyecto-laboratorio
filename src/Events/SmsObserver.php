<?php
require_once __DIR__ . '/OrderObserver.php';
require_once __DIR__ . '/../Notifications/SmsNotification.php';

final class SmsObserver implements OrderObserver
{
    public function update(Order $order): void
    {
        $sms = new SmsNotification();
        $sms->mandarSms('3704000000', "Pedido {$order->id} creado");
    }
}