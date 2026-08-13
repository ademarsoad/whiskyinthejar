<?php
require('controllers/conexao.php');
$abrirfavoritos = "";
session_start();

if (isset($_SESSION['usuario_id'])) {
    echo "Usuario " . $_SESSION['usuario_nome'] . " Logado ";
    $abrirfavoritos = "mostrarfavoritos";
}
if(isset($_POST['search'])) {$nomepesquisa = $_POST['search']; } else {$nomepesquisa = ""; };


$stmt = $conn->prepare("SELECT w.id, w.nome, w.descricao, w.imagemwhisky, t.tipo from whiskys w
inner join tipowhisky t on w.tipo = t.id WHERE w.nome like :nome or t.tipo like :nome" );
$stmt->bindValue(":nome", "%$nomepesquisa%");

$stmt->execute();

$listaehisky = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ptbr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="src/css/style.css">
    <title>Whiskys</title>

    <style>

    </style>

</head>

<body>
    <?php include('view/header.php'); ?>
    <form action="" method="post">
        <div id="search" >
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" id="search" placeholder="Pesquise seu Whisky">
        </div>
    </form>



    <!-- Lista de whiskys -->
    <div id="listaWhiskys">
        <?php foreach ($listaehisky as $whisky) { ?>
        
            <div class="whisky-card">
                <h2><?php echo $whisky['nome']; ?></h2>
                <p class="whiskycardtipo"><?php echo $whisky['tipo']; ?></p>
                <img src="src/img/<?php echo $whisky['imagemwhisky']; ?>" alt="<?php echo $whisky['nome'] . " " . $whisky['tipo']; ?>">

                <!-- <button>Saiba Mais</button> -->
                <a href="detalheswhisky.php?id_whisky=<?php echo $whisky['id']; ?>">Mais Detalhes</a>
            </div>

        <?php } ?>
    </div>
</body>

</html>