<?php
require_once __DIR__ . '/../Models/Order.php';

interface OrderObserver
{
    public function update(Order $order): void;
}