<?php
// config.php
try {
    $pdo = new PDO("sqlite:" . __DIR__ . "/database.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Limpa a tabela e cria de novo para não ter lixo
    $pdo->exec("DROP TABLE IF EXISTS users");
    $pdo->exec("CREATE TABLE users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        email TEXT,
        password TEXT,
        xp INTEGER,
        level INTEGER
    )");

    // Cria o Max Verstappen com a senha '123456'
    // IMPORTANTE: Estamos salvando a senha simples para testar agora
    $sql = "INSERT INTO users (name, email, password, xp, level) 
            VALUES ('Max Verstappen', 'teste@f1.com', '123456', 310, 33)";
    $pdo->exec($sql);

    echo "<h1>SUCESSO!</h1>";
    echo "<p>Usuário Max Verstappen criado!</p>";
    echo "<a href='login.php'>Ir para o Login</a>";

} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>