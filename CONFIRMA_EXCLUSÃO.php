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
    $nomeBanco = "biblioteca";

    if ($CodigoValido == 1)
    {
        $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

        if ($conn->connect_error)
        {
            die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
        }
        $sql = "DELETE FROM `livros` WHERE `cod`='$codigo'";
        $result = $conn->query($sql);

        echo "Livro excluído com sucesso!<br>";

    } else {
        echo "Digite um ID Válido!<br>";
    }
}
?>
