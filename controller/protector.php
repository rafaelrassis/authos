<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['conectado'])) {
    header("Location: ../view/index.html");
}
?>