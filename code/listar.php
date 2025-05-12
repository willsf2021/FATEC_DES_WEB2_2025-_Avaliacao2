<?php
require('./classes/DB.php');
require('classes/login.php');

$validador = new Login();
$validador->verificar_logado();

$db = new DB();

$produtos = $db->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Produtos Artesanais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            height: 100vh;
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
            max-width: 1200px;
            margin: 2rem auto;
            position: relative;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            overflow: hidden;
            transform: translateY(0);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 2.5rem;
        }

        h1.card-title {
            color: #2d3748;
            font-size: 2.2rem;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
        }

        h1.card-title::after {
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

        .table {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            overflow: hidden;
            backdrop-filter: blur(10px);
            margin: 2rem 0;
            border-collapse: collapse;
        }

        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .table th {
            padding: 1.2rem;
            font-weight: 600;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            vertical-align: middle;
        }

        .table tr:hover {
            background: rgba(102, 126, 234, 0.03);
        }

        .alert-warning {
            background: rgba(255, 193, 7, 0.15);
            border: 2px solid rgba(255, 193, 7, 0.2);
            color: #856404;
            border-radius: 12px;
            padding: 1.25rem;
            position: relative;
            padding-left: 3rem;
        }

        .alert-warning::before {
            content: '⚠️';
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }

        .btn-back {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-block;
            width: 100%;
            text-align: center;
            margin-top: 1.5rem;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            h1.card-title {
                font-size: 1.8rem;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .table {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Produtos Artesanais</h1>

                <?php if (empty($produtos)) : ?>
                    <div class="alert alert-warning">Nenhum produto cadastrado</div>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                    <th>Categoria</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($produtos as $produto) : ?>
                                    <tr>
                                        <td><?= $produto['id'] ?></td>
                                        <td><?= htmlspecialchars($produto['nome_produto']) ?></td>
                                        <td><?= htmlspecialchars($produto['descricao']) ?></td>
                                        <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                                        <td><?= htmlspecialchars($produto['categoria']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

                <a href="home.php" class="btn-back">Voltar para Home</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>