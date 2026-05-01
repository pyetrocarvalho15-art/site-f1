<?php
session_start();
require 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

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
        body { background-color: #000; color: white; font-family: sans-serif; margin: 0; padding: 40px; }
        
        .caixa-principal {
            background-color: #7d7d7d;
            border-radius: 40px;
            display: flex;
            max-width: 1200px;
            margin: auto;
            padding: 30px;
            min-height: 550px;
            color: #fff;
        }

        /* COLUNA 1: PERFIL */
        .perfil { flex: 1; text-align: center; border-right: 2px solid #666; padding-right: 15px; }
        .foto-piloto { width: 120px; height: 120px; border-radius: 50%; border: 3px solid #e10600; background: #fff; object-fit: cover; }
        .nome-piloto { font-family: 'Orbitron', sans-serif; color: #e10600; text-transform: uppercase; margin-top: 10px; }

        .barra-xp {
            background: #333;
            height: 20px;
            border-radius: 20px;
            margin: 20px auto;
            width: 85%;
            position: relative;
        }
        .progresso-vermelho {
            background: #e10600;
            height: 100%;
            width: 60%; 
            border-radius: 20px;
            position: relative;
        }

        /* COLUNA 2: QUIZZES */
        .quizzes { flex: 1.5; padding: 0 30px; border-right: 2px solid #666; }
        .card-gp {
            background: #999;
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            color: #000;
            font-weight: bold;
            transition: 0.3s;
        }
        .card-gp:hover { background: #bbb; transform: scale(1.02); }

        /* COLUNA 3: PÓDIO */
        .podio { flex: 1; padding-left: 15px; }
        .tabela-podio { width: 100%; color: #000; border-collapse: collapse; }
        .tabela-podio td { padding: 12px 5px; border-bottom: 1px solid #555; font-weight: bold; font-size: 14px; }
        
        a { text-decoration: none; color: inherit; }
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
        
        <p style="font-family: 'Orbitron';">XP: <strong><?php echo $user['xp']; ?></strong> | LVL: <strong><?php echo $user['level']; ?></strong></p>
        
        <div style="background: #440000; padding: 5px; text-align: center; font-weight: bold; margin-top: 10px; font-size: 12px; font-family: 'Orbitron';">BADGES:</div>

        <div style="display: flex; justify-content: center; align-items: flex-end; gap: 10px; margin-top: 15px;">
            <div style="text-align:center; width: 75px;"><img src="img/trofeu-prata.png" style="width: 40px;"><br><small style="font-size: 8px;">INICIANTE</small></div>
            <div style="text-align:center; width: 75px;"><img src="img/trofeu-7.png" style="width: 40px;"><br><small style="font-size: 8px;">7 DIAS</small></div>
            <div style="text-align:center; width: 75px;"><img src="img/trofeu-ouro.png" style="width: 40px;"><br><small style="font-size: 8px;">VELOCIDADE</small></div>
        </div>
    </div> 

    <div class="quizzes">
        <h3 style="text-align:center; font-family: 'Orbitron';">PRÓXIMOS GRAND PRIX</h3>
        <p style="text-align:center; font-weight:bold; margin-top:-10px;">QUIZ</p>
        
        <a href="quiz.php">
            <div class="card-gp" style="cursor: pointer;">
                <b style="font-size:25px; color:#e10600; margin-right:15px">1</b> 
                <div style="flex-grow:1; text-align:center; font-size:13px;">GP DE PYTHON <br> <small>(Sintaxe Básica) | +20XP</small></div>
            </div>
        </a>

        <div class="card-gp" style="opacity:0.6">
            <b style="font-size:25px; margin-right:15px">2</b> 
            <div style="flex-grow:1; text-align:center;">GP DE JAVASCRIPT</div> 🔒
        </div>

        <div class="card-gp" style="opacity:0.6">
            <b style="font-size:25px; margin-right:15px">3</b> 
            <div style="flex-grow:1; text-align:center;">GP DE BANCO DE DADOS</div> 🔒
        </div>
    </div>

    <div class="podio">
        <h3 style="text-align:center; font-family: 'Orbitron';">PÓDIO</h3>
        <div style="display: flex; justify-content: space-between; font-size: 10px; font-weight: bold; margin-bottom: 5px; color: #333;">
            <span>POS. PILOTO</span>
            <span>XP Semanal</span>
        </div>
        <table class="tabela-podio">
            <tr><td>1º</td><td>SENNACODER</td><td>(360xp)</td></tr>
            <tr style="background:#ffca28"><td>2º</td><td><?php echo $user['name']; ?></td><td>(<?php echo $user['xp']; ?>xp)</td></tr>
            <tr><td>3º</td><td>PROSTDEV</td><td>(280xp)</td></tr>
            <tr><td>4º</td><td>POLTCADER</td><td>(270xp)</td></tr>
            <tr><td>5º</td><td>LANNA</td><td>(260xp)</td></tr>
        </table>
    </div>
</div> 

<p style="text-align:center; margin-top:20px">
    <a href="logout.php" style="color:red; text-decoration:none; font-weight:bold; font-family: 'Orbitron';">SAIR DO SISTEMA</a>
</p>

</body>
</html>