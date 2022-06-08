<?php
ini_set('memory_limit', '2048M');

$servidor = "localhost";
$usuario = "root";
$senha = "";
$nomeBanco = "biblioteca";
$conn = new mysqli($servidor,$usuario,$senha,$nomeBanco);

if($conn->connect_error)
{
    die("Não foi possível estabelecer uma conexão!".$conn->connect_error);
}


$html = '<table style="border: 1px solid black;border-collapse: collapse;margin:auto;">';
$html .= '<thead>';
$html .= '<tr style="border: 1px solid black;border-collapse: collapse">';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Código</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Nome</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Autor</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Editora</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Estoque</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Emprestados</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$sql = "SELECT * FROM `livros`";
$result = mysqli_query($conn, $sql);

while($linha = mysqli_fetch_assoc($result)){
    $html .= '<tr><td style="border: 1px solid black;border-collapse: collapse">'.$linha['cod'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['nome'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['autor'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['editora'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['qtdestoque'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['emprestados'] . "</td></tr>";
}

$html .= '</tbody>';
$html .= '</table>';


require_once "../dompdf/autoload.inc.php";
use Dompdf\Dompdf;
$pdf = new DomPdf();

$pdf -> loadHtml('<h1 style="text-align: center;">Relatório de Acervo</h1>
			'. $html .'');
$pdf->render();
$pdf->stream("Relatório de Acervo.pdf",array("Attachment" => false));


?>




