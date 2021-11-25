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

        if($relatorio == "Acervo"){
            $sql = "SELECT * FROM `livros`";
            $result = $conn->query($sql);

            $linha = $result->fetch_assoc();

            //instanciando objeto PDF
            $pdf = new FPDF('P', 'pt', 'legal');

            //adicionando pagina
            $pdf->AddPage();

            //atribuindo fonte
            $pdf->SetFont('Helvetica', 'I', 13);

            $pdf->Cell(0, 50, 'Biblioteca Universitaria', 1, 1, 'C', false);//titulo
            $pdf->Cell(0, 50, 'Relatorio de '.$relatorio.'', 1, 1, 'C', false);//subtitulo

            do{

                $pdf->Cell(250, 25, 'Codigo:'.$linha['cod'].'', 1, 1, 'L', false);
                $pdf->Cell(0, 25, 'Nome:'.$linha['nome'].'', 1, 1, 'L', false);
                $pdf->Cell(250, 25, 'Autor: '.$linha['autor'].'', 1, 1, 'L', false);
                $pdf->Cell(0, 25, 'Editora: '.$linha['editora'].'', 1, 1, 'L', false);
                $pdf->Cell(250, 25, 'Quantidade em estoque: '.$linha['qtdestoque'].'', 1, 1, 'L', false);
                $pdf->Cell(0, 25, 'Emprestados: '.$linha['emprestados'].'', 1, 1, 'L', false);

            }while($linha = $result->fetch_assoc());

            $pdf->Output('RelatorioDe'.$relatorio.'.pdf', 'D',true);

        }else{
            if($relatorio == "Alunos"){
                $sql = "SELECT * FROM `alunos`";
                $result = $conn->query($sql);

                $linha = $result->fetch_assoc();

                //instanciando objeto PDF
                $pdf = new FPDF('P', 'pt', 'legal');

                //adicionando pagina
                $pdf->AddPage();

                //atribuindo fonte
                $pdf->SetFont('Helvetica', 'I', 13);

                $pdf->Cell(0, 50, 'Biblioteca Universitaria', 1, 1, 'C', false);//titulo
                $pdf->Cell(0, 50, 'Relatorio de '.$relatorio.'', 1, 1, 'C', false);//subtitulo

                do{

                    $pdf->Cell(250, 25, 'Matricula:'.$linha['matricula'].'', 1, 1, 'L', false);
                    $pdf->Cell(0, 25, 'Nome:'.$linha['nome'].'', 1, 1, 'L', false);
                    $pdf->Cell(250, 25, 'Email: '.$linha['email'].'', 1, 1, 'L', false);
                    $pdf->Cell(0, 25, 'Telefone: '.$linha['telefone'].'', 1, 1, 'L', false);
                    $pdf->Cell(250, 25, 'Curso: '.$linha['curso'].'', 1, 1, 'L', false);
                    $pdf->Cell(0, 25, 'Data de nascimento: '.$linha['datanasc'].'', 1, 1, 'L', false);

                }while($linha = $result->fetch_assoc());

                $pdf->Output('RelatorioDe'.$relatorio.'.pdf', 'D',true);


            }else{
                if($relatorio == "Emprestimos"){
                    $sql = "SELECT * FROM `emprestimo`";
                    $result = $conn->query($sql);

                    $linha = $result->fetch_assoc();

                    //instanciando objeto PDF
                    $pdf = new FPDF('P', 'pt', 'legal');

                    //adicionando pagina
                    $pdf->AddPage();

                    //atribuindo fonte
                    $pdf->SetFont('Helvetica', 'I', 13);

                    $pdf->Cell(0, 50, 'Biblioteca Universitaria', 1, 1, 'C', false);//titulo
                    $pdf->Cell(0, 50, 'Relatorio de '.$relatorio.'', 1, 1, 'C', false);//subtitulo

                    do{

                        $pdf->Cell(250, 25, 'Matricula do aluno:'.$linha['matAluno'].'', 1, 1, 'L', false);
                        $pdf->Cell(0, 25, 'Codigo do livro:'.$linha['codLivro'].'', 1, 1, 'L', false);
                        $pdf->Cell(250, 25, 'Data de emprestimo: '.$linha['dataEmp'].'', 1, 1, 'L', false);
                        $pdf->Cell(0, 25, 'Data de devolução: '.$linha['dataDev'].'', 1, 1, 'L', false);
                        $pdf->Cell(250, 25, 'Situação: '.$linha['Situacao'].'', 1, 1, 'L', false);

                    }while($linha = $result->fetch_assoc());

                    $pdf->Output('RelatorioDe'.$relatorio.'.pdf', 'D',true);
                }
            }
        }



        ob_end_flush();
        echo "PDF gerado com sucesso!";
    }
?>
