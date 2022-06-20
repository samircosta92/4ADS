<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $mat = $_GET["matricula"];

        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $nomeBanco = "biblioteca";

        $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

        if ($conn->connect_error) {
            die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
        }
        $sql = "SELECT * FROM `emprestimo` WHERE `matAluno`='$mat' AND `Situacao`=0" ;
        $result = $conn->query($sql);

        if ($result->num_rows == 0)
        {
            echo json_encode("Não existe empréstimo pendente para esse aluno!");
        }else{
            $linha = $result->fetch_assoc();

            $dados = array();

            $dados[0] = $linha["idEmp"];
            $dados[1] = $linha["matAluno"];
            $dados[2] = $linha["codLivro"];
            $dados[3] = $linha["dataEmp"];
            $dados[4] = $linha["dataDev"];

            $data1 = new DateTime($dados[3]);
            $data2 = new DateTime($dados[4]);

            $dados[3] = $data1->format('d/m/y');
            $dados[4] = $data2->format('d/m/y');

            $dados[5] = $linha["Situacao"];

            if ($dados[5] == 0){
                $dados[5]= "Emprestado";
            }else{
                $dados[5]= "Devolvido";
            }

            echo json_encode($dados);
        }
    }
?>
