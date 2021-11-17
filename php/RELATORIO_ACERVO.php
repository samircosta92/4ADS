<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$nomeBanco = "biblioteca";
$conn = new mysqli($servidor,$usuario,$senha,$nomeBanco);

if($conn->connect_error)
{
    die("Não foi possível estabelecer uma conexão!".$conn->connect_error);
}
$sql = "SELECT * FROM `livros` WHERE 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Acervo</title>
    <style>

        table,tr,th,td {
            border: 2px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>

    <table>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Autor</th>
            <th>Editora</th>
            <th>Quantidade em estoque</th>
            <th>Emprestados</th>
        </tr>
        <?php
        $linha = $result->fetch_assoc();

        do{

            ?>

            <tr>
                <td><?=$linha['cod']?></td>
                <td><?=$linha['nome']?></td>
                <td><?=$linha['autor']?></td>
                <td><?=$linha['editora']?></td>
                <td><?=$linha['qtdestoque']?></td>
                <td><?=$linha['emprestados']?></td>
            </tr>
            <?php
        } while ($linha = $result->fetch_assoc())

        ?>

    </table>
    <a href="RELATORIOS.html">VOLTAR</a>
</body>
</html>

