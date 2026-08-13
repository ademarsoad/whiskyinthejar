<?php
require('conexao.php');

session_start();

if (isset($_SESSION['usuario_tipo']) == 'admin') {
    echo "Administrador entrando no site";
} else {
    header("Location: ../index.php");
}


$targetDir = "../src/img/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $fileName = basename($_FILES['imagem']['name']);
        $targetFile = $targetDir . $fileName;

        echo $targetFile;


        $stmt = $conn->prepare("INSERT INTO whiskys (nome, descricao, imagemwhisky) VALUES (:nome, :descricao, :imagem)");
        $stmt->bindValue(":nome", $_POST['nome']);
        $stmt->bindValue(":descricao", $_POST['descricao']);
        $stmt->bindValue(":imagem", $fileName);

        $stmt->execute();

        // Move o arquivo para a pasta uploads
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $targetFile)) {
            echo "Cadastro realizado com sucesso!<br>";
            echo "<img src='$targetFile' style='max-width:200px;'>";
        } else {
            echo "Erro ao salvar a imagem.";
        }
    } else {
        echo "Nenhuma imagem enviada.";
    }
}
if (isset($_GET['id_whisky'])) {
    echo "Atualizando " . $_GET['id_whisky'];
    $stmt = $conn->prepare("SELECT w.id, w.nome, w.descricao, w.imagemwhisky, t.tipo from whiskys w
inner join tipowhisky t on w.tipo = t.id Where w.id = :idwhisky");
    $stmt->bindValue(":idwhisky", $_GET['id_whisky']);
    $stmt->execute();
    $editlista = $stmt->fetch(PDO::FETCH_ASSOC);
}

$stmt = $conn->prepare("SELECT w.id, w.nome, w.descricao, w.imagemwhisky, t.tipo from whiskys w
inner join tipowhisky t on w.tipo = t.id");
// $stmt->bindValue(":nome", "%$nomepesquisa%");

$stmt->execute();

$listaehisky = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ptbr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Cadastro de Whisky</title>

    <style>
        .sec_table {
            width: 100%;

        }

        .tab_whisky {
            width: 80%;
            text-align: center;
            margin: 0 auto;
        }

        .tab_whisky tr td {
            padding: 8px;
        }

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
    <section>
        <div class="container">
            <!-- Formulário de cadastro -->
            <form id="formWhisky" method="post" enctype="multipart/form-data">
                <h2>Cadastrar Novo Whisky</h2>
                <label for="nome">Nome do Whisky:</label>
                <input type="text" id="nome" name="nome" value="<?php if (isset($_GET['id_whisky'])) {
                                                                    echo $editlista['nome'];
                                                                }; ?>" required>

                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" required><?php if (isset($_GET['id_whisky'])) {
                                                                        echo $editlista['descricao'];
                                                                    }; ?></textarea>

                <label for="tipo">Tipo do Whisky</label>
                <input type="text" id="tipo" name="tipo" value="<?php if (isset($_GET['id_whisky'])) {
                                                                    echo $editlista['tipo'];
                                                                }; ?>">

                <label>Imagem:</label><br>
                <input type="file" name="imagem" id="imagem" accept="image/*" required><br><br>

                <!-- Pré-visualização -->
                <img id="preview" src="" alt="Pré-visualização" style="max-width:200px; display:none;"><br><br>
                <button type="submit"><?php if (isset($_GET['id_whisky'])) {
                                            echo "Editar Whisky";
                                        } else {
                                            echo "Cadastrar Whisky";
                                        }; ?></button>
            </form>
        </div>
    </section>
    <section class="sec_table">

        <table class="tab_whisky">
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Tipo do Whisky</th>
                <th></th>
            </tr>
            <?php foreach ($listaehisky as $lista) { ?>
                <tr>
                    <td><?php echo $lista['nome']; ?></td>
                    <td>25</td>
                    <td><?php echo $lista['tipo']; ?></td>
                    <td><a href="cadastrarwhisky.php?id_whisky=<?php echo $lista['id']; ?>"><i class="fa-solid fa-pen-to-square"></i> </a>
                        <i class="fa-solid fa-trash"></i>
                    </td>
                </tr>
            <?php } ?>
        </table>

    </section>
    <script>
        // JavaScript para pré-visualizar a imagem
        document.getElementById("imagem").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById("preview");
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>