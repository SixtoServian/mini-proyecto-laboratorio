<?php
require_once __DIR__ . '/OrderObserver.php';
require_once __DIR__ . '/EmailObserver.php';
require_once __DIR__ . '/SmsObserver.php';
require_once __DIR__ . '/DashboardObserver.php';

class OrderEvents
{
    private array $observers = [];

    public function __construct()
    {
        // Registramos los observadores por defecto para no romper el sistema
        $this->subscribe(new EmailObserver());
        $this->subscribe(new SmsObserver());
        $this->subscribe(new DashboardObserver());
    }

    public function subscribe(OrderObserver $observer): void
    {
        $this->observers[] = $observer;
    }

    public function pedidoCreado(Order $order): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($order);
        }
    }
}