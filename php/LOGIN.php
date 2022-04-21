<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nome = $_GET["nome"];
    $senha = $_GET["senha"];

    $nomeValido = 0;
    $senhaValido = 0;

    if ($nome != "" and mb_check_encoding($nome, 'UTF-8')) {
        $nomeValido = 1;
    }

    if ($senha != "") {
        $senhaValido = 1;
    }


    $servidor = "localhost";
    $usuario = "root";
    $senhaBD = "";
    $nomeBanco = "biblioteca";

    if ($nomeValido == 1 && $senhaValido == 1) {
        $conn = new mysqli($servidor, $usuario, $senhaBD, $nomeBanco);

        if ($conn->connect_error) {
            die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
        }
        $sql = "SELECT * FROM `usuario` WHERE `nome`='$nome'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            echo ("Usuário não existe!");
        } else {
            $linha = $result->fetch_assoc();

            if ($linha["senha"] == $senha) {


                header('Location: ../html/menu.html',true, 301);
                exit();

            } else {
                echo "Dados inválidos!";
            }

        }
    }
}
?>

