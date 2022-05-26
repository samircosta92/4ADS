<?php
require_once "../dompdf/autoload.inc.php";
use Dompdf\Dompdf;

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

    /*INSERÇÃO DO EMPRESTIMO*/
    $sql = "INSERT INTO `emprestimo`(`matAluno`, `codLivro`, `dataEmp`, `dataDev`)
            VALUES ('$mat','$cod','$dataEmp','$dataDev')";


    if ($conn->query($sql) === FALSE) {
        echo "Erro ao realizar empréstimo!" . $conn->connect_error;


    } else {

        echo "Empréstimo realizado com sucesso!";

        /*Pegando o emprestimo que foi inserido*/
        $sql = "SELECT * FROM `emprestimo` WHERE `matAluno`='$mat' AND `codLivro`='$cod' AND `Situacao`='0' ";
        $result = $conn->query($sql);
        $linha = $result->fetch_assoc();

        //id do emprestimo
        $dados = $linha["idEmp"];


        /*somando um ao numero de livros emprestados deste livro*/
        $sql = "SELECT * FROM `livros` WHERE `cod`='$cod'";
        $result = $conn->query($sql);
        $linha = $result->fetch_assoc();
        $dados2 = $linha["emprestados"];
        $dados2 += 1;

        $sql = "UPDATE `livros` SET `emprestados`='$dados2' WHERE `cod`='$cod'";
        $result = $conn->query($sql);

        $sql = "UPDATE `alunos` SET `situacao`=1 WHERE `matricula`='$mat'";
        $result = $conn->query($sql);



        $pdf = new DomPdf();
        /*$html =
            '<!DOCTYPE html>
             <html>
                 <head>
                    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
                 </head>
                 <body>
                    <h2>Olá</h2>     
                 </body>
             </html> ';*/

        $pdf -> loadHtml("<h2>Olá</h2>");
        $pdf->render();
        $pdf->stream("mypdf.pdf",array("Attachment" => false));
        exit;





    }
}



?>
