<?php
require_once __DIR__ . '/Notification.php';
require_once __DIR__ . '/SmsNotification.php';

final class SmsNotificationAdapter implements Notification
{
    public function __construct(private string $to) {}

    public function send(string $message): void
    {
        (new SmsNotification())->mandarSms($this->to, $message);
    }
}