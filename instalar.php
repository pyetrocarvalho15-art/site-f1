<?php
$host = '127.0.0.1';
$user = 'root';
$pass = 'alunolab';
try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria o banco de dados [cite: 16]
    $pdo->exec("CREATE DATABASE IF NOT EXISTS meu_studyrank");
    $pdo->exec("USE meu_studyrank");

    // Cria a tabela de usuários com XP e Level 
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        avatar VARCHAR(255) NULL,
        xp INT DEFAULT 0,
        level INT DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Cria o seu usuário de teste 
    $senhaHash = password_hash('123456', PASSWORD_BCRYPT);
    $pdo->exec("INSERT IGNORE INTO users (name, email, password, xp, level) 
                VALUES ('Piloto Teste', 'teste@f1.com', '$senhaHash', 0, 1)");

    echo "<h1>✅ Tudo pronto! O banco e o usuário foram criados.</h1>";
    echo "<p>Agora você já pode ir para a <a href='login.php'>Tela de Login</a>.</p>";

} catch (PDOException $e) {
    echo "❌ Erro: " . $e->getMessage();
}
?>