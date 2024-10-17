<?php
require_once '../model/conexao.php';  
require_once '../controller/AnotacaoController.php';

include('../controller/protector.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se há uma mensagem de status
if (isset($_SESSION['statusAnotacao']) && $_SESSION['statusAnotacao'] !== "") {
    echo "<div class='alert alert-warning'>{$_SESSION['statusAnotacao']}</div>";
    unset($_SESSION['statusAnotacao']); // Limpa a mensagem após exibição
}

$conexao = new Conexao(); // Cria a conexão aqui
$controller = new AnotacaoController($conexao); // Passa a conexão ao controller

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo'], $_POST['conteudo'])) {
    $controller->criarAnotacao($_POST['titulo'], $_POST['conteudo']);
    header('Location: anotacoes.php'); // Redireciona para evitar reenvios de formulário
    exit; // Encerra a execução do script
}

$anotacoes = $controller->listarAnotacoes();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciar Anotações</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
       body {
    background-color: #335b66;
    font-family: 'Poppins', sans-serif;
    color: #333;
    padding-top: 60px; /* Adiciona espaço suficiente para o menu */
}

        .container {
    background-color: #DADADA;
    width: 80%;
    max-width: 1200px;
    padding: 20px;
    border-radius: 20px;
    margin-top: 10px; /* Aumente a margem superior para evitar que o menu cubra */
    position: relative; /* Define a posição como relativa */
}

        h2, h3 {
            text-align: center; /* Centraliza os títulos */
        }

        .form-control, .btn {
            border-radius: 10px; /* Bordas arredondadas para inputs e botões */
        }

        .table {
            background-color: white; /* Fundo da tabela */
        }

        .table th {
            background-color: #335b66; /* Cor do cabeçalho da tabela */
            color: white; /* Cor do texto do cabeçalho */
        }

        .alert {
            margin-bottom: 20px; /* Espaçamento inferior para alertas */
        }

        .delete-note {
            background-color: red; /* Cor do botão de excluir */
            color: white; /* Cor do texto */
        }
    </style>

<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include 'menu.php'; ?>
    <div class="container">
        <h2>Anotações</h2>

        <!-- Formulário para adicionar nova anotação -->
        <form method="POST">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Criar uma nota..." required>
            </div>
            <div class="form-group">
                <label for="conteudo">Conteúdo:</label>
                <textarea name="conteudo" id="conteudo" class="form-control" placeholder="Escreva aqui..." rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Salvar Nota</button>
        </form>

        <!-- Tabela de anotações -->
        <h3 class="mt-4">Anotações Cadastradas</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                
                    <th>Título</th>
                    <th>Conteúdo</th>
                    <th>Data e hora</th>
                    <th>Especialista</th>
             
                </tr>
            </thead>
            <tbody>
                <?php foreach ($anotacoes as $anotacao): ?>
                    <tr>
                   
                        <td><?= htmlspecialchars($anotacao['titulo'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($anotacao['conteudo'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                        <?php $dataHora = new DateTime($anotacao['data_criacao']);
                        echo $dataHora->format('d/m/Y H:i'); ?>
                        </td>
                        <td><?= htmlspecialchars($anotacao['nome_especialista'], ENT_QUOTES, 'UTF-8') ?></td>
                      
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function deleteNote(id) {
            if (confirm('Tem certeza que deseja excluir esta anotação?')) {
                $.ajax({
                    url: '../controller/AnotacaoController.php',
                    type: 'POST',
                    data: { 'action': 'delete', 'id': id },
                    success: function(response) {
                        location.reload();  // Recarregar a página para atualizar a tabela
                    }
                });
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
