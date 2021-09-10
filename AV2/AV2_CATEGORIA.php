<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBanco = "dawfaeterj";

    $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

    $query = "SELECT * FROM `categoria` WHERE 1";
    $result = $conn->query($query);
    $linha = $result->fetch_assoc();


    $dados = array();
    $i=0;

    do{
        $dados[$i] = $linha["nome"];
        $i++;
    }while($linha = $result->fetch_assoc());

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
