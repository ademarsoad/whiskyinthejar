<?php
session_start();

if(isset($_SESSION['usuario_tipo']) == 'admin') {
 echo "Administrador entrando no site";
} else {
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="ptbr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style.css">
    <title>Administração</title>
</head>
<body>
    <?php include('../view/header_admin.php'); ?>
<section>
    <h2>Bem Vindo a Area de Administração</h2>
</section>

</body>
</html>