<?php
include('../controller/protector.php');
require_once '../model/conexao.php';  
require_once '../controller/AnotacaoController.php';



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['statusAnotacao']) && $_SESSION['statusAnotacao'] !== "") {
    echo "<div class='alert alert-warning'>{$_SESSION['statusAnotacao']}</div>";
    unset($_SESSION['statusAnotacao']); 
}

$conexao = new Conexao(); 
$controller = new AnotacaoController($conexao); 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo'], $_POST['conteudo'])) {
    $controller->criarAnotacao($_POST['titulo'], $_POST['conteudo']);
    header('Location: anotacoes.php'); 
    exit; 
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
    padding-top: 60px; 
}

        .container {
    background-color: #DADADA;
    width: 80%;
    max-width: 1200px;
    padding: 20px;
    border-radius: 20px;
    margin-top: 10px; 
    position: relative; 
}

        h2, h3 {
            text-align: center; 
        }

        .form-control, .btn {
            border-radius: 10px; 
        }

        .table {
            background-color: white; 
        }

        .table th {
            background-color: #335b66; 
            color: white;
        }

        .alert {
            margin-bottom: 20px; 
        }

        .delete-note {
            background-color: red;
            color: white; 
        }
    </style>

<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include 'menu.php'; ?>
    <div class="container">
        <h2>Anotações</h2>

       
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
                        location.reload(); 
                    }
                });
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
