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
    $nomeBanco = "dawfaeterj";

    if ($codigoValido == 1)
    {
        $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

        if ($conn->connect_error) {
            die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
        }
        $sql = "SELECT * FROM `produtos2` WHERE `codigo de barras`='$codigo' and `ATIVO`='1'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0)
        {
            echo json_encode("Não existe produto com o código correspondente!");
        }
        else{
            $linha = $result->fetch_assoc();

            $dados = array();

            $dados[0] = $linha["codigo de barras"];
            $dados[1] = $linha["nome"];
            $dados[2] = $linha["fabricante"];
            $dados[3] = $linha["categoria"];
            $dados[4] = $linha["tipo de produto"];
            $dados[5] = $linha["preco de venda"];
            $dados[6] = $linha["quantidade em estoque"];
            $dados[7] = $linha["peso em gramas"];
            $dados[8] = $linha["descricao"];
            $dados[9] = $linha["link da imagem"];
            $dados[10] = $linha["data da inclusao"];

            echo json_encode($dados);

        }

    } else {
        echo "Digite um código válido!";
    }

}
?>
