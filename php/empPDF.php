<?php
    $mat = $_GET["matricula"];
    $cod = $_GET["codigo"];
    $dataEMP = $_GET["dataEMP"];
    $dataDEV = $_GET["dataDev"];
    $id = $_GET["idEMP"];

    /*Parametros de conexão com o banco*/
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBanco = "biblioteca";

    /*Realizando conexão com o banco*/
    $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

    if ($conn->connect_error) {
        die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
    }

    /*Buscando nome do aluno*/
    $sql = "SELECT * FROM `alunos` WHERE `matricula`='$mat'";
    $result = $conn->query($sql);

    $linha = $result->fetch_assoc();
    $nomeAluno = $linha["nome"];

    /*Buscando nome do livro*/
    $sql = "SELECT * FROM `livros` WHERE `cod`='$cod'";
    $result = $conn->query($sql);

    $linha = $result->fetch_assoc();
    $nomeLivro = $linha["nome"];
    $isbnLivro = $linha["isbn"];
    $codigo = $linha["cod"];

    $data1 = new DateTime($dataEMP);
    $data2 = new DateTime($dataDEV);

    $data1 = $data1->format('d/m/y');
    $data2 = $data2->format('d/m/y');

    require_once "../dompdf/autoload.inc.php";
    use Dompdf\Dompdf;
    $pdf = new DomPdf();
    $pdf -> loadHtml("
    <head>
    <title>Recibo de empréstimo</title>
    <style>
        .borda{
            margin: 30px;
            border: 5px solid black;
            width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .topo{
            border-bottom: 5px solid black;
            height: 110px;
            margin: 5px;
            margin-left: auto;
            margin-right: auto;
        }
        .dados{
            border-collapse: collapse;
            width: 570px;
            margin: 15px;
        }
        tr{
            border: 2px solid #000000 ;
        }
        .observacoes{
            border: 5px solid #FFFFFF;
            height: 100px;
            margin: 15px;
        }
    </style>
    </head>
    <body>
    <div class='borda'>
        <div class='topo'>
                <figure>
                    <figcaption style='text-align: center'>Biblioteca Universitária</figcaption>
                    <p style='text-align: center'>Recibo de empréstimo</p>
                    <p style='text-align: center' >Data de emissão: <?$data1</p>
                </figure>   
        </div>
        <table class='dados'>
            <tr>
                <th>Código do empréstimo:</th>
                <th><?$id</th>
            </tr>
            <tr>
                <th>Matrícula:</th>
                <th><?$mat</th>
            </tr>
            <tr>
                <th>Isbn:</th>
                <th><?$isbnLivro</th>
            </tr>
            <tr>
                <th>Data de empréstimo:</th>
                <th><?$data1</th>
            </tr>
            <tr>
                <th>Data de devolução</th>
                <th><?$data2</th>
            </tr>           
        </table>
        <div class='observacoes'>
            <p>Obs: Caso a devolução seja feita além do prazo, o aluno fica ciente de que estará sujeito a restrições em futuros empréstimos!</p>
        </div>
    </div>
    </body>
    </html>");

    $pdf->render();
    $pdf->stream("Empréstimo.pdf",array("Attachment" => false));


?>








