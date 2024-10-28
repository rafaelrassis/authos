<?php
include('../controller/protector.php');
session_start();
require_once '../model/especialista.php';

$_SESSION['statusCadastroAvaliacao'] = $_SESSION['statusCadastroAvaliacao'] ?? "";

if (!empty($_SESSION['statusCadastroAvaliacao'])) {
    echo "<div class='alert alert-warning'>{$_SESSION['statusCadastroAvaliacao']}</div>";
    unset($_SESSION['statusCadastroAvaliacao']);
}

$especialista = new Especialista();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .gradient-custom-2 {
            background: linear-gradient(to right, #307c91, #335b66);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100%;
            }
        }

        .form-outline {
            margin-bottom: 1rem;
        }

        .btn-outline-dark, .btn-voltar {
            width: 100%;
            padding: 0.5rem;
            margin-top: 1rem;
        }

        .hidden {
            display: none;
        }

        .alert {
    margin: 0; /* Remover margens */
    padding: 10px; /* Ajustar o padding se necessário */
    z-index: 1000; 
    position: relative; 
}
        .card-body h4 {
            margin-top: 1rem; 
            margin-bottom: 2rem; 
        }
    </style>

    <script>
        function toggleFields() {
            const tipo = document.getElementById("tipo").value;
            const jogoFields = document.getElementById("jogoFields");
            const tarefaFields = document.getElementById("tarefaFields");
            const commonFields = document.getElementById("commonFields");
            const submitBtn = document.getElementById("submitBtn");

            if (tipo === "jogo") {
                jogoFields.classList.remove("hidden");
                tarefaFields.classList.add("hidden");
                commonFields.classList.remove("hidden");
                submitBtn.classList.remove("hidden");
            } else if (tipo === "tarefa") {
                tarefaFields.classList.remove("hidden");
                jogoFields.classList.add("hidden");
                commonFields.classList.remove("hidden");
                submitBtn.classList.remove("hidden");
            } else {
                jogoFields.classList.add("hidden");
                tarefaFields.classList.add("hidden");
                commonFields.classList.add("hidden");
                submitBtn.classList.add("hidden");
            }
        }
    </script>
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #335b66;">
        <?php include 'menu.php'; ?>

        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-start h-100"> <!-- Mudado para align-items-start -->
                <div class="col-xl-8"> 

                    <!-- Verifica se há mensagens de alerta e exibe -->
                    <?php if (!empty($_SESSION['statusCadastroAvaliacao'])): ?>
                        <div class='alert alert-warning text-center'><?php echo $_SESSION['statusCadastroAvaliacao']; ?></div>
                        <?php unset($_SESSION['statusCadastroAvaliacao']); ?>
                    <?php endif; ?>

                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center">
                                    <img src="img/logo.png" style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-4">Cadastro de Avaliação</h4>
                                </div>

                                <!-- Formulário -->
                                <form method="POST" action="../controller/AvaliacaoController.php">
                                    <!-- Seleção de Tipo -->
                                    <div class="form-outline">
                                        <label for="tipo">Tipo de Avaliação:</label>
                                        <select id="tipo" name="tipo" onchange="toggleFields()" class="form-control" required>
                                            <option value="">Selecione</option>
                                            <option value="jogo">Jogo</option>
                                            <option value="tarefa">Tarefa</option>
                                        </select>
                                    </div>

                                    <!-- Campos comuns para ambos os tipos -->
                                    <div id="commonFields" class="hidden">
                                        <div class="form-outline">
                                            <label for="nome">Nome:</label>
                                            <input type="text" id="nome" name="nome" class="form-control" required>
                                        </div>

                                        <div class="form-outline">
                                            <label for="tempo_estimado">Tempo Estimado (em minutos):</label>
                                            <input type="number" id="tempo_estimado" name="tempo_estimado" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Campos específicos para Jogo -->
                                    <div id="jogoFields" class="hidden">
                                        <p></p>
                                    </div>

                                    <!-- Campos específicos para Tarefa -->
                                    <div id="tarefaFields" class="hidden">
                                        <div class="form-outline">
                                            <label for="descricao">Descrição:</label>
                                            <textarea id="descricao" name="descricao" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Botão de Envio -->
                                    <button type="submit" id="submitBtn" class="btn btn-outline-dark hidden">Salvar Avaliação</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<?php
$_SESSION['statusCadastroAvaliacao'] = "";
?>
