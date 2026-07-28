<?php

require('controllers/conexao.php');

$stmt = $conn->prepare("SELECT w.nome, w.descricao, t.tipo from whiskys w
inner join tipowhisky t on w.tipo = t.id");
$stmt->execute();

$listaehisky = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/css/style.css">
  <title>Adega Virtual de Whiskys</title>
  <style>

  </style>
</head>

<body>
  <?php include('view/header.php') ?>

  
    <div class="carousel">
      <div class="slides">
        <img src="src/img/banner1.png" alt="Banner1">
        <img src="src/img/banner2.png" alt="Banner 2">
        <img src="src/img/banner3.png" alt="Banner 3">
      </div>
    </div>
  
  <section id="propaganda">
    <img src="src/img/banner-promo.png" alt="promoções banners">
  </section>

    <!-- Lista de whiskys -->
    <div id="listaWhiskys">
      <?php foreach ($listaehisky as $whisky) { ?>
        <div class="whisky-card">
          <h2><?php echo $whisky['nome']; ?></h2>
          <p><?php echo $whisky['tipo']; ?></p>
          <img src="src/img/<?php echo $whisky['nome'] . ".jpg" ?>" alt="<?php echo $whisky['nome'] . " " . $whisky['tipo']; ?>">

          <button>Adicionar aos Favoritos</button>
        </div>

      <?php } ?>
    </div>

  <footer>
    © 2026 Adega Virtual - Seus melhores whiskys em um só lugar
  </footer>

  <script src="src/js/script.js"></script>
</body>

</html>