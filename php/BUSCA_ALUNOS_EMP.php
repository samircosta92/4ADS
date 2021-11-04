<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $codigo = $_GET["matricula"];
    $CodigoValido = 0;

    if ($codigo != "" and ctype_digit($codigo)) {
        $codigoValido = 1;
    }

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBanco = "biblioteca";

    if ($codigoValido == 1)
    {
        $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

        if ($conn->connect_error) {
            die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
        }
        $sql = "SELECT * FROM `alunos` WHERE `matricula`='$codigo'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0)
        {
            echo json_encode("Não existe aluno com a matricula correspondente!");
        }
        else{
            $linha = $result->fetch_assoc();

            $dados = array();

            $dados[0] = $linha["nome"];
            $dados[1] = $linha["curso"];
            $dados[2] = $linha["situacao"];

            if($dados[2]==0){
                $dados[2]="OK";
            }else{
                $dados[2]="Pendente";
            }
            echo json_encode($dados);
        }

    } else {
        echo "Digite uma matricula válida!";
    }

}
?>



