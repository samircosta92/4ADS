<?php


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $cod = $_GET["codigo"];
    $mat = $_GET["mat"];
    $nomealuno = $_GET["nomealuno"];
    $nomelivro = $_GET["nome"];

    /*A formação das datas*/
    $umDia = new DateInterval('P7D'); // Intervalo de 7 dias Com DateTime:
    $hoje = new DateTime();//data de hoje
    $atual = new DateTime();//data de hoje
    $hoje->add($umDia); // Altera o valor de $hoje e essa passa a ser a data de devolução
    $dataEmp = $atual->format('d/m/y');
    $dataDev = $hoje->format('d/m/y');

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBanco = "biblioteca";

    $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

    if ($conn->connect_error) {
        die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
    }


    $sql = "INSERT INTO `emprestimo`(`matAluno`, `codLivro`, `dataEmp`, `dataDev`)
            VALUES ('$mat','$cod','$dataEmp','$dataDev')";


    if ($conn->query($sql) === FALSE) {
        echo "Erro ao realizar empréstimo!" . $conn->connect_error;


    } else {

        echo "Empréstimo realizado com sucesso!";

        $sql = "SELECT * FROM `emprestimo` WHERE `matAluno`='$mat' AND `codLivro`='$cod' AND `Situacao`='0' ";
        $result = $conn->query($sql);
        $linha = $result->fetch_assoc();
        $dados = $linha["idEmp"];


        $sql = "SELECT * FROM `livros` WHERE `cod`='$cod'";
        $result = $conn->query($sql);
        $linha = $result->fetch_assoc();
        $dados2 = $linha["emprestados"];
        $dados2 += 1;

        $sql = "UPDATE `livros` SET `emprestados`='$dados2' WHERE `cod`='$cod'";
        $result = $conn->query($sql);


        require('fpdf.php');
        ob_start();

        $pdf = new FPDF('P', 'pt', 'legal');

        $pdf->AddPage();


        $pdf->SetFont('Helvetica', 'I', 13);

        $pdf->Cell(0, 50, 'Biblioteca Universitaria', 1, 1, 'C', false);//titulo
        $pdf->Cell(0, 50, 'Recibo de Emprestimo', 1, 1, 'C', false);//subtitulo
        $pdf->Cell(0, 50, 'Codigo do emprestimo: ' . $dados . '', 1, 1, 'L', false);
        $pdf->Cell(250, 25, 'Aluno', 1, 0, 'L', false);
        $pdf->Cell(0, 25, 'Livro', 1, 1, 'L', false);
        $pdf->Cell(250, 25, 'Nome: ' . $nomealuno . '', 1, 0, 'L', false);
        $pdf->Cell(0, 25, 'Nome: ' . $nomelivro . '', 1, 1, 'L', false);
        $pdf->Cell(250, 25, 'Matricula: ' . $mat . '', 1, 0, 'L', false);
        $pdf->Cell(0, 25, 'Codigo:' . $cod . '', 1, 1, 'L', false);
        $pdf->Cell(250, 25, 'Data de emprestimo:' . $dataEmp . '', 1, 0, 'L', false);
        $pdf->Cell(0, 25, 'Data de devolucao:' . $dataDev . '', 1, 1, 'L', false);
        $pdf->Cell(0, 50, '           ', 0, 1, 'C', false);
        $pdf->Cell(0, 35, 'Obs: Caso a devolucao seja feita alem do prazo, o aluno fica ciente de que estara sujeito a ', 0, 1, 'L', false);
        $pdf->Cell(0, 0, 'restricoes em futuros emprestimos!', 0, 1, 'L', false);


        $pdf->Output('Empréstimo ' . $dados . '.pdf', 'D', true);
        ob_end_flush();
    }
}


?>
