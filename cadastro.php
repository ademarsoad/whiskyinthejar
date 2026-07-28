<?php

include("controllers/conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bindValue("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso! <a href='controllers/login.php'>Faça login</a>";
    } else {
        echo "Erro: ";
    }
}
?>
<!DOCTYPE html>
<html lang="ptbr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style.css">
    <title>Cadastro Clientes</title>
</head>

<body>
    <?php include('view/header.php') ?>
    <form method="POST">
        <h2>Cadastro</h2>
        <label>Nome:</label><input type="text" name="nome" required><br>
        <label>Email:</label><input type="email" name="email" required><br>
        <label>Senha:</label><input type="password" name="senha" required><br>
        <button type="submit">Cadastrar</button>
    </form>

</body>

</html>