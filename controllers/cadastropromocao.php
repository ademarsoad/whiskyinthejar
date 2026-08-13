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

$stmt = $conn->prepare("select p.id, p.loja, p.valor_original, p.valor_desconto, p.link, p.is_active, w.nome from promocao p
inner join whiskys w on p.id_whisky = w.id");
$stmt->execute();

$lista_promo = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['id_promo'])) {
    $stmt = $conn->prepare("select p.id, p.loja, p.valor_original, p.valor_desconto, p.link, p.is_active, w.nome from promocao p
inner join whiskys w on p.id_whisky = w.id WHERE p.id = :id_promo");
    $stmt->bindValue(":id_promo", $_GET['id_promo']);
    $stmt->execute();
    $edit_promo = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ptbr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Cadastro Promoções</title>

    <style>
        /* .sec_table {
            width: 100%;

        }

        .tab_whisky {
            width: 90%;
            text-align: center;
            margin: 0 auto;
        }

        .tab_whisky tr td {
            padding: 8px;
        }

        tr th a {
            text-decoration: none;
            color: #;
        } */
        /* .tab_whisky tr:nth-child(even) {
            background-color: #fff;
        }
        .tab_whisky tr:nth-child(odd) {
            background-color: red;
    } */
    </style>
</head>

<body>
    <?php include('../view/header_admin.php'); ?>

    <div id="container">
        <form action="" method="post">
            <h2>Cadastro de Promoções</h2>
            <label for="loja">Loja</label>
            <input type="text" name="loja" id="loja" value="<?php if(isset($_GET['id_promo'])) {echo $edit_promo['loja'];} ?>">
            <label for="vallor_original">Valor Normal</label>
            <input type="text" name="valor_original" id="valor_original" value="<?php if(isset($_GET['id_promo'])) {echo $edit_promo['valor_original'];} ?>">
            <label for="vallor_desconto">Valor Com Desconto</label>
            <input type="text" name="valor_desconto" id="valor_desconto" value="<?php if(isset($_GET['id_promo'])) {echo $edit_promo['valor_desconto'];} ?>">
            <label for="link">Link do Produto</label>
            <input type="text" name="link" id="link" value="<?php if(isset($_GET['id_promo'])) {echo $edit_promo['loja'];} ?>">
            <label for="whisky">Whisky</label><br>
            <select id="whisky" name="whisky_select">
                <option value="<?php if(isset($_GET['id_promo'])) {echo $edit_promo['id'];} ?>"><?php if(isset($_GET['id_promo'])) {echo $edit_promo['nome'];} ?></option>
                <?php foreach ($result as $res) { ?>
                    <option value="<?php echo $res['id'] ?>"><?php echo $res['nome'] ?></option>
                <?php  } ?>
            </select>


            <h3>Está ativo</h3>
            <br>
            <label for="active">Sim</label>
            <input type="radio" name="active" id="active" value="1" <?php if(isset($_GET['id_promo'])) {if($edit_promo['is_active'] == 1) echo  "checked";} ?>>
            <label for="active">Não</label>
            <input type="radio" name="active" id="active" value="0" <?php if(isset($_GET['id_promo'])) {if($edit_promo['is_active'] == 0) echo  "checked";} ?>>
            <br>
            <br>

            <button>Cadastrar</button>

        </form>
    </div>
<hr>
    <section class="sec_table">

        <table class="tab_whisky">
            <tr>
                <th>Loja</th>
                <th>Whisky</th>
                <th>Valor Normal</th>
                <th>Valor Com desconto</th>
                <th>Link do Produto</th>
                <th>Está Ativo</th>
                <th></th>
            </tr>
            <?php foreach ($lista_promo as $lista) { ?>
                <tr>
                    <th><?php echo $lista['loja']; ?></th>
                    <th><?php echo $lista['nome']; ?></th>
                    <th><?php echo $lista['valor_original']; ?></th>
                    <th><?php echo $lista['valor_desconto']; ?></th>
                    <th><?php echo mb_strimwidth($lista['link'], 0, 50, "..."); ?></th>
                    <th><?php if ($lista['is_active'] == 1) {
                            echo "Sim";
                        } else {
                            echo "Não";
                        }; ?></th>
                    <th><a href="cadastropromocao.php?id_promo=<?php echo $lista['id']; ?>"><i class="fa-solid fa-pen-to-square"></i> </a>
                        <i class="fa-solid fa-trash"></i>
                    </th>
                </tr>
            <?php } ?>
        </table>

    </section>
</body>

</html>