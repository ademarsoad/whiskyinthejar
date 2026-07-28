<?php

session_start();

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
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
<form method="POST">
  <h2>Login</h2>
  <label>Email:</label><input type="email" name="email" required><br>
  <label>Senha:</label><input type="password" name="senha" required><br>
  <button type="submit">Entrar</button>
</form>
<a href="register.php">Cadastrar-se</a>
