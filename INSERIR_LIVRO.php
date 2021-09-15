<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $codigo = $_GET["codigo"];
    $nome = $_GET["nome"];
    $autor = $_GET["autor"];
    $editora = $_GET["editora"];
    $quantidade = $_GET["quantidade"];
    $img = $_GET["img"];

    $codigoValido = 0;
    $nomeValido = 0;
    $autorValido = 0;
    $editoraValido = 0;
    $quantidadeValido = 0;
    $imgValido = 0;


    if ($codigo != "" and ctype_digit($codigo))
    {
        $codigoValido = 1;
    }
    if ($nome != "" and ctype_alpha(str_replace(' ', '',$nome)))
    {
        $nomeValido = 1;
    }
    if ($autor != "" and ctype_alpha(str_replace(' ', '',$autor)))
    {
        $autorValido = 1;
    }

    if ($editora != "" and ctype_alpha(str_replace(' ', '',$editora)))
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



    if ($codigoValido==1 and $nomeValido==1 and $autorValido==1 and $editoraValido==1 and
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
            $sql = "INSERT INTO `livros`(`cod`, `nome`, `autor`, `editora`, `qtdestoque`, `link`)
            VALUES ('$codigo','$nome','$autor','$editora','$quantidade','$img')";



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
