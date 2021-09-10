<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST["cod"];
    $CodigoValido = 0;

    if ($codigo != "" and ctype_digit($codigo)) {
        $CodigoValido = 1;
    }


    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBanco = "dawfaeterj";

    if ($CodigoValido == 1)
    {
        $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

        if ($conn->connect_error)
        {
            die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
        }
        $sql = "UPDATE `produtos2` SET `ATIVO`='0' WHERE `codigo de barras`='$codigo'";
        $result = $conn->query($sql);


        echo "Produto excluído com sucesso!<br>";

    } else {
        echo "Digite um ID Válido!<br>";
    }
}
?>



