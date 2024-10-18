<?php
session_start();
require_once '../model/paciente.php'; 

if (!isset($_SESSION['especialistaconectado'])) {
    header("Location: ../view/formlogin.php");
    exit();
}

$cip = $_SESSION['especialistaconectado'];

$pacienteModel = new Paciente();
var_dump($cip); 
$pacientes = $pacienteModel->buscarPacientesPorEspecialista($cip);

$_SESSION['statusBuscaCodPaciente'] = count($pacientes) > 0 ? "" : "Nenhum paciente encontrado.";

header("Location: ../view/telapacienteCod.php");
exit();
?>
