<?php
require('./classes/DB.php');
require('classes/login.php');

$validador = new Login();
$validador->verificar_logado();

$db = new DB();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produto = $db->buscarPorId($id);

    if ($produto) {
        $sucesso = $db->deletar($id);
        if ($sucesso) {
            $mensagem = "Produto removido com sucesso!";
            $alertClass = "alert-success";
        } else {
            $mensagem = "Erro ao remover produto.";
            $alertClass = "alert-danger";
        }
    } else {
        $mensagem = "Produto não encontrado.";
        $alertClass = "alert-warning";
    }
}

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
            width: 100%;
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
            /* overflow: hidden; */
            backdrop-filter: blur(10px);
            margin: 2rem 0;
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

        .btn-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff4757 100%);
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
        }

        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #6c757d;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            margin: 2rem 0;
        }

        .btn-back {
            background: rgba(108, 117, 125, 0.9);
            border: none;
            backdrop-filter: blur(5px);
            color: white;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            width: 100%;
            padding: 1rem;
            border-radius: 12px;
        }

        .btn-back:hover {
            background: rgba(90, 98, 104, 0.9);
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .table {
                font-size: 0.9rem;
            }

            .btn-danger {
                padding: 0.5rem 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Produtos Artesanais</h1>

                <?php if (!empty($mensagem)) : ?>
                    <div class="alert <?= $alertClass ?>"><?= $mensagem ?></div>
                <?php endif; ?>

                <?php if (empty($produtos)) : ?>
                    <div class="empty-state">
                        <i class="bi bi-box-seam" style="font-size: 3rem; opacity: 0.5;"></i>
                        <h3>Nenhum produto cadastrado</h3>
                    </div>
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
                                    <th>Ações</th>
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
                                        <td>
                                            <a href="?id=<?= $produto['id'] ?>"
                                                class="btn btn-danger"
                                                onclick="return confirm('Tem certeza que deseja remover este produto?')">
                                                Excluir
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

                <a href="home.php" class="btn btn-back">Voltar para o início</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>