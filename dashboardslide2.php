<?php
session_start();
require 'db.php'; // Conecta no banco para pegar o nome e XP

// Se o cara tentar entrar direto sem logar no slide 1, ele é expulso
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Pega os dados do Max Verstappen que o config.php criou
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>StudyRank - Cockpit</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* TUDO O QUE SERIA O CSS VAI AQUI DENTRO */
        body { background-color: #000; color: white; font-family: sans-serif; margin: 0; padding: 40px; }
        
        /* O fundo cinza igual ao seu Canva */
        .caixa-principal {
            background-color: #7d7d7d;
            border-radius: 40px;
            display: flex;
            max-width: 1100px;
            margin: auto;
            padding: 30px;
            min-height: 500px;
            color: #fff;
        }

        .perfil { flex: 1; text-align: center; border-right: 2px solid #666; }
        .foto-piloto { width: 120px; height: 120px; border-radius: 50%; border: 3px solid #e10600; background: #fff; }
        .nome-piloto { font-family: 'Orbitron', sans-serif; color: #e10600; text-transform: uppercase; }

        /* Barra de progresso com o carrinho */
        .barra-xp {
            background: #333;
            height: 20px;
            border-radius: 20px;
            margin: 20px auto;
            width: 80%;
            position: relative;
        }
        .progresso-vermelho {
            background: #e10600;
            height: 100%;
            width: 60%; /* Depois o PHP calcula isso */
            border-radius: 20px;
        }

        .quizzes { flex: 1.5; padding: 0 30px; }
        .card-gp {
            background: #999;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 15px;
            display: flex;
            align-items: center;
        }

        .podio { flex: 1; }
        .tabela-podio { width: 100%; background: #b1b1b1; color: #000; border-collapse: collapse; border-radius: 10px; overflow: hidden; }
        .tabela-podio td { padding: 10px; border-bottom: 2px solid #7d7d7d; font-weight: bold; }
    </style>
</head>
<body>

<div class="caixa-principal">
    <div class="perfil">
        <img src="img/perfil.png" class="foto-piloto" onerror="this.src='https://i.imgur.com/8Yv9D1p.png'">
        
        <h2 class="nome-piloto"><?php echo $user['name']; ?></h2>
        
        <div class="barra-xp">
            <div class="progresso-vermelho">
                <img src="img/carro.png" style="width:40px; position:absolute; right:-15px; top:-10px;" onerror="this.src='https://i.imgur.com/mSQUG5p.png'">
            </div>
        </div>
        
        <p>XP: <strong><?php echo $user['xp']; ?></strong> | LVL: <strong><?php echo $user['level']; ?></strong></p>
        
        <div style="display: flex; justify-content: center; gap: 15px; margin-top: 10px;">
            <div style="text-align:center;">
                <img src="img/badge1.png" width="40" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3112/3112946.png'">
                <br><small style="font-size:10px">INICIANTE</small>
            </div>
            <div style="text-align:center;">
                <img src="img/badge2.png" width="40" onerror="this.src='https://cdn-icons-png.flaticon.com/512/179/179249.png'">
                <br><small style="font-size:10px">7 DIAS</small>
            </div>
        </div>
    </div>

    <div class="quizzes">
        <h3 style="text-align:center">PRÓXIMOS GRAND PRIX</h3>
        <div class="card-gp"><b style="font-size:25px; color:#ffca28; margin-right:15px">1</b> GP DE PYTHON</div>
        <div class="card-gp" style="opacity:0.5"><b style="font-size:25px; margin-right:15px">2</b> GP DE JAVASCRIPT 🔒</div>
    </div>

    <div class="podio">
        <h3 style="text-align:center">PÓDIO</h3>
        <table class="tabela-podio">
            <tr><td>1º</td><td>SENNACODER</td></tr>
            <tr><td style="background:#ffca28">2º</td><td style="background:#ffca28"><?php echo $user['name']; ?></td></tr>
            <tr><td>3º</td><td>PROSTDEV</td></tr>
        </table>
    </div>
</div>

<p style="text-align:center; margin-top:20px">
    <a href="lgout.php" style="color:red; text-decoration:none">SAIR DO SISTEMA</a>
</p>

</body>
</html>