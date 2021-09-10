<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$nomeBanco = "dawfaeterj";
$conn = new mysqli($servidor,$usuario,$senha,$nomeBanco);

if($conn->connect_error)
{
    die("Não foi possível estabelecer uma conexão!".$conn->connect_error);
}
$sql = "SELECT * FROM `produtos2` WHERE `ATIVO`='1'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listar todos os produtos</title>
    <style>

        table,tr,th,td {
            border: 2px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<a href="AV2_MENU.html">VOLTAR</a>
<table>
    <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Preço de Venda</th>
        <th>Estoque</th>
    </tr>
    <?php
    $linha = $result->fetch_assoc();

        do{

    ?>

            <tr>
            <td><?=$linha['codigo de barras']?></td>
            <td><a href="http://localhost/3daw/AV2_DETALHES.php?codigo=<?=$linha['codigo de barras']?>"><?=$linha['nome']?></a></td>
            <td><?=$linha['categoria']?></td>
            <td><?=$linha['preco de venda']?></td>
            <td><?=$linha['quantidade em estoque']?></td>
            </tr>
    <?php
        } while ($linha = $result->fetch_assoc())
    
    ?>

</table>
</body>
</html>
