<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST["cod"];
    $CodigoValido = 0;

    if ($codigo != "" and ctype_digit($codigo)) {
        $CodigoValido = 1;
    }


    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBanco = "biblioteca";

    if ($CodigoValido == 1)
    {
        $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

        if ($conn->connect_error)
        {
            die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
        }
        $sql = "DELETE FROM `livros` WHERE `cod`='$codigo'";
        $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        header{
            background-color: #000080;
            text-align: center;
        }
        footer{
            background-color: #000080;
            text-align: center;
            margin-top: -5px;
            padding: 15px;
        }
        body{
            background-color: white;
            color: #FFD700;
            font-family: 'Oswald', sans-serif;
        }
        p{
            color:navy;
            font-weight:bold;
        }
    </style>
</head>
<body>
<header>
    <hr>
    <h2>SISTEMA PARA GERENCIAMENTO DA BIBLIOTECA</h2>
    <hr>
</header>
<?php
echo "<div>
    <p>Livro excluído com sucesso!</p><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <a href='../html/EXCLUIR_LIVRO.html'><img src='../imagens/voltar.png' width='50px' height='35px'></a>
</div>";

} else {
echo "Digite um Código Válido!<br>";
}
}
?>

<footer style="margin-top: 50px ">
    <h4>Samir Costa & Wesley Xavier - 4ADS - 2021.2</h4>
</footer>
</body>
</html>
