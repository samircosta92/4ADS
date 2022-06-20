<?php
    $mat = $_POST["mat"];


    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBanco = "biblioteca";

    $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

    if ($conn->connect_error) {
        die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
    }
    $sql = "SELECT * FROM `emprestimo` WHERE `matAluno`='$mat' AND `Situacao`=0";

    $result = $conn->query($sql);
    $linha = $result->fetch_assoc();

    $codLivro = $linha["codLivro"];
    $codEmp = $linha["idEmp"];

    //calculando se tem multa
    $data1 = new DateTime($linha["dataEmp"]);
    $data2 = new DateTime();

    $data3 = new DateTime($linha["dataDev"]);

    $intervalo = $data1->diff($data2);

    //mudando para formato string
    $data1 = $data1->format('d/m/y');
    $data2 = $data2->format('d/m/y');
    $data3 = $data3->format('d/m/y');

    $interv = (int)$intervalo->format('%a');

    $mult = 0;

    if($interv>7){
        $mult = $interv - 7;
    }

    $multa = $mult*2;

    //buscando numero de emprestimos feitos nesse livro
    $sql = "SELECT * FROM `livros` WHERE `cod`='$codLivro'";
    $result = $conn->query($sql);
    $linha = $result->fetch_assoc();
    $qtd = $linha["emprestados"];

    //diminuindo 1
    $qtd = $qtd-1;

    //Updates
    $sql = "UPDATE `livros` SET `emprestados`='$qtd' WHERE  `cod`='$codLivro'";
    $result = $conn->query($sql);
    if ($conn->query($sql) === FALSE) {
        echo "Erro ao encontrar livro!" . $conn->connect_error;
    }

    $sql = "UPDATE `alunos` SET `situacao`='0' WHERE `matricula`='$mat'";
    $result = $conn->query($sql);
    if ($conn->query($sql) === FALSE) {
        echo "Erro ao encontrar aluno!" . $conn->connect_error;
    }

    $sql = "UPDATE `emprestimo` SET `Situacao`='1' WHERE  `idEmp`='$codEmp'";
    $result = $conn->query($sql);
    if ($conn->query($sql) === FALSE) {
        echo "Erro ao encontrar emprestimo!" . $conn->connect_error;
    }

    require_once "../dompdf/autoload.inc.php";
    use Dompdf\Dompdf;
    $pdf = new DomPdf();
    $pdf -> loadHtml("
        <head>
        <title>Recibo de Devolução</title>
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
                        <p style='text-align: center'>Recibo de Devolução</p>
                        <p style='text-align: center' >Data de emissão: <?$data2</p>
                    </figure>   
            </div>
            <table class='dados'>
                <tr>
                    <th>Código do empréstimo:</th>
                    <th><?$codEmp</th>
                </tr>
                <tr>
                    <th>Matrícula:</th>
                    <th><?$mat</th>
                </tr>
                <tr>
                    <th>Código do Livro:</th>
                    <th><?$codLivro</th>
                </tr>
               <tr>
                    <th>Data de Empréstimo:</th>
                    <th><?$data1</th>
                </tr>  
                
                <tr>
                    <th>Data limite de Devolução:</th>
                    <th><?$data3</th>
                </tr>              
                <tr>
                    <th>Valor da Multa</th>
                    <th>R$<?$multa,00</th>
                </tr>           
            </table>
        </div>
        </body>
        </html>");

    $pdf->render();
    $pdf->stream("Devolução.pdf",array("Attachment" => false));
?>
