<?php
session_start();
include_once('../model/paciente.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codPaciente = addslashes($_POST['codigo']);

    if (!empty($codPaciente)) {
        $pacienteModel = new Paciente();
        $paciente = $pacienteModel->buscarPorCodigo($codPaciente);

        if ($paciente) {

            $_SESSION['pacienteCod'] =    $codPaciente; 
            header("Location: ../view/telapsicologo.php");
            exit();
        } else {
            $_SESSION['statusBuscaCodPaciente'] = "Paciente não encontrado.";
            header("Location: ../view/telapacienteCod.php");
            exit();
        }
    } else {

        header("Location: ../view/telapacienteCod.php");
        exit();
    }
}
?>
