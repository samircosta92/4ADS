<?php
    $mat = $_POST["mat"];

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBanco = "biblioteca";

    $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

    if ($conn->connect_error) {
        die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
    }
    $sql = "SELECT * FROM `emprestimo` WHERE `matAluno`='$mat' AND `Situacao`=0" ;
    $result = $conn->query($sql);
    $linha = $result->fetch_assoc();


    $data1 = new DateTime($linha["dataEmp"]);
    $data2 = new DateTime($linha["dataDev"]);
    $intervalo = $data1->diff($data2);
    echo $intervalo->format('%a dias');






?>
