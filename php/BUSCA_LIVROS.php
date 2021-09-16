<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $codigo = $_GET["codigo"];
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
        $sql = "SELECT * FROM `livros` WHERE `cod`='$codigo'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0)
        {
            echo json_encode("Não existe livro com o código correspondente!");
        }
        else{
            $linha = $result->fetch_assoc();

            $dados = array();

            $dados[0] = $linha["cod"];
            $dados[1] = $linha["nome"];
            $dados[2] = $linha["autor"];
            $dados[3] = $linha["editora"];
            $dados[4] = $linha["qtdestoque"];
            $dados[5] = $linha["link"];


            echo json_encode($dados);
        }

    } else {
        echo "Digite um código válido!";
    }

}
?>



