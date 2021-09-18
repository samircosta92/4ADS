<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nome = $_GET["nome"];
    $mat = $_GET["mat"];
    $email = $_GET["email"];
    $tel = $_GET["tel"];
    $curso = $_GET["curso"];
    $data = $_GET["data"];

    $nomeValido = 0;
    $matValido = 0;
    $emailValido = 0;
    $telValido = 0;
    $cursoValido = 0;
    $dataValido = 0;


    if ($nome != "" and mb_check_encoding($nome, 'UTF-8'))
    {
        $nomeValido = 1;
    }

    if ($mat != "" and ctype_digit($mat))
    {
        $matValido = 1;
    }

    if ($email != "" and mb_check_encoding($email, 'UTF-8'))
    {
        $emailValido = 1;
    }

    if ($tel != "" and mb_check_encoding($tel, 'UTF-8'))
    {
        $telValido = 1;
    }

    if ($curso != "" and mb_check_encoding($curso, 'UTF-8'))
    {
        $cursoValido = 1;
    }

    if ($data != "")
    {
        $dataValido = 1;
    }


    if ($nomeValido==1 and $matValido==1 and $emailValido==1 and $telValido==1 and
        $cursoValido==1 and $dataValido==1) {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $nomeBanco = "biblioteca";

        $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

        if ($conn->connect_error) {
            die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
        }

        $sql = "SELECT * FROM `alunos` WHERE `matricula`='$mat'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $sql = "INSERT INTO `alunos`(`nome`, `matricula`, `email`, `telefone`, `curso`,`datanasc`)
            VALUES ('$nome','$mat','$email','$tel','$curso','$data')";


            if ($conn->query($sql) === TRUE) {
                echo "Aluno,$nome, inserido com sucesso!";

            } else {

                echo "Erro ao inserir aluno!";
            }
        } else {
            echo "Aluno já existente!";
        }

    }
    else
    {
        echo "Preencha os dados corretamente!";
        echo "<br>";

    }


}

?>
