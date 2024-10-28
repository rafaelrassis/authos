<?php
session_start();

include('../controller/protector.php');
require_once '../model/conexao.php';  
require_once '../controller/AnaliseController.php';

// Instanciar a conexão e o controller
$conexao = new Conexao();
$controller = new AnaliseController($conexao);

$cpf = $_SESSION['pacienteCpf'];

// Chamar o método para obter os resultados dos jogos
$resultados = $controller->getTempoPorDia($cpf);
$datas = [];
$tempos = [];

if ($resultados) {
    foreach ($resultados as $resultado) {
        // Formatar a data
        $datas[] = date('d-m-Y', strtotime($resultado['dia']));
        // Convertendo horas para minutos
        $tempos[] = $resultado['tempo_total'] * 60; // Converte horas em minutos
    }
} else {
    $datas = ['Nenhum resultado'];
    $tempos = [0];
}

// Chamar o método para obter os resultados das tarefas
$resultadosTarefas = $controller->getQuantidadeTarefasPorDia($cpf);
$datasTarefas = [];
$quantidadesTarefas = [];

if ($resultadosTarefas) {
    foreach ($resultadosTarefas as $resultadoTarefa) {
        // Formatar a data corretamente
        $datasTarefas[] = date('d-m-Y', strtotime($resultadoTarefa['data_finalizacao']));
        // Captura a quantidade de tarefas finalizadas
        $quantidadesTarefas[] = $resultadoTarefa['total_tarefas_finalizadas'];
    }
} else {
    $datasTarefas = ['Nenhum resultado'];
    $quantidadesTarefas = [0];
}

// Chamar o método para obter as atividades
$atividades = $controller->getAtividadesPorCpf($cpf);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Atividades</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .grafico-container {
            display: flex;
            justify-content: space-around;
        }
        canvas {
            max-width: 400px; /* Ajusta o tamanho do gráfico */
        }
        .text-center {
            text-align: center; /* Centraliza o conteúdo */
        }
    </style>
</head>
<body>
    <section class="h-100 gradient-form">
        <?php include 'menu.php'; ?>

        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center">
                                <h4 class="mt-1 mb-4">Análise de Atividades</h4>
                                <br><br>
                            </div>

                            <div class="grafico-container">
                                <div>
                                    <h5 class="text-center">Jogos executados</h5>
                                    <canvas id="meuGrafico" width="600" height="500"></canvas>
                                    <script>
                                        const ctx = document.getElementById('meuGrafico').getContext('2d');
                                        const grafico = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: <?php echo json_encode($datas); ?>,
                                                datasets: [{
                                                    label: 'Tempo total jogado (minutos)', // Atualizado para minutos
                                                    data: <?php echo json_encode($tempos); ?>,
                                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                    borderColor: 'rgba(75, 192, 192, 1)',
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                scales: {
                                                    y: {
                                                        beginAtZero: true
                                                    }
                                                }
                                            }
                                        });
                                    </script>
                                </div>

                                <div>
                                    <h5 class="text-center">Tarefas</h5>
                                    <canvas id="graficoTarefas" width="600" height="500"></canvas>
                                    <script>
                                        const ctxTarefas = document.getElementById('graficoTarefas').getContext('2d');
                                        const graficoTarefas = new Chart(ctxTarefas, {
                                            type: 'bar',
                                            data: {
                                                labels: <?php echo json_encode($datasTarefas); ?>,
                                                datasets: [{
                                                    label: 'Quantidade de Tarefas finalizadas por dia', 
                                                    data: <?php echo json_encode($quantidadesTarefas); ?>,
                                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                    borderColor: 'rgba(75, 192, 192, 1)',
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                scales: {
                                                    y: {
                                                        beginAtZero: true
                                                    }
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5 class="text-center">Lista de Atividades</h5>
                                
                                <!-- Formulário de Filtro -->
                                <form method="GET" class="mb-3">
                                    <div class="form-group">
                                        <label for="statusFiltro">Filtrar por Status:</label>
                                        <select id="statusFiltro" name="status" class="form-control" onchange="this.form.submit()">
                                            <option value="">Todos</option>
                                            <option value="pendente" <?php echo (isset($_GET['status']) && $_GET['status'] == 'pendente') ? 'selected' : ''; ?>>Pendente</option>
                                            <option value="finalizado" <?php echo (isset($_GET['status']) && $_GET['status'] == 'finalizado') ? 'selected' : ''; ?>>Finalizado</option>
                                        </select>
                                    </div>
                                </form>

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Tipo</th>
                                            <th>Data Início</th>
                                            <th>Data Fim</th>
                                            <th>Tempo Estimado (m)</th>
                                            <th>Descrição</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Filtra as atividades com base no status selecionado
                                        $statusFiltro = isset($_GET['status']) ? $_GET['status'] : '';

                                        // Se houver um filtro, aplique-o
                                        if ($statusFiltro) {
                                            $atividades = array_filter($atividades, function($atividade) use ($statusFiltro) {
                                                return $atividade['status'] === $statusFiltro;
                                            });
                                        }

                                        if ($atividades): ?>
                                            <?php foreach ($atividades as $atividade): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($atividade['nome']); ?></td>
                                                    <td><?php echo htmlspecialchars($atividade['tipo']); ?></td>
                                                    <td class="text-center">
                                                        <?php 
                                                        echo ($atividade['data_hora_inicio'] === '0000-00-00 00:00:00') ? '-' : date('d-m-Y H:i:s', strtotime($atividade['data_hora_inicio'])); 
                                                        ?>
                                                    </td>
                                                    <td><?php echo date('d-m-Y H:i:s', strtotime($atividade['data_hora_fim'])); ?></td>
                                                    <td><?php echo htmlspecialchars($atividade['tempo_estimado']); ?></td>
                                                    <td>
                                                        <?php 
                                                        echo htmlspecialchars($atividade['descricao']) ?: '-'; 
                                                        ?>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($atividade['status']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center">Nenhuma atividade encontrada.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

