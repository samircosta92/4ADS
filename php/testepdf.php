<?php
require_once "../dompdf/autoload.inc.php";
use Dompdf\Dompdf;

$pdf = new DomPdf();
$pdf -> loadHtml("<h2>Olá</h2>");
$pdf->render();
$pdf->stream("test.pdf",array("Attachment" => false));

?>