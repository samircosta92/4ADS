<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $codigo = $_GET["codigo"];
    $nome = $_GET["nome"];
    $fabricante = $_GET["fabricante"];
    $categoria = $_GET["categoria"];
    $tipoproduto = $_GET["tipoproduto"];
    $preco = $_GET["preco"];
    $quantidade = $_GET["quantidade"];
    $peso = $_GET["peso"];
    $desc = $_GET["desc"];
    $img = $_GET["img"];
    $data = $_GET["data"];

    $codigoValido = 0;
    $nomeValido = 0;
    $fabricanteValido = 0;
    $categoriaValido = 0;
    $precoValido = 0;
    $quantidadeValido = 0;
    $descValido = 0;
    $imgValido = 0;
    $dataValido = 0;


    if ($codigo != "" and ctype_digit($codigo))
    {
        $codigoValido = 1;
    }
    if ($nome != "" and ctype_alpha(str_replace(' ', '',$nome)))
    {
        $nomeValido = 1;
    }
    if ($fabricante != "" and ctype_alpha(str_replace(' ', '',$fabricante)))
    {
        $fabricanteValido = 1;
    }
    if ($categoria != "")
    {
        $categoriaValido = 1;
    }
    if ($preco != "")
    {
        $precoValido = 1;
    }
    if ($quantidade != "" and ctype_digit($quantidade))
    {
        $quantidadeValido = 1;
    }
    if ($desc != "")
    {
        $descValido = 1;
    }
    if ($img != "" )
    {
        $imgValido = 1;
    }
    if ($data != "")
    {
        $dataValido = 1;
    }


    if ($codigoValido==1 and $nomeValido==1 and $fabricanteValido==1 and $categoriaValido==1 and $precoValido==1
        and $quantidadeValido==1 and $descValido==1 and $imgValido==1 and $dataValido==1) {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $nomeBanco = "dawfaeterj";

        $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);

        if ($conn->connect_error) {
            die("Não foi possível estabelecer uma conexão!" . $conn->connect_error);
        }

        $sql = "SELECT * FROM `produtos2` WHERE `codigo de barras`='$codigo'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $sql = "INSERT INTO `produtos2`(`codigo de barras`, `nome`, `fabricante`, `categoria`, `tipo de produto`,
                        `preco de venda`, `quantidade em estoque`, `peso em gramas`, `descricao`, `link da imagem`,
                        `data da inclusao`, `ATIVO`) VALUES ('$codigo','$nome','$fabricante','$categoria',
                                                             '$tipoproduto','$preco','$quantidade','$peso',
                                                             '$desc','$img','$data','1')";

            if ($conn->query($sql) === TRUE) {
                echo "Produto,$nome, inserido com sucesso!";

            } else {

                echo "Erro ao inserir produto!";
            }
        } else {
            echo "Produto já existente!";
        }

    }
    else
    {
        echo "Preencha os dados corretamente!";
        echo "<br>";

    }


}

?>



