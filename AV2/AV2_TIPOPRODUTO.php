<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {


    $categoria = $_GET["categoria"];
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBanco = "dawfaeterj";

    $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

    $query = "SELECT * FROM `categoria` WHERE `nome`='$categoria'";
    $result = $conn->query($query);
    $linha = $result->fetch_assoc();
    $CodCategoria = $linha["cod"];

    $query2 = "SELECT * FROM `tipoproduto` WHERE `cod`='$CodCategoria'";
    $result2 = $conn->query($query2);
    $linha2 = $result2->fetch_assoc();
    $nomeTipoProduto = $linha2["nome"];

    $dados = array();
    $i=0;

    do{
        $dados[$i] = $linha2["nome"];
        $i++;
    }while($linha2 = $result2->fetch_assoc());

    //função para consertar os caracteres especiais
    function jsonEncode($dados){
        array_walk_recursive( $dados, function(&$item) {
            $item = utf8_encode( $item );
        });
        return json_encode($dados);
    }

    echo json_encode($dados);


}
?>