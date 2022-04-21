<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nome = $_GET["nome"];
    $senha = $_GET["senha"];
    $email = $_GET["email"];

    $nomeValido = 0;
    $senhaValido = 0;
    $emailValido = 0;


    if ($nome != "" and mb_check_encoding($nome, 'UTF-8'))
    {
        $nomeValido = 1;
    }

    if ($senha != "")
    {
        $senhaValido = 1;
    }

    if ($email != "" and mb_check_encoding($email, 'UTF-8'))
    {
        $emailValido = 1;
    }



    if ($nomeValido==1 and $senhaValido==1 and $emailValido==1) {
        $servidor = "localhost";
        $usuario = "root";
        $senhaBD = "";
        $nomeBanco = "biblioteca";

        $conn = new mysqli($servidor, $usuario, $senhaBD, $nomeBanco);

        if ($conn->connect_error) {
            die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
        }

        $sql = "SELECT * FROM `usuario` WHERE `nome`='$nome'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $sql = "INSERT INTO `usuario`(`nome`, `email`, `senha`)
            VALUES ('$nome','$email','$senha')";


            if ($conn->query($sql) === TRUE) {
                echo "Usuário,$nome, inserido com sucesso!";

            } else {

                echo "Erro ao inserir usuário!";
            }
        } else {
            echo "Usuário já existente!";
        }

    }
    else
    {
        echo "Preencha os dados corretamente!";
        echo "<br>";

    }


}

?>

