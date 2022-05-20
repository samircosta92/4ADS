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

            $dados[0] = $linha["nome"];
            $dados[1] = $linha["autor"];
            $dados[2] = $linha["qtdestoque"];
            $dados[3] = $linha["emprestados"];
            $dados[4] = $linha["link"];

            if ($dados[2]==$dados[3]){
                $dados[2]= "Não disponivel";
            }else{
                $dados[2]= "Disponivel";
            }

            echo json_encode($dados);
        }

    } else {
        echo "Digite um código válido!";
    }

}
?>




