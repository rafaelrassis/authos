<?php
session_start();
require_once '../model/paciente.php'; // Inclua o arquivo do modelo de Paciente

if (!isset($_SESSION['especialistaconectado'])) {
    // Redirecionar se o especialista não estiver logado
    header("Location: ../view/formlogin.php");
    exit();
}

$cip = $_SESSION['especialistaconectado'];

$pacienteModel = new Paciente();
var_dump($cip); // Adicione isto para verificar o valor de cip
$pacientes = $pacienteModel->buscarPacientesPorEspecialista($cip);

$_SESSION['statusBuscaCodPaciente'] = count($pacientes) > 0 ? "" : "Nenhum paciente encontrado.";

header("Location: ../view/telapacienteCod.php");
exit();
?>
