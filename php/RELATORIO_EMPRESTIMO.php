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
$sql = "SELECT * FROM `emprestimo` WHERE 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../css/styleCadastro.css">
    <meta charset="UTF-8">
    <title>Relatório de Empréstimos</title>

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
    <h2>RELATÓRIO DE EMPRÉSTIMOS</h2>
    <hr>
</header>

    <table>
        <tr>
            <th>Matrícula Aluno</th>
            <th>Código Livro</th>
            <th>Data de Empréstimo</th>
            <th>Data de Devolução</th>
            <th>Situação</th>

        </tr>
        <?php
        $linha = $result->fetch_assoc();

        do{
            if ($linha['Situacao'] == 0){
                $linha['Situacao'] = "Emprestado";
            }else{
                $linha['Situacao'] = "Devolvido";
            }

            ?>

            <tr>
                <td><?=$linha['matAluno']?></td>
                <td><?=$linha['codLivro']?></td>
                <td><?=$linha['dataEmp']?></td>
                <td><?=$linha['dataDev']?></td>
                <td><?=$linha['Situacao']?></td>
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
</body>
<hr>
<footer><h4>Samir Costa & Wesley Xavier - 4ADS - 2021.2</h4></footer>
</html>

