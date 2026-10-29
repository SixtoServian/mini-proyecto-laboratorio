<?php
require_once __DIR__ . '/Report.php';
require_once __DIR__ . '/BasicReport.php';
require_once __DIR__ . '/DigitalSignatureDecorator.php';
require_once __DIR__ . '/PdfDecorator.php';
require_once __DIR__ . '/WatermarkDecorator.php';

class ReportGenerator
{
    public function generate(
        string $contenido,
        bool $conFirmaDigital = false,
        bool $conPdf = false,
        bool $conMarcaDeAgua = false
    ): string {
        // El cliente arma la cadena de decoradores
        $reporte = new BasicReport($contenido);

        if ($conFirmaDigital) {
            $reporte = new DigitalSignatureDecorator($reporte);
        }
        if ($conPdf) {
            $reporte = new PdfDecorator($reporte);
        }
        if ($conMarcaDeAgua) {
            $reporte = new WatermarkDecorator($reporte);
        }

        return $reporte->generate();
    }
}