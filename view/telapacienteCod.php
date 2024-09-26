<?php
include('../controller/protector.php');
require_once '../model/Paciente.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifique se há um especialista conectado
if (!isset($_SESSION['especialistaconectado'])) {
    header('Location: ../view/formlogin.php');
    exit();
}

// Cria uma nova instância do modelo Paciente
$pacienteModel = new Paciente();
$cipEspecialista = $_SESSION['especialistaconectado']; // Supondo que o CIP esteja armazenado na sessão

// Busca os pacientes associados ao especialista
$pacientes = $pacienteModel->buscarPacientesPorEspecialista($cipEspecialista);
$statusBuscaCodPaciente = isset($_SESSION['statusBuscaCodPaciente']) ? $_SESSION['statusBuscaCodPaciente'] : "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">
    <title>Pacientes do Especialista</title>
    <style>
        body {
            background-color: #335b66;
            font-family: 'Arial Narrow', sans-serif;
        }

        .container {
            margin-top: 50px;
            background-color: #C0C0C0;
            padding: 20px;
            border-radius: 10px;
        }

        h2 {
            color: #307c91;
        }

        .list-group-item {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .list-group-item:hover {
            background-color: #f1f1f1;
        }

        .btn {
            margin-top: 20px;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pacientes Associados</h2>
        <strong><?php echo $_SESSION['especialistaconectado']; // Supondo que o nome do especialista esteja armazenado na sessão ?></strong>
        <strong><?php echo $statusBuscaCodPaciente; ?></strong>

        <ul class="list-group mt-3">
            <?php if (count($pacientes) > 0): ?>
                <?php foreach ($pacientes as $paciente): ?>
                    <li class="list-group-item">
    CPF: <a href="../controller/set_session.php?cpf=<?php echo isset($paciente['cpf']) ? urlencode($paciente['cpf']) : ''; ?>&cod=<?php echo isset($paciente['codigo']) ? urlencode($paciente['codigo']) : ''; ?>"><?php echo isset($paciente['cpf']) ? $paciente['cpf'] : 'Desconhecido'; ?></a> - Nome: <?php echo isset($paciente['nome']) ? $paciente['nome'] : 'Desconhecido'; ?>
</li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">Nenhum paciente acessado pelo especialista.</li>
            <?php endif; ?>
        </ul>

        <a href="criarpaciente.php" class="btn btn-success">Cadastrar Novo Paciente</a>
        <a href="../view/formlogin.php" class="btn btn-primary">Voltar</a>
    </div>

    <?php
    // Limpa as variáveis da sessão após a exibição
    $_SESSION['statusBuscaCodPaciente'] = "";
    $_SESSION['pacientes'] = [];
    ?>
</body>
</html>
