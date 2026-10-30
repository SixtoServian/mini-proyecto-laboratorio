<?php
require_once __DIR__ . '/Report.php';

final class PdfDecorator implements Report
{
    public function __construct(private Report $report) {}

    public function generate(): string
    {
        return $this->report->generate() . ' + PDF';
    }
}