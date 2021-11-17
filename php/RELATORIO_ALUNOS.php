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
    <link rel="stylesheet" type="text/css" href="../css/styleCadastro.css">
    <meta charset="UTF-8">
    <title>Relatório de Alunos</title>
    <style>

        table,tr,th,td {
            border: 2px solid black;
            border-collapse: collapse;
            padding-left: 20px;
            padding-right: 20px;
            margin:auto;
            color: navy;
        }
    </style>
</head>
<body>

    <header>
        <hr>
        <h2>RELATÓRIO DE ALUNOS</h2>
        <hr>
    </header>

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
            if ($linha['situacao'] == 0){
                $linha['situacao'] = "OK";
            }else{
                $linha['situacao'] = "Pendente";
            }
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
    <div style="text-align: center">
        <br><br>
        <input class="inputcolor" type="button" name="envia" value="Gerar PDF" onclick="">
    </div>
    <a href="../RELATORIOS.html"><img src="../imagens/voltar.png" width="50px" height="35px"></a>
    <hr>
    <footer><h4>Samir Costa & Wesley Xavier - 4ADS - 2021.2</h4></footer>
</body>
</html>


