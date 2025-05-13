<?php
require('./classes/DB.php');
require('./classes/login.php');

$validador = new Login();
$validador->verificar_logado();

$db = new DB();

// Recebe o ID pela query string
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: home.php');
    exit;
}

// Busca dados atuais do produto
$produto = $db->buscarPorId($id);
if (!$produto) {
    header('Location: home.php');
    exit;
}

$mensagem = '';
$alertClass = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = $_POST['nome']      ?? '';
    $preco     = $_POST['preco']     ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $categoria = $_POST['categoria'] ?? '';

    if ($nome && $preco && $descricao && $categoria) {
        $sucesso = $db->atualizar($id, $nome, $descricao, $preco, $categoria);
        if ($sucesso) {
            $mensagem  = "Produto atualizado com sucesso!";
            $alertClass = "alert-success";
            // Recarrega dados atualizados
            $produto = $db->buscarPorId($id);
        } else {
            $mensagem  = "Erro ao atualizar produto.";
            $alertClass = "alert-danger";
        }
    } else {
        $mensagem  = "Preencha todos os campos.";
        $alertClass = "alert-warning";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Produto Artesanal</title>
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
            max-width: 800px;
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

        .alert {
            border-radius: 12px;
            padding: 1.25rem;
            font-weight: 500;
            border: 2px solid transparent;
            position: relative;
            padding-left: 3rem;
        }

        .alert::before {
            content: 'ⓘ';
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2em;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.15);
            border-color: rgba(40, 167, 69, 0.2);
            color: #155724;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.15);
            border-color: rgba(220, 53, 69, 0.2);
            color: #721c24;
        }

        .alert-warning {
            background: rgba(255, 193, 7, 0.15);
            border-color: rgba(255, 193, 7, 0.2);
            color: #856404;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 4px 6px -1px rgba(102, 126, 234, 0.1);
            background: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
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

            h1.card-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Editar Produto Artesanal</h1>

                <?php if ($mensagem): ?>
                    <div class="alert <?= $alertClass ?>"><?= $mensagem ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">

                    <div class="mb-4">
                        <label for="nome" class="form-label">Nome do produto:</label>
                        <input
                            type="text"
                            name="nome"
                            id="nome"
                            class="form-control"
                            required
                            value="<?= htmlspecialchars($produto['nome_produto']) ?>">
                    </div>

                    <div class="mb-4">
                        <label for="preco" class="form-label">Preço:</label>
                        <input
                            type="number"
                            name="preco"
                            id="preco"
                            step="0.01"
                            class="form-control"
                            required
                            value="<?= htmlspecialchars($produto['preco']) ?>">
                    </div>

                    <div class="mb-4">
                        <label for="descricao" class="form-label">Descrição:</label>
                        <textarea
                            name="descricao"
                            id="descricao"
                            class="form-control"
                            rows="4"
                            required><?= htmlspecialchars($produto['descricao']) ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="categoria" class="form-label">Categoria:</label>
                        <input
                            type="text"
                            name="categoria"
                            id="categoria"
                            class="form-control"
                            required
                            value="<?= htmlspecialchars($produto['categoria']) ?>">
                    </div>

                    <button type="submit" class="btn btn-success">Atualizar</button>
                </form>

                <a href="home.php" class="btn btn-back">Voltar para home</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>