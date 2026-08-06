<?php

require('controllers/conexao.php');

$stmt = $conn->prepare("select w.nome, w.imagemwhisky, p.loja, p.valor_original, p.valor_desconto, p.link, p.is_active from promocao p
inner join whiskys w on w.id = p.id_whisky order by p.id desc");

$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ptbr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style.css">

    <title>Promoções</title>
</head>

<body>
    <?php include('view/header.php'); ?>

    <section id="promocoes">
        <div class="wrap">
            <div class="sec-head">
                <div>
                    <span class="eyebrow">Atualizado hoje</span>
                    <h2>Promoções em destaque</h2>
                </div>
                <a href="#" class="sec-link">Ver todas as promoções →</a>
            </div>

            <?php foreach ($result as $res) { if($res['is_active'] == 1) { ?>
                <a href="<?php echo $res['link']; ?>" target="_blank" class="promo_link">
                    <div class="deal-strip">
                        <div class="deal-glass">
                            <img src="src/img/<?php echo $res['imagemwhisky']; ?>" alt="">
                            <path d="M10 4H36L33 26C33 26 38 34 38 46C38 58 30 66 23 66C16 66 8 58 8 46C8 34 13 26 13 26L10 4Z"
                                stroke="#C6883F" stroke-width="1.6" />
                            <path d="M11 44H35" stroke="#C6883F" stroke-width="1.2" opacity="0.5" />
                            </svg>
                        </div>
                        <div class="deal-info">
                            <h4><?php echo $res['nome']; ?></h4>
                            <div class="specline">15 ANOS · 43% ABV · 700ML</div>
                            <div class="deal-badges"><span class="badge <?php echo strtolower($res['loja']); ?>"><?php echo $res['loja']; ?></span>
                            </div>
                        </div>
                        <div class="deal-cta">
                            <div class="deal-price"><span class="old"><?php echo "R$ " . $res['valor_original'] ?></span><span class="new"><?php echo "R$ " . $res['valor_desconto'] ?></span></div>
                            <div class="deal-off"><?php echo round(($res['valor_original'] - $res['valor_desconto']) / $res['valor_original'] * 100, 0) . "%"; ?></div>
                        </div>
                    </div>
                </a>
            <?php } }?>
        </div>
    </section>
</body>

</html>