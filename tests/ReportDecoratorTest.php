<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Reports/BasicReport.php';
require_once __DIR__ . '/../src/Reports/PdfDecorator.php';
require_once __DIR__ . '/../src/Reports/DigitalSignatureDecorator.php';

class ReportDecoratorTest extends TestCase
{
    public function test_reporte_basico_sin_decoradores()
    {
        $reporte = new BasicReport("Ventas");
        $this->assertEquals("Reporte: Ventas", $reporte->generate());
    }

    public function test_reporte_con_pdf_y_firma()
    {
        $reporte = new BasicReport("Ventas");
        $reporte = new PdfDecorator($reporte);
        $reporte = new DigitalSignatureDecorator($reporte);
        
        $this->assertEquals("Reporte: Ventas + PDF + firma digital", $reporte->generate());
    }
}