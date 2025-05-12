<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login - Lojinha</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 10%, transparent 20%);
            background-size: 30px 30px;
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

        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 440px;
            position: relative;
            transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .container:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.25);
        }

        h2.textlogin {
            margin-bottom: 2rem;
            color: #2d3748;
            font-size: 2rem;
            font-weight: 700;
            position: relative;
            text-align: center;
        }

        h2.textlogin::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        form label {
            display: block;
            text-align: left;
            margin-bottom: 0.5rem;
            color: #4a5568;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: #f8fafc;
            color: #1a202c;
        }

        form input[type="text"]:focus,
        form input[type="password"]:focus {
            border-color: #667eea;
            background-color: #fff;
            box-shadow: 0 4px 6px -1px rgba(102, 126, 234, 0.1), 0 2px 4px -1px rgba(102, 126, 234, 0.06);
            outline: none;
        }

        .input-group::before {
            content: '';
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background-size: contain;
            background-repeat: no-repeat;
        }

        #login {
            background-repeat: no-repeat;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%236B7280"><path d="M12 14v2a6 6 0 00-6 6H4a8 8 0 018-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"/></svg>');
        }

        #senha {
            background-repeat: no-repeat;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%236B7280"><path d="M19 10h1a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V11a1 1 0 011-1h1V9a7 7 0 1114 0v1zM5 12v8h14v-8H5zm6 2h2v4h-2v-4zm6-4V9A5 5 0 007 9v1h10z"/></svg>');
        }

        .botaoentrar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 16px;
            font-size: 1.1rem;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 1rem;
        }

        .botaoentrar:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(102, 126, 234, 0.3), 0 4px 6px -2px rgba(102, 126, 234, 0.15);
        }

        .botaoentrar:active {
            transform: translateY(0);
            box-shadow: none;
        }

        @media (max-width: 480px) {
            .container {
                padding: 1.5rem;
                width: 95%;
            }

            h2.textlogin {
                font-size: 1.75rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="textlogin">Acessar Sistema</h2>
        <?php echo $_GET['message'] ?? ''; ?>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="login">Usuário</label>
                <input type="text" id="login" name="username" placeholder="Insira seu login" required>
            </div>

            <div class="input-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="botaoentrar">Entrar</button>
        </form>
    </div>
</body>

</html>