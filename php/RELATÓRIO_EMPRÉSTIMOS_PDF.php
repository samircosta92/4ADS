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
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Matrícula do Aluno</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Código do Livro</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Data de Empréstimo</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Data de Devolução</th>';
$html .= '<th style="border: 1px solid black;border-collapse: collapse">Situação</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$sql = "SELECT * FROM `emprestimo`";
$result = mysqli_query($conn, $sql);

while($linha = mysqli_fetch_assoc($result)){
    if ($linha['Situacao'] == 0){
        $linha['Situacao'] = "Emprestado";
    }else{
        $linha['Situacao'] = "Devolvido";
    }
    $html .= '<tr><td style="border: 1px solid black;border-collapse: collapse">'.$linha['matAluno'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['codLivro'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['dataEmp'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['dataDev'] . "</td>";
    $html .= '<td style="border: 1px solid black;border-collapse: collapse">'.$linha['Situacao'] . "</td></tr>";
}

$html .= '</tbody>';
$html .= '</table>';


require_once "../dompdf/autoload.inc.php";
use Dompdf\Dompdf;
$pdf = new DomPdf();

$pdf -> loadHtml('<h1 style="text-align: center;">Relatório de Empréstimos</h1>
			'. $html .'');
$pdf->render();
$pdf->stream("Relatório de Acervo.pdf",array("Attachment" => false));


?>

