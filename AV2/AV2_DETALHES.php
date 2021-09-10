<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $codigo = $_GET["codigo"];
    $codigoValido = 0;

    if ($codigo != "" and ctype_digit($codigo)) {
        $codigoValido = 1;
    }

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBanco = "dawfaeterj";


    if ($codigoValido == 1) {
        $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

        if ($conn->connect_error) {
            die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
        }
        $sql = "SELECT * FROM `produtos2` WHERE `codigo de barras`='$codigo'";
        $result = $conn->query($sql);
    }
}
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Produto</title>
    <style>

        table,tr,th,td {
            border: 2px solid black;
            border-collapse: collapse;
        }
        div{
            text-align:center;
        }
    </style>
</head>
<body>
<a href="AV2_MENU.html">VOLTAR</a>
<table>
    <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Fabricante</th>
        <th>Categoria</th>
        <th>Tipo de Produto</th>
        <th>Preço de Venda</th>
        <th>Quantidade em Estoque</th>
        <th>Peso em gramas</th>
        <th>Descrição</th>
        <th>Link da imagem</th>
        <th>Data de Inclusão</th>
    </tr>
    <?php
    $linha = $result->fetch_assoc();
    $imagem = $linha['link da imagem'];

        echo "<tr>";
        echo "<td>" . $linha['codigo de barras'] . "</td>";
        echo "<td>" . $linha['nome'] ."</td>";
        echo "<td>" . $linha['fabricante'] ."</td>";
        echo "<td>". $linha['categoria'] . "</td>";
        echo "<td>" . $linha['tipo de produto'] ."</td>";
        echo "<td>" . $linha['preco de venda'] . "</td>";
        echo "<td>" . $linha['quantidade em estoque'] . "</td>";
        echo "<td>" . $linha['peso em gramas'] ."</td>";
        echo "<td>" . $linha['descricao'] ."</td>";
        echo "<td>" . $linha['link da imagem'] ."</td>";
        echo "<td>" . $linha['data da inclusao'] ."</td>";
        echo "</tr>";

?>
</table>
<?php

echo "<div><img src=\"$imagem\" width='500' height='300'></div>";

?>

</body>
</html>
