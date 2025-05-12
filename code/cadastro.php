<?php
require('./classes/DB.php');
require('classes/login.php');

$validador = new Login();
$validador->verificar_logado();

$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $categoria = $_POST['categoria'] ?? '';

    if ($nome && $preco && $descricao && $categoria) {
        $sucesso = $db->cadastrar($nome, $preco, $descricao, $categoria);
        if ($sucesso) {
            $mensagem = "Produto cadastrado com sucesso!";
            $alertClass = "alert-success";
        } else {
            $mensagem = "Erro ao cadastrar produto.";
            $alertClass = "alert-danger";
        }
    } else {
        $mensagem = "Preencha todos os campos.";
        $alertClass = "alert-warning";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produto Artesanal</title>
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

        .form-control {
            border-radius: 5px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            padding: 12px;
            font-size: 1.1rem;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
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
                <h1 class="card-title text-center mb-4">Cadastro de Produto Artesanal</h1>

                <?php if (!empty($mensagem)) : ?>
                    <div class="alert <?= $alertClass ?>"><?= $mensagem ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do produto:</label>
                        <input type="text" name="nome" id="nome" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço:</label>
                        <input type="number" name="preco" id="preco" step="0.01" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição:</label>
                        <textarea name="descricao" id="descricao" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria:</label>
                        <input type="text" name="categoria" id="categoria" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Cadastrar</button>
                </form>

                <a href="home.php" class="btn btn-back w-100">Voltar para home</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>