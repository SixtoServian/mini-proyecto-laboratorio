<?php
require_once __DIR__ . '/../Services/OrderService.php';
require_once __DIR__ . '/../Reports/ReportGenerator.php';

class OrderController
{
    /**
     * ✅ MVC: Recibe la entrada, delega al servicio y elige la vista.
     * Sin SQL, sin reglas de negocio y sin echo.
     */
    public function create(): void
    {
        // Usamos un buffer para capturar la salida del servicio y mandarla a la vista
        ob_start();
        (new OrderService())->procesarPedidoCompleto(
            (int) ($_GET['id'] ?? 1),
            $_GET['paciente'] ?? 'Juan Perez',
            (float) ($_GET['monto'] ?? 15000),
            $_GET['tipo'] ?? 'obra_social',
            'email',
            'paciente@mail.com'
        );
        $output = ob_get_clean();

        require __DIR__ . '/../../views/created.php';
    }

    /**
     * ✅ El controlador arma los datos (o los pide a un servicio) y se los pasa a la vista.
     */
    public function index(): void
    {
        // Datos preparados por el controlador (simulando la BD).
        // Nota: El total ya viene calculado.
        $pedidos = [
            ['id' => 1, 'paciente' => 'Juan Perez', 'total' => 15000 * 0.7],
            ['id' => 2, 'paciente' => 'Ana Gomez',  'total' => 22000],
        ];
        require __DIR__ . '/../../views/orders.php';
    }

    public function report(): void
    {
        $reporte = (new ReportGenerator())->generate('Pedidos del dia', true, true, true);
        require __DIR__ . '/../../views/report.php';
    }
}