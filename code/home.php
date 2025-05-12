<?php
require('classes/login.php');
$validador = new Login();
$validador->verificar_logado();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lojinha - Cadastro de Produtos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 10%, transparent 20%);
            background-size: 30px 30px;
            background-repeat: no-repeat;
            transform: rotate(45deg);
            animation: backgroundAnim 120s linear infinite;
        }

        @keyframes backgroundAnim {
            0% {
                transform: rotate(45deg) translateY(0);
            }

            100% {
                transform: rotate(45deg) translateY(-1500px);
            }
        }

        header {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
        }

        header h1 {
            color: white;
            font-size: 2.2rem;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        main {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 2rem auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            transform: translateY(0);
            transition: transform 0.3s ease;
        }

        main:hover {
            transform: translateY(-2px);
        }

        h2 {
            color: #2d3748;
            font-size: 2rem;
            margin-bottom: 2.5rem;
            position: relative;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .btn-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        a.button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1.2rem 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px rgba(102, 126, 234, 0.1);
            border: none;
            cursor: pointer;
            min-height: 60px;
        }

        a.button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
        }

        a.button:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(102, 126, 234, 0.2);
        }

        footer {
            text-align: center;
            padding: 2rem;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            margin-top: 4rem;
            position: relative;
            backdrop-filter: blur(5px);
            background: rgba(255, 255, 255, 0.1);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 768px) {
            main {
                margin: 1rem;
                padding: 2rem 1rem;
            }

            header h1 {
                font-size: 1.8rem;
            }

            h2 {
                font-size: 1.6rem;
            }

            .btn-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Painel de Controle - Lojinha</h1>
    </header>

    <main>
        <h2>Bem-vindo(a), Lojista!</h2>

        <div class="btn-container">
            <a href="cadastro.php" class="button">Cadastrar Produto</a>
            <a href="listar.php" class="button">Visualizar Produtos</a>
            <a href="remover.php" class="button">Remover Produto</a>
            <a href="logout.php" class="button">Sair do Sistema</a>
        </div>
    </main>

    <footer>
        &copy; 2025 Lojinha Artesanal - Fatec Araras
    </footer>
</body>

</html>