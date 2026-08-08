<?php

require('conexao.php');
session_start();

if (isset($_SESSION['usuario_tipo']) == 'admin') {
    echo "Administrador entrando no site";
} else {
    header("Location: ../index.php");
}
$stmt = $conn->prepare('SELECT * FROM whiskys ORDER BY nome');
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare('INSERT INTO promocao (loja, valor_original, valor_desconto, link, id_whisky, is_active)
    Values (:l, :vo, :vd, :link, :id, :ac)');
    $stmt->bindValue(":l", $_POST['loja']);
    $stmt->bindValue(":vo", $_POST['valor_original']);
    $stmt->bindValue(":vd", $_POST['valor_desconto']);
    $stmt->bindValue(":link", $_POST['link']);
    $stmt->bindValue(":id", $_POST['whisky_select']);
    $stmt->bindValue(":ac", $_POST['active']);

    $stmt->execute();

    echo $_POST['whisky_select'] . " " . $_POST['active'];
}

?>

<!DOCTYPE html>
<html lang="ptbr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style.css">
    <title>Cadastro Promoções</title>
</head>

<body>
    <?php include('../view/header_admin.php'); ?>

    <div id="container">
        <form action="" method="post">
            <h2>Cadastro de Promoções</h2>
            <label for="loja">Loja</label>
            <input type="text" name="loja" id="loja">
            <label for="vallor_original">Vaor Normal</label>
            <input type="text" name="valor_original" id="valor_original">
            <label for="vallor_desconto">Valor Com Desconto</label>
            <input type="text" name="valor_desconto" id="valor_desconto">
            <label for="link">Link do Produto</label>
            <input type="text" name="link" id="link">
            <label for="whisky">Whisky</label>
            <select id="whisky" name="whisky_select">
                <option value="">Selecione o Whisky</option>
                <?php foreach ($result as $res) { ?>
                    <option value="<?php echo $res['id'] ?>"><?php echo $res['nome'] ?></option>
                <?php  } ?>
            </select>
            <div style="display: flex;">
                <label for="active">Está Ativo</label>
                <input type="radio" name="active" id="active" value="1">Sim
                <input type="radio" name="active" id="active" value="0">Não
            </div>

            <button>Cadastrar</button>

        </form>
    </div>

</body>

</html>