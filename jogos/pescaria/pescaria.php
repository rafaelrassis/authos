<?php
session_start(); // Inicia a sessão

date_default_timezone_set('America/Sao_Paulo');
$_SESSION['dataHoraEntrada'] = date('Y-m-d H:i:s');

// Exibe a data e hora de entrada
echo "Você entrou na página em: " . $_SESSION['dataHoraEntrada'];


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo do Lixo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
</head>
<body class="bg-info text-center text-light">
    <?php include '../../view/menuPaciente.php'; ?>
    
    <!-- Botão fechar alinhado à direita e com margem superior -->
    <div class="container d-flex justify-content-end mt-4">
        <button id="botaoFechar" class="btn btn-danger">Fechar</button>
    </div>
    
    <div class="container mt-5">
        <header>
            <h1 class="display-4">Escolha as Opções do Jogo</h1>
        </header>


        <div>
    <p><strong>Número do Jogo:</strong> <?php echo $_SESSION['numeroJogo']; ?></p>
    <p><strong>Data e Hora de Entrada:</strong> <?php echo $_SESSION['dataHoraEntrada']; ?></p>
    <p><strong>CPF do Paciente:</strong> <?php echo $_SESSION['conectadopaciente']; ?></p>
</div>

        <div id="telaInicial" class="mb-4">
            <label for="lixoEscolhidos" class="h5">Quantidade de Lixo a Coletar:</label>
            <input type="number" id="lixoEscolhidos" min="1" max="50" value="10" placeholder="10" class="form-control mb-3">
            <button id="botaoIniciar" class="btn btn-warning btn-lg">Iniciar Jogo</button>
        </div>

        <div id="areaDeJogo" style="display:none;">
            <button id="botaoDesistir" class="btn btn-danger" style="position:absolute; top: 10px; right: 10px;">Desistir</button>
        </div>

        <div id="resultado" style="display:none;">
            <h2 id="mensagemResultado" class="h4"></h2>
            <h3 id="quantidadeLixoColetado" class="h5"></h3>
            <button id="botaoReiniciar" type="button" class="btn btn-success btn-lg">Voltar ao Jogo</button>
            <button id="botaoTelaInicial" type="button" class="btn btn-secondary btn-lg">Retornar à Tela de Escolhas</button>
        </div>

        <div id="pontuacao" aria-live="polite" style="display:none;">Pontuação: 0</div>
        <div id="tempoRestante" aria-live="polite" style="display:none;">Tempo: 60</div>
    </div>

    <script src="script.js"></script>
    <script>
        // Evento para o botão fechar
        document.getElementById('botaoFechar').addEventListener('click', function() {
            // Redireciona para a página desejada após finalizar a avaliação
            window.location.href = '../../controller/jogosController.php'; // Altere para a URL desejada
        });
    </script>
</body>
</html>