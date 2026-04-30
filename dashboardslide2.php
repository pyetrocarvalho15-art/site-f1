<?php
session_start();
// Se não estiver logado, volta para o login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - StudyRank F1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #000; 
            color: #fff; 
            font-family: 'Arial', sans-serif;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        /* Faixa vermelha no fundo igual à imagem */
        body::before {
            content: "";
            position: absolute;
            top: 0; right: 0;
            width: 40%; height: 100%;
            background: linear-gradient(135deg, transparent 50%, #e10600 20%);
            z-index: -1;
        }

        /* Logo F1 no topo esquerdo */
        .f1-logo { width: 50px; margin: 20px; }

        /* Card principal cinza escuro */
        .main-container {
            background-color: #2d2d2d;
            border-radius: 30px;
            margin: 20px auto;
            padding: 30px;
            width: 90%;
            max-width: 1100px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        /* Coluna do Perfil (Esquerda) */
        .profile-section { border-right: 2px solid #444; padding-right: 20px; }
        .avatar { width: 120px; height: 120px; border-radius: 50%; border: 4px solid #1a1a1a; margin-bottom: 10px; }
        .user-name { color: #e10600; font-weight: bold; font-size: 1.4rem; text-transform: uppercase; }
        .xp-bar-container { background: #1a1a1a; border-radius: 10px; height: 15px; margin: 15px 0; border: 2px solid #555; }
        .xp-bar-fill { background: #e10600; height: 100%; width: 60%; border-radius: 8px; }
        .badge-header { background: #4b0000; padding: 5px; font-weight: bold; font-size: 0.8rem; margin-top: 20px; }
        .badge-icon { width: 50px; margin: 10px 5px; }

        /* Coluna dos Quizzes (Centro) */
        .quiz-title { font-weight: bold; letter-spacing: 1px; }
        .quiz-item {
            background: #444;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #fff;
            transition: 0.3s;
        }
        .quiz-item:hover { background: #555; transform: scale(1.02); }
        .quiz-num { font-size: 2.5rem; font-weight: bold; color: #f1c40f; margin-right: 20px; }
        .quiz-details h6 { margin: 0; font-weight: bold; }
        .quiz-details small { color: #2ecc71; font-weight: bold; }

        /* Coluna do Pódio (Direita) */
        .podium-section { padding-left: 20px; }
        .table-podium { width: 100%; font-size: 0.9rem; }
        .table-podium th { color: #888; border-bottom: 1px solid #555; padding-bottom: 10px; }
        .table-podium td { padding: 10px 0; border-bottom: 1px solid #3d3d3d; }
        .pos-circle { 
            width: 25px; height: 25px; border-radius: 50%; border: 2px solid #f1c40f; 
            display: inline-block; text-align: center; font-weight: bold; color: #f1c40f;
        }
    </style>
</head>
<body>

    <img src="https://upload.wikimedia.org/wikipedia/commons/3/33/F1.svg" class="f1-logo" alt="F1">

    <div class="main-container">
        <div class="row">
            
            <div class="col-md-3 text-center profile-section">
                <img src="https://i.imgur.com/8K0p3Xv.png" class="avatar">
                <div class="user-name"><?php echo $_SESSION['user_name']; ?></div>
                
                <div class="xp-bar-container">
                    <div class="xp-bar-fill"></div>
                </div>
                
                <div class="d-flex justify-content-between small">
                    <span>XP: <?php echo $_SESSION['user_xp']; ?></span>
                    <span>NÍVEL: <?php echo $_SESSION['user_level']; ?></span>
                </div>

                <p class="mt-3 small text-muted">CONQUISTAS RECENTES:</p>
                <div class="badge-header">BADGES:</div>
                <div class="d-flex justify-content-center">
                    <img src="https://i.imgur.com/w1I8x9v.png" class="badge-icon" title="Iniciante">
                    <img src="https://i.imgur.com/mO6qf7W.png" class="badge-icon" title="7 dias Streak">
                    <img src="https://i.imgur.com/vH9jZ5O.png" class="badge-icon" title="Velocidade Máxima">
                </div>
            </div>

            <div class="col-md-5 text-center px-4">
                <h5 class="quiz-title mb-4">PRÓXIMOS GRAND PRIX<br>QUIZ</h5>
                
                <a href="quiz.php?id=1" class="quiz-item">
                    <div class="quiz-num">1</div>
                    <div class="quiz-details">
                        <h6>GP DE PYTHON</h6>
                        <p class="m-0 small">(Sintaxe Básica)</p>
                        <small>5 QUESTÕES | +20XP</small>
                    </div>
                </a>

                <div class="quiz-item opacity-50">
                    <div class="quiz-num" style="color: #888">2</div>
                    <div class="quiz-details"><h6>GP DE JAVASCRIPT 🔒</h6></div>
                </div>

                <div class="quiz-item opacity-50">
                    <div class="quiz-num" style="color: #888">3</div>
                    <div class="quiz-details"><h6>GP DE BANCO DE DADOS 🔒</h6></div>
                </div>
            </div>

            <div class="col-md-4 podium-section text-center">
                <h5 class="fw-bold mb-4">PÓDIO</h5>
                <table class="table-podium">
                    <thead>
                        <tr>
                            <th>POS.</th>
                            <th>PILOTO</th>
                            <th>XP Semanal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><span class="pos-circle">1</span></td><td>SENNACODER</td><td>(360 xp)</td></tr>
                        <tr style="color: #fff; font-weight: bold;">
                            <td><span class="pos-circle" style="color: #fff; border-color: #fff;">2</span></td>
                            <td>VOCÊ</td>
                            <td>(<?php echo $_SESSION['user_xp']; ?>xp)</td>
                        </tr>
                        <tr><td><span class="pos-circle" style="border-color: #888; color: #888;">3</span></td><td>PROSTDEV</td><td>(280xp)</td></tr>
                        <tr><td><span class="pos-circle" style="border-color: #888; color: #888;">4</span></td><td>POLTCADER</td><td>(270xp)</td></tr>
                        <tr><td><span class="pos-circle" style="border-color: #888; color: #888;">5</span></td><td>LAMNA</td><td>(260xp)</td></tr>
                    </tbody>
                </table>
                <a href="logout.php" class="btn btn-sm btn-outline-danger mt-4">SAIR DO PADDOCK</a>
            </div>

        </div>
    </div>

</body>
</html>