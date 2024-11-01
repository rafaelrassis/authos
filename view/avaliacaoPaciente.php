<?php
session_start();
include('../controller/protector.php');
require_once ('../controller/AvaliacaoPacienteController.php');

$cpf = $_SESSION['conectadopaciente'];
$avaliacaoController = new AvaliacaoController();

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_avaliacao'])) {
    $idAvaliacao = $_POST['id_avaliacao'];

    // Tenta finalizar a avaliação
    if ($avaliacaoController->finalizarAvaliacao($idAvaliacao)) {
        $_SESSION['statusCadastroAvaliacao'] = "Avaliação finalizada com sucesso!";
    } else {
        $_SESSION['statusCadastroAvaliacao'] = "Erro ao finalizar a avaliação.";
    }

    // Redireciona para a mesma página para evitar reenvio do formulário
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$avaliacoes = $avaliacaoController->listarAvaliacoesPendentes($cpf);
$jogosPendentes = $avaliacaoController->listarJogosPendentes($cpf);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações Pendentes</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* (Seu estilo permanece inalterado) */
    </style>
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #335b66;">
        <?php include 'menuPaciente.php'; ?>

        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-start h-100">
                <div class="col-xl-8">

                    <!-- Verifica se há mensagens de alerta e exibe -->
                    <?php if (!empty($_SESSION['statusCadastroAvaliacao'])): ?>
                        <div class='alert alert-warning text-center'><?php echo $_SESSION['statusCadastroAvaliacao']; ?></div>
                        <?php unset($_SESSION['statusCadastroAvaliacao']); ?>
                    <?php endif; ?>

                    <div class="card rounded-3 text-black">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center">
                                <img src="img/logo.png" style="width: 185px;" alt="logo">
                                <h4 class="mt-1 mb-4">Avaliações Pendentes</h4>
                            </div>
                            <h4 class="mt-4">Jogos Pendentes</h4>
                            <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($jogosPendentes)): ?>
            <?php foreach ($jogosPendentes as $jogo): ?>
                <tr>
                    <td><?php echo htmlspecialchars($jogo['id_avaliacao']); ?></td>
                    <td><?php echo htmlspecialchars($jogo['nome']); ?></td>
                    <td><?php echo htmlspecialchars($jogo['status']); ?></td>
                    <td>
                        <?php
                        // Definindo o link baseado no nome do jogo
                        $link = '#'; // Link padrão, caso não haja uma correspondência
                        if ($jogo['nome'] === 'Pescaria') {
                            $link = '../jogos/pescaria/pescaria.php';
                        } elseif ($jogo['nome'] === 'outro') {
                            $link = 'jogos/pescaria/teste.php';
                        }

                        // Armazenando o ID do jogo na sessão
                        $_SESSION['numeroJogo'] = $jogo['id_avaliacao'];
                        ?> 
                        <a href="<?php echo $link; ?>" class="btn btn-primary">Acessar Jogo</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4" class="text-center">Nenhum jogo pendente encontrado.</td></tr>
        <?php endif; ?>
    </tbody>
</table>



                            <!-- Tabela de Avaliações -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($avaliacoes)): ?>
                                        <?php foreach ($avaliacoes as $avaliacao): ?>
                                            <tr>
                                                <td><?php echo $avaliacao['nome']; ?></td>
                                                <td><?php echo $avaliacao['descricao']; ?></td>
                                                <td>
                                                    <form method="POST">
                                                        <input type="hidden" name="id_avaliacao" value="<?php echo $avaliacao['id_avaliacao']; ?>">
                                                        <button type="submit" class="btn btn-outline-dark btn-finalizar">Finalizar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="3" class="text-center">Nenhuma avaliação pendente encontrada.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
</body>
</html>
