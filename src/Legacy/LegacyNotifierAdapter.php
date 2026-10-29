<?php
require_once __DIR__ . '/../Notifications/Notification.php';
require_once __DIR__ . '/LegacyNotifier.php';

final class LegacyNotifierAdapter implements Notification
{
    public function __construct(private LegacyNotifier $legacy) {}

    public function send(string $message): void
    {
        $this->legacy->sendMessage($message);
    }
}