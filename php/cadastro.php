<?php
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmar-senha'];

    // Verifica se as senhas coincidem
    if ($senha !== $confirmarSenha) {
        die("As senhas não coincidem. <a href='../index.html'>Voltar</a>");
    }

    // Criptografa a senha
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    try {
        // Prepara e executa a consulta SQL para inserir o usuário
        $sql = "INSERT INTO usuarios (nome, sobrenome, email, senha, created_at) 
                VALUES (:nome, :sobrenome, :email, :senha, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':sobrenome' => $sobrenome,
            ':email' => $email,
            ':senha' => $senhaCriptografada
        ]);

        echo "Cadastro realizado com sucesso! <a href='../login.html'>Faça login aqui</a>";

    } catch (PDOException $e) {
        if ($e->getCode() === '23000') {
            echo "E-mail já cadastrado. <a href='../index.html'>Voltar</a>";
        } else {
            die("Erro ao cadastrar: " . $e->getMessage());
        }
    }
} else {
    die("Método de requisição inválido.");
}
?>
