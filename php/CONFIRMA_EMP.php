<?php


if ($_SERVER["REQUEST_METHOD"] == "GET"){
    echo "CHEGOU AQUI";
    $cod = $_GET["codigo"];
    $mat = $_GET["mat"];
    $nomealuno = $_GET["nomealuno"];
    $nomelivro = $_GET["nome"];

    $umDia = new DateInterval('P7D'); // Intervalo de 7 dias Com DateTime:
    $hoje = new DateTime();//data de hoje
    $atual = new DateTime();//data de hoje
    $hoje->add($umDia); // Altera o valor de $hoje e essa passa a ser a data de devolução

    require('fpdf.php');

    $pdf = new FPDF('P','pt','legal');

    $pdf->AddPage();


    $pdf->SetFont('Helvetica','I',13);

    $pdf->Cell(0,50,'Biblioteca Universitaria',1,1,'C',false);//titulo
    $pdf->Cell(0,50,'Recibo de Emprestimo',1,1,'C',false);//subtitulo
    $pdf->Cell(0,50,'Codigo do emprestimo: ',1,1,'L',false);
    $pdf->Cell(250,25,'Aluno',1,0,'L',false);
    $pdf->Cell(0,25,'Livro',1,1,'L',false);
    $pdf->Cell(250,25,'Nome: '.$nomealuno.'',1,0,'L',false);
    $pdf->Cell(0,25,'Nome: '.$nomelivro.'',1,1,'L',false);
    $pdf->Cell(250,25,'Matricula: '.$mat.'',1,0,'L',false);
    $pdf->Cell(0,25,'Codigo:'.$cod.'',1,1,'L',false);
    $pdf->Cell(250,25,'Data de emprestimo:'.$atual->format('d/m').'',1,0,'L',false);
    $pdf->Cell(0,25,'Data de devolucao:'.$hoje->format('d/m').'',1,1,'L',false);
    $pdf->Cell(0,50,'           ',0,1,'C',false);
    $pdf->Cell(0,35,'Obs: Caso a devolucao seja feita alem do prazo, o aluno fica ciente de que estara sujeito a ',0,1,'L',false);
    $pdf->Cell(0,0,'restricoes em futuros emprestimos!',0,1,'L',false);

    ob_start();
    $pdf->Output('gerando_pdf_com_fpdf.pdf','F');
    ob_end_flush();
}

?>
