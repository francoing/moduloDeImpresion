<?php
ob_start();
require_once __DIR__ . '/../../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

// Capturar HTML
ob_start();
include 'template.php';
$html = ob_get_clean();

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($html);
$html2pdf->output();