<?
    require('fpdf.php');

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $relatorio = $_GET["relatorio"];

        ob_start();

        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $nomeBanco = "biblioteca";
        $conn = new mysqli($servidor,$usuario,$senha,$nomeBanco);

        if($conn->connect_error)
        {
            die("Não foi possível estabelecer uma conexão!".$conn->connect_error);
        }
        $sql = "SELECT * FROM `livros` WHERE 1";
        $result = $conn->query($sql);

        $linha = $result->fetch_assoc();

        //instanciando objeto PDF
        $pdf = new FPDF('P', 'pt', 'legal');

        //adicionando pagina
        $pdf->AddPage();

        //atribuindo fonte
        $pdf->SetFont('Helvetica', 'I', 13);

        $pdf->Cell(0, 50, 'Biblioteca Universitaria', 1, 1, 'C', false);//titulo
        $pdf->Cell(0, 50, 'Recibo de Emprestimo', 1, 1, 'C', false);//subtitulo
        $pdf->Cell(0, 50, 'Codigo do emprestimo: ', 1, 1, 'L', false);
        $pdf->Cell(250, 25, 'Aluno', 1, 0, 'L', false);
        $pdf->Cell(0, 25, 'Livro', 1, 1, 'L', false);


        $pdf->Output('RelatorioDe'.$relatorio.'.pdf', 'D',true);

        /*do{

            $linha['cod']
            $linha['nome']
            $linha['autor']
            $linha['editora']
            $linha['qtdestoque']
            $linha['emprestados']

    } while ($linha = $result->fetch_assoc())*/

        ob_end_flush();
        echo "PDF gerado com sucesso!";
        echo ($relatorio);
    }
?>
