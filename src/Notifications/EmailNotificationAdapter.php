<?php
require_once __DIR__ . '/Notification.php';
require_once __DIR__ . '/EmailNotification.php';

final class EmailNotificationAdapter implements Notification
{
    public function __construct(private string $to) {}

    public function send(string $message): void
    {
        (new EmailNotification())->enviarEmail($this->to, 'Pedido del laboratorio', $message);
    }
}