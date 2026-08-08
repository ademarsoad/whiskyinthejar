<?php
require('conexao.php');

session_start();

if(isset($_SESSION['usuario_tipo']) == 'admin') {
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
        

        // $stmt = $conn->prepare("INSERT INTO whiskys (nome, descricao, imagemwhisky) VALUES (:nome, :descricao, :imagem)");
        // $stmt->bindValue(":nome", $_POST['nome']);
        // $stmt->bindValue(":descricao", $_POST['descricao']);
        // $stmt->bindValue(":imagem", $fileName);

        // $stmt->execute();

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


?>

<!DOCTYPE html>
<html lang="ptbr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style.css">
    <title>Cadastro de Whisky</title>
</head>

<body>
    <?php include('../view/header_admin.php'); ?>
    <div class="container">
        <!-- Formulário de cadastro -->
        <form id="formWhisky" method="post" enctype="multipart/form-data">
            <h2>Cadastrar Novo Whisky</h2>
            <label for="nome">Nome do Whisky:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>

            <label for="promo">Promoção (opcional):</label>
            <input type="text" id="promo">

            <label>Imagem:</label><br>
            <input type="file" name="imagem" id="imagem" accept="image/*" required><br><br>

            <!-- Pré-visualização -->
            <img id="preview" src="" alt="Pré-visualização" style="max-width:200px; display:none;"><br><br>
            <button type="submit">Adicionar Whisky</button>
        </form>

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