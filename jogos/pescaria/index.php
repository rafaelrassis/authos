<?php
session_start(); // Adicione esta linha
date_default_timezone_set('America/Sao_Paulo');

// Atualiza a data e hora de entrada na sessão sempre que a página for carregada
$_SESSION['dataHoraEntrada'] = date('Y-m-d H:i:s');




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
<body class=" text-center text-light">
    <div class="container mt-5">
        <header>
            <!-- <img src="img/titulo.png"></header> -->
            <h1>Recolha os Lixos</h1>
        </header> 

        <div id="telaInicial" style="background-color: #1f95b9;" class="mb-4">
            <br>
            <label for="lixoEscolhidos" class="h5">Quantidade de Lixo a Coletar:</label>
            <input type="number" id="lixoEscolhidos" min="1" max="50" value="10" placeholder="10" class="form-control mb-3">
            <button id="botaoIniciar" class="btn btn-warning btn-lg">Iniciar Jogo</button>
        </div>

        <div id="areaDeJogo" style="display:none;">
            
        </div>

        <button id="botaoDesistir" class="btn btn-danger" style="position: absolute; top: 10px; right: 10px;">
            Desistir
        </button>
        
        <!-- Botão Fechar -->
        <form method="POST" action="/authos/jogos/fechar_jogo.php" style="position: absolute; top: 10px; left: 10px;">
            <button type="submit" class="btn btn-secondary">
                Fechar Jogo
            </button>
        </form>

        <div id="resultado" style="display:none;">
            
            <h2 id="mensagemResultado" class="h4"></h2>
            <h3 id="quantidadeLixoColetado" class="h5"></h3>
            <button id="botaoVoltarJogo" type="button" class="btn btn-success btn-lg">Voltar ao Jogo</button>
            <button id="botaoTelaInicial" type="button" class="btn btn-secondary btn-lg">Retornar à Tela de Escolhas</button>
        </div>

        <div id="pontuacao" aria-live="polite" style="display:none;">Pontuação: 0</div>
        <div id="tempoRestante" aria-live="polite" style="display:none;">Tempo: 60</div>
    </div>
    <script src="script.js"></script>
</body>
</html>
