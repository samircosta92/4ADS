<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $matricula = $_GET["mat"];
    $nome = $_GET["nome"];
    $email = $_GET["email"];
    $telefone = $_GET["telefone"];
    $curso = $_GET["curso"];
    $data = $_GET["data"];

    $matriculaValida = 0;
    $nomeValido = 0;
    $emailValido = 0;
    $telefoneValido = 0;
    $cursoValido = 0;
    $dataValida = 0;


    if ($matricula != "" and ctype_digit($matricula))
    {
        $matriculaValida = 1;
    }

    if ($nome != "" and mb_check_encoding($nome, 'UTF-8'))
    {
        $nomeValido = 1;
    }

    if ($email != "" and mb_check_encoding($email, 'UTF-8'))
    {
        $emailValido = 1;
    }

    if ($telefone != "" and mb_check_encoding($telefone, 'UTF-8'))
    {
        $telefoneValido = 1;
    }

    if ($curso != "" and mb_check_encoding($curso, 'UTF-8'))
    {
        $cursoValido = 1;
    }

    if ($data != "" )
    {
        $dataValida = 1;
    }




    if ($matriculaValida==1 and $nomeValido==1 and $emailValido==1 and $telefoneValido==1 and
        $cursoValido==1 and $dataValida==1) {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $nomeBanco = "biblioteca";

        $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

        if ($conn->connect_error) {
            die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
        }


        $sql = "UPDATE `alunos` SET `nome`='$nome',`matricula`='$matricula',`email`='$email',
                       `telefone`='$telefone',`curso`='$curso',`data`='$data'";

        if ($conn->query($sql) === TRUE) {
            echo "Alteração feita com sucesso!";

        } else {

            echo "Erro ao alterar produto!";
        }


    }
    else
    {
        echo "Preencha os dados corretamente!";
        echo "<br>";

    }


}

?>






