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
$sql = "SELECT * FROM `alunos` WHERE 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Alunos</title>
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
            <th>Nome</th>
            <th>Matrícula</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Curso</th>
            <th>Data de Nascimento</th>
            <th>Situação</th>

        </tr>
        <?php
        $linha = $result->fetch_assoc();

        do{

            ?>

            <tr>
                <td><?=$linha['nome']?></td>
                <td><?=$linha['matricula']?></td>
                <td><?=$linha['email']?></td>
                <td><?=$linha['telefone']?></td>
                <td><?=$linha['curso']?></td>
                <td><?=$linha['datanasc']?></td>
                <td><?=$linha['situacao']?></td>
            </tr>
            <?php
        } while ($linha = $result->fetch_assoc())

        ?>
    </table>
    <a href="RELATORIOS.html">VOLTAR</a>
</body>
</html>


