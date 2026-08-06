<?php

require('controllers/conexao.php');
$abrirfavoritos = "";
session_start();

if(isset($_SESSION['usuario_id'])) {
  echo "Usuario ". $_SESSION['usuario_nome'] . " Logado " ;
  $abrirfavoritos = "mostrarfavoritos";
}


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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <title>Adega Virtual de Whiskys</title>
  <style>

  </style>
</head>

<body>
  <?php include('view/header.php') ?>

  
    <div class="carousel">
      <div class="slides">
        <img src="src/img/IMG_20260805_101934_573.jpg" alt="Banner1">
        <img src="src/img/IMG_20260805_101941_126.jpg" alt="Banner 2">
        <img src="src/img/IMG_20260805_102202_568.jpg" alt="Banner 3">
      </div>
    </div>
  
  <section id="propaganda">
    <img src="src/img/banner-promo.png" alt="promoções banners">
  </section>

  <section id="tipos">
    <div class="wrap">
      <div class="sec-head">
        <div>
          <span class="eyebrow">Guia de estilos</span>
          <h2>Tipos de whisky, do malte ao tonel</h2>
        </div>
        <p>Seis famílias que resumem 90% do que se encontra nas prateleiras — organizadas pelo que realmente muda no
          copo.</p>
      </div>

      <div class="cat-grid">
        <a class="cat-card" href="#">
          <span class="cat-num">01</span>
          <h3>Single Malt</h3>
          <p>100% cevada maltada, produzido em uma única destilaria, em alambiques de cobre (pot still).</p>
          <div class="cat-meta"><span>ESCÓCIA</span><span>ALAMBIQUE DE COBRE</span></div>
        </a>
        <a class="cat-card" href="#">
          <span class="cat-num">02</span>
          <h3>Blended Scotch</h3>
          <p>Mistura de whiskies de malte e de grão vindos de várias destilarias, buscando equilíbrio e consistência.
          </p>
          <div class="cat-meta"><span>MÚLTIPLAS DESTILARIAS</span></div>
        </a>
        <a class="cat-card" href="#">
          <span class="cat-num">03</span>
          <h3>Bourbon</h3>
          <p>Mínimo 51% de milho no mosto, envelhecido em barris novos de carvalho americano tostado por dentro.</p>
          <div class="cat-meta"><span>EUA</span><span>BARRIL NOVO</span></div>
        </a>
        <a class="cat-card" href="#">
          <span class="cat-num">04</span>
          <h3>Rye Whiskey</h3>
          <p>Mínimo 51% de centeio no mosto, o que traz notas mais picantes e secas do que o bourbon tradicional.</p>
          <div class="cat-meta"><span>EUA / CANADÁ</span></div>
        </a>
        <a class="cat-card" href="#">
          <span class="cat-num">05</span>
          <h3>Whisky Japonês</h3>
          <p>Herda o método escocês, com refinamento próprio e uso de carvalho Mizunara em parte da maturação.</p>
          <div class="cat-meta"><span>JAPÃO</span><span>CARVALHO MIZUNARA</span></div>
        </a>
        <a class="cat-card" href="#">
          <span class="cat-num">06</span>
          <h3>Single Grain</h3>
          <p>Feito com grãos diversos (milho, trigo) em coluna de destilação contínua — geralmente mais leve e suave.
          </p>
          <div class="cat-meta"><span>DESTILAÇÃO CONTÍNUA</span></div>
        </a>
      </div>
    </div>
  </section>

  <section id="promocoes">
    <div class="wrap">
      <div class="sec-head">
        <div>
          <span class="eyebrow">Atualizado hoje</span>
          <h2>Promoções em destaque</h2>
        </div>
        <a href="#" class="sec-link">Ver todas as promoções →</a>
      </div>

      <div class="deal-strip">
        <div class="deal-glass">
          <img src="src/img/Ballantines10.jpg" alt="">
            <path d="M10 4H36L33 26C33 26 38 34 38 46C38 58 30 66 23 66C16 66 8 58 8 46C8 34 13 26 13 26L10 4Z"
              stroke="#C6883F" stroke-width="1.6" />
            <path d="M11 44H35" stroke="#C6883F" stroke-width="1.2" opacity="0.5" />
          </svg>
        </div>
        <div class="deal-info">
          <h4>Blended 12 anos — edição padrão</h4>
          <div class="specline">12 ANOS · 40% ABV · 1L</div>
          <div class="deal-badges"><span class="badge amazon">Amazon</span></div>
        </div>
        <div class="deal-cta">
          <div class="deal-price"><span class="old">R$ 249,90</span><span class="new">R$ 189,90</span></div>
          <div class="deal-off">−24% · exemplo</div>
        </div>
      </div>

      <div class="deal-strip">
        <div class="deal-glass">
          <img src="src/img/Johnnie Walker Black Label.jpg" alt="">
            <path d="M10 4H36L33 26C33 26 38 34 38 46C38 58 30 66 23 66C16 66 8 58 8 46C8 34 13 26 13 26L10 4Z"
              stroke="#C6883F" stroke-width="1.6" />
            <path d="M11 44H35" stroke="#C6883F" stroke-width="1.2" opacity="0.5" />
          </svg>
        </div>
        <div class="deal-info">
          <h4>Bourbon straight — barril novo</h4>
          <div class="specline">S/ IDADE DECLARADA · 45% ABV · 750ML</div>
          <div class="deal-badges"><span class="badge ml">Mercado Livre</span></div>
        </div>
        <div class="deal-cta">
          <div class="deal-price"><span class="old">R$ 159,00</span><span class="new">R$ 132,00</span></div>
          <div class="deal-off">−17% · exemplo</div>
        </div>
      </div>

      <div class="deal-strip">
        <div class="deal-glass">
          <img src="src/img/Johnnie Walker Blue Label.jpg" alt="">
            <path d="M10 4H36L33 26C33 26 38 34 38 46C38 58 30 66 23 66C16 66 8 58 8 46C8 34 13 26 13 26L10 4Z"
              stroke="#C6883F" stroke-width="1.6" />
            <path d="M11 44H35" stroke="#C6883F" stroke-width="1.2" opacity="0.5" />
          </svg>
        </div>
        <div class="deal-info">
          <h4>Single malt 15 anos — cask ex-xerez</h4>
          <div class="specline">15 ANOS · 43% ABV · 700ML</div>
          <div class="deal-badges"><span class="badge amazon">Amazon</span><span class="badge ml">Mercado Livre</span>
          </div>
        </div>
        <div class="deal-cta">
          <div class="deal-price"><span class="old">R$ 419,00</span><span class="new">R$ 359,00</span></div>
          <div class="deal-off">−14% · exemplo</div>
        </div>
      </div>
    </div>
  </section>

    <!-- Lista de whiskys -->
    <!-- <div id="listaWhiskys">
      <?php foreach ($listaehisky as $whisky) { ?>
        <div class="whisky-card">
          <h2><?php echo $whisky['nome']; ?></h2>
          <p class="whiskycardtipo"><?php echo $whisky['tipo']; ?></p>
          <img src="src/img/<?php echo $whisky['nome'] . ".jpg" ?>" alt="<?php echo $whisky['nome'] . " " . $whisky['tipo']; ?>">

          <button>Adicionar aos Favoritos</button>
        </div>

      <?php } ?>
    </div> -->

    <!-- Favoritos -->
    <div class="favoritos <?php if(isset($_SESSION['usuario_nome'])) { echo $abrirfavoritos; } ?>">
      <h2>Meus Favoritos</h2>
      <div id="listaFavoritos">
      </div>
    </div>
  </div>

  <footer>
    © 2026 Adega Virtual - Seus melhores whiskys em um só lugar
  </footer>

  <script src="src/js/script.js"></script>
</body>

</html>