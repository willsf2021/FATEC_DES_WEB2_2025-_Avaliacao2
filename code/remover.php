<?php
require('./classes/DB.php');
require('classes/login.php');

$validador = new Login();
$validador->verificar_logado();

$db = new DB();

// Verifica se o ID foi passado pela URL para remoção
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica se o produto existe no banco
    $produto = $db->buscarPorId($id);

    if ($produto) {
        // Realiza a remoção do produto
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

// Lista todos os produtos
$produtos = $db->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Produtos Artesanais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            background-color: #fff;
            padding: 2rem;
        }

        h1 {
            color: #343a40;
        }

        .alert {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        .btn-back {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 12px;
            font-size: 1.1rem;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #5a6268;
            border-color: #4e555b;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center mb-4">Produtos Artesanais</h1>

                <?php if (!empty($mensagem)) : ?>
                    <div class="alert <?= $alertClass ?>"><?= $mensagem ?></div>
                <?php endif; ?>

                <?php if (empty($produtos)) : ?>
                    <div class="alert alert-warning">Nenhum produto cadastrado.</div>
                <?php else : ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Categoria</th>
                                <th>Ação</th>
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
                                        <!-- Link para remover o produto -->
                                        <a href="?id=<?= $produto['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja remover este produto?')">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <a href="home.php" class="btn btn-back w-100">Voltar para o início</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>