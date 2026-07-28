<?php
$host = "localhost";
$database = "whiskyinthejar";
$senha = "";
$user = "root";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $senha);

} catch (PDOException $e) {

    die("Erro na conexão: " . $e->getMessage());
}
