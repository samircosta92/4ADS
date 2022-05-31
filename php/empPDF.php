<?php
$mat = $_GET["matricula"];
$cod = $_GET["codigo"];
$dataEMP = $_GET["dataEMP"];
$dataDEV = $_GET["dataDev"];
$id = $_GET["idEMP"];


require_once "../dompdf/autoload.inc.php";
use Dompdf\Dompdf;
$pdf = new DomPdf();
$pdf -> loadHtml("
<title>Recibo de empréstimo</title>
<style>
    .borda{
        margin: 30px;
        border: 5px solid black;
        width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .topo{
        border: 5px solid black;
        height: 150px;
        margin: 5px;
        margin-left: auto;
        margin-right: auto;
    }
    .dados{
        border-collapse: collapse;
        width: 570px;
        margin: 15px;
    }
    tr{
        border: 2px solid #000000 ;
    }
    .observacoes{
        border: 5px solid #FFFFFF;
        height: 100px;
        margin: 15px;
    }
</style>
</head>
<body>
<div class='borda'>
    <div class='topo'>
            <figure>
                <figcaption style='text-align: center'>Biblioteca Universitária</figcaption>
                <img src='../imagens/1920478300008.jpg' width='65px' height='30px' style='text-align: center'>
                <p style='text-align: center'>Recibo de empréstimo</p>
                <p style='text-align: center' >Data de emissão: <?$dataEMP</p>
            </figure>   
    </div>
    <table class='dados'>
        <tr>
            <th>Código do empréstimo:</th>
            <th><?$id</th>
        </tr>
        <tr>
            <th>Matrícula:</th>
            <th><?$mat</th>
        </tr>
        <tr>
            <th>Data de empréstimo:</th>
            <th><?$dataEMP</th>
        </tr>
        <tr>
            <th>Data de devolução</th>
            <th><?$dataDEV</th>
        </tr>
    </table>
    <div class='observacoes'>
        <p>Obs: Caso a devolução seja feita além do prazo, o aluno fica ciente de que estará sujeito a restrições em futuros empréstimos!</p>
    </div>
</div>
</body>
</html>");

$pdf->render();
$pdf->stream("Empréstimo.pdf",array("Attachment" => false));


?>








