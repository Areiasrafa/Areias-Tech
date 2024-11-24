<?php
require 'db_config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        // Consulta o usuário no banco de dados
        $sql = "SELECT id, nome, sobrenome, senha FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário foi encontrado e a senha é válida
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Armazena informações do usuário na sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];

            // Redireciona para a página inicial
            header('Location: ../home.html');
            exit;
        } else {
            echo "E-mail ou senha inválidos. <a href='../login.html'>Tente novamente</a>";
        }
    } catch (PDOException $e) {
        die("Erro ao processar o login: " . $e->getMessage());
    }
} else {
    die("Método de requisição inválido.");
}
?>
