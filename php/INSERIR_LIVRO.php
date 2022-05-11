<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $codigo = $_GET["codigo"];
    $isbn = $_GET["isbn"];
    $nome = $_GET["nome"];
    $autor = $_GET["autor"];
    $editora = $_GET["editora"];
    $quantidade = $_GET["quantidade"];
    $img = $_GET["img"];

    $codigoValido = 0;
    $isbnValido = 0;
    $nomeValido = 0;
    $autorValido = 0;
    $editoraValido = 0;
    $quantidadeValido = 0;
    $imgValido = 0;


    if ($codigo != "" and ctype_digit($codigo))
    {
        $codigoValido = 1;
    }

    if (strlen("$isbn") == 13 and ctype_digit($isbn))
    {
        $isbnValido = 1;
    }

    if ($nome != "" and mb_check_encoding($nome, 'UTF-8'))
    {
        $nomeValido = 1;
    }

    if ($autor != "" and mb_check_encoding($autor, 'UTF-8'))
    {
        $autorValido = 1;
    }

    if ($editora != "" and mb_check_encoding($editora, 'UTF-8'))
    {
        $editoraValido = 1;
    }

    if ($quantidade != "" and ctype_digit($quantidade))
    {
        $quantidadeValido = 1;
    }

    if ($img != "" )
    {
        $imgValido = 1;
    }




      if ($codigoValido==1 and $isbnValido==1 and $nomeValido==1 and $autorValido==1 and $editoraValido==1 and
        $quantidadeValido==1 and $imgValido==1) {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $nomeBanco = "biblioteca";

        $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

        if ($conn->connect_error) {
            die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
        }

        $sql = "SELECT * FROM `livros` WHERE `cod`='$codigo'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $sql = "INSERT INTO `livros`(`cod`, `isbn`, `nome`, `autor`, `editora`, `qtdestoque`, `link`)
            VALUES ('$codigo','$isbn','$nome','$autor','$editora','$quantidade','$img')";



            if ($conn->query($sql) === TRUE) {
                echo "Livro,$nome, inserido com sucesso!";

            } else {

                echo "Erro ao inserir livro!";
            }
        } else {
            echo "Livro já existente!";
        }

    }
    else
    {
        echo "Preencha os dados corretamente!";
        echo "<br>";

    }


}

?>

