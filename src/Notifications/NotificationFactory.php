<?php
require_once __DIR__ . '/Notification.php';
require_once __DIR__ . '/EmailNotificationAdapter.php';
require_once __DIR__ . '/SmsNotificationAdapter.php';

final class NotificationFactory
{
    public static function create(string $type, string $destino): Notification
    {
        return match ($type) {
            'email' => new EmailNotificationAdapter($destino),
            'sms'   => new SmsNotificationAdapter($destino),
            default => throw new InvalidArgumentException("Tipo de notificacion no soportado: {$type}"),
        };
    }
}