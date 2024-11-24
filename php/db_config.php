<?php
$host = 'localhost';
$dbname = 'areias_tech';
$user = 'root'; // Substitua pelo usuário do banco de dados
$password = ''; // Substitua pela senha do banco de dados

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
