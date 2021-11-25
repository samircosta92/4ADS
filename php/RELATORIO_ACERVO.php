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
    <link rel="stylesheet" type="text/css" href="../css/styleCadastro.css">
    <script src="../js/funcoes.js"></script>
    <meta charset="UTF-8">
    <title>Relatório de Acervo</title>
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
            <h2>RELATÓRIO DE ACERVO</h2>
        <hr>
    </header>

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
    <div style="text-align: center">
        <br><br>
        <input class="inputcolor" type="button" name="Acervo" value="Gerar PDF" onclick="gerarRelatorios(this.name)">
        <p id="resposta"></p>
    </div>
    <a href="../RELATORIOS.html"><img src="../imagens/voltar.png" width="50px" height="35px"></a>
    <hr>
    <footer><h4>Samir Costa & Wesley Xavier - 4ADS - 2021.2</h4></footer>
</body>
</html>

