<?php

require('controllers/conexao.php');

$stmt = $conn->prepare('Select w.nome, w.imagemwhisky, w.descricao, tp.tipo, tp.descricao from whiskys w
inner join tipowhisky tp on w.tipo = tp.id WHERE W.id = :id');
$stmt->bindValue(":id", $_GET['id_whisky']);
$stmt->execute();



$result = $stmt->fetch(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="ptbr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Detalhes do Whisky</title>
    
    <style>
        .sec_detalhe {
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .cont_detalhe {
            width: 45%;

        }
        .cont_img {
            background: repeating-radial-gradient(red, #211e1e00 408px);
            text-align: center;
        }
        div img {
            width: 240px;
            height: auto;
            transform: rotate(-45deg);
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include('view/header.php'); ?>
    <h1>Detalhes</h1>
    <section class="sec_detalhe">
        <div class="cont_detalhe">
            <h2><?php echo $result['nome']; ?></h2>
            <p><?php echo $result['descricao']; ?></p>
        </div>
        <div class="cont_detalhe cont_img">
            <img src="src/img/<?php echo $result['imagemwhisky']; ?>" alt="">
        </div>
    </section>
</body>
</html>