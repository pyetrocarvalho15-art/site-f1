<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - StudyRank</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Fundo Preto com a Faixa Vermelha */
        body { 
            background-color: #000; 
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            font-family: 'Arial', sans-serif;
        }

        /* A Faixa Vermelha Diagonal */
        body::before {
            content: "";
            position: absolute;
            width: 150%;
            height: 40px;
            background: linear-gradient(90deg, transparent, #e10600, transparent);
            transform: rotate(-35deg);
            z-index: 0;
        }

        /* Logo F1 no topo */
        .f1-logo-top {
            width: 80px;
            margin-bottom: 20px;
            z-index: 1;
        }

        /* Card Cinza Transparente (Glassmorphism) */
        .login-card { 
            background: rgba(255, 255, 255, 0.2); /* Transparência cinza */
            backdrop-filter: blur(10px); /* Efeito de vidro */
            border-radius: 30px;
            padding: 40px;
            width: 100%;
            max-width: 380px;
            text-align: center;
            z-index: 2;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .login-title {
            color: #fff;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }

        .label-text {
            color: #fff;
            font-size: 0.7rem;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        /* Inputs Arredondados e Cinzas */
        .form-control { 
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 50px; /* Bem arredondado como na imagem */
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: none;
            color: #fff;
        }

        /* Botão Entrar Vermelho Arredondado */
        .btn-entrar {
            background: linear-gradient(to right, #800000, #e10600, #800000);
            border: none;
            border-radius: 50px;
            color: #fff;
            font-weight: bold;
            padding: 10px 60px;
            margin-top: 30px;
            z-index: 2;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        }

        .btn-entrar:hover {
            opacity: 0.9;
            color: #fff;
        }
    </style>
</head>
<body>

    <img src="https://upload.wikimedia.org/wikipedia/commons/3/33/F1.svg" class="f1-logo-top" alt="F1">

    <div class="login-card">
        <h2 class="login-title">LOGIN</h2>

        <form action="login_process.php" method="POST">
            <div class="mb-3">
                <label class="label-text">EMAIL:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="label-text">SENHA:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
        </form>
    </div>

    <button type="submit" onclick="document.querySelector('form').submit();" class="btn btn-entrar">ENTRAR</button>

</body>
</html>