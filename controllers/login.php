<?php

session_start();

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email=:s");
    $stmt->bindValue(":s", $email);
    $stmt->execute();
    

    if ($row = $stmt->fetch(pdo::FETCH_ASSOC)) {
        if (password_verify($senha, $row['senha'])) {
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['usuario_nome'] = $row['nome'];
            header("Location: ../index.php");
            exit;
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
}
?>
<!DOCTYPE html>
<html lang="ptbr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style.css">
    <title>Login Cliente</title>
</head>
<body>
    <?php include_once('../view/header.php'); ?>
<form method="POST">
  <h2>Login</h2>
  <label>Email:</label><input type="email" name="email" required><br>
  <label>Senha:</label><input type="password" name="senha" required><br>
  <button type="submit">Entrar</button>
  <div>
      <a href="../cadastro.php">Cadastrar-se</a>
  </div>
</form>
<a href="logout.php">Logout</a>
    
</body>
</html>
