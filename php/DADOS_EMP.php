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
        $sql = "SELECT * FROM `emprestimo` WHERE `matAluno`='$mat'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0)
        {
            echo json_encode("Não existe livro com o código correspondente!");
        }else{
            $linha = $result->fetch_assoc();

            $dados = array();

            $dados[0] = $linha["idEmp"];
            $dados[1] = $linha["matAluno"];
            $dados[2] = $linha["codLivro"];
            $dados[3] = $linha["dataEmp"];
            $dados[4] = $linha["dataDev"];
            $dados[5] = $linha["situacao"];

            if ($dados[5] == 0){
                $dados[5]= "Emprestado";
            }else{
                $dados[5]= "Devolvido";
            }

            echo json_encode($dados);
        }
    }
?>
