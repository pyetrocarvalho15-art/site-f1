<?php
// dashboard.php
session_start();

// Verifica se o usuário NÃO está logado (Middleware auth manual)
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redireciona para login se não estiver logado
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - StudyRank F1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #000; color: #fff; }
        .f1-card { border: 1px solid #333; border-radius: 10px; background-color: #111; padding: 20px; box-shadow: 0 4px 8px rgba(255,255,255,0.05); }
        .f1-xp-bar { height: 10px; background-color: #333; border-radius: 5px; overflow: hidden; }
        .f1-xp-progress { height: 100%; background-color: #e10600; width: 30%; /* Ajustar dinamicamente */ }
        .f1-logo { color: #e10600; font-weight: bold; font-size: 1.5rem; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark border-bottom border-secondary">
        <div class="container-fluid">
            <span class="f1-logo navbar-brand mb-0 h1">F1 StudyRank</span>
            <div class="d-flex text-muted align-items-center">
                <span>Bem-vindo, <strong><?php echo $_SESSION['user_name']; ?></strong></span>
                <img src="<?php echo $_SESSION['user_avatar'] ?? 'path_to_default_avatar.png'; ?>" alt="Avatar" class="rounded-circle ms-2" width="30">
                <a href="logout.php" class="btn btn-sm btn-outline-danger ms-3">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Seu Paddock Pessoal</h2>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="f1-card text-center">
                    <img src="<?php echo $_SESSION['user_avatar'] ?? 'path_to_default_avatar.png'; ?>" alt="Avatar" class="rounded-circle mb-3" width="100">
                    <h3><?php echo $_SESSION['user_name']; ?></h3>
                    <p class="text-muted"><?php echo $_SESSION['user_email']; ?></p>
                    <hr class="border-secondary">
                    <h5>Nível: <span class="text-info"><?php echo $_SESSION['user_level']; ?></span></h5>
                    
                    <div class="d-flex justify-content-between text-muted small mt-2">
                        <span>XP Atual: <strong><?php echo $_SESSION['user_xp']; ?></strong></span>
                        <span>Próximo Nível (ex): 1000XP</span>
                    </div>
                    <div class="f1-xp-bar mt-1">
                        <div class="f1-xp-progress" style="width: <?php echo ($_SESSION['user_xp'] / 1000) * 100; ?>%;"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="f1-card mb-4">
                    <h5>Badges Conquistados (Exigido Pág 1: Badges)</h5>
                    <div class="text-muted">Ainda nenhum troféu no armário. Corra os desafios!</div>
                </div>
                <div class="f1-card">
                    <h5>Próximos Desafios (Dashboard Pág 1)</h5>
                    <div class="text-muted">Desafio GP de Backend #1 (Quiz Laravel Migrations) - <a href="quiz.php?id=1" class="text-danger">Iniciar Corrida</a></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>