<?php


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
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Nome</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Matrícula</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Email</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Telefone</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Curso</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Data de Nascimento</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Situação</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$sql = "SELECT * FROM `alunos`";
$result = mysqli_query($conn, $sql);

while($linha = mysqli_fetch_assoc($result)){
    if ($linha['situacao'] == 0){
        $linha['situacao'] = "OK";
    }else{
        $linha['situacao'] = "Pendente";
    }
    $html .= '<tr><td style="border: 1px solid black;border-collapse: collapse">'.$linha['nome'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['matricula'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['email'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['telefone'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['curso'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['datanasc'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['situacao'] . "</td></tr>";
}

$html .= '</tbody>';
$html .= '</table>';


require_once "../dompdf/autoload.inc.php";
use Dompdf\Dompdf;
$pdf = new DomPdf();

$pdf -> loadHtml('<h1 style="text-align: center;">Relatório de Alunos</h1>
			'. $html .'');
$pdf->render();
$pdf->stream("Relatório de Acervo.pdf",array("Attachment" => false));


?>
