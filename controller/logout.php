<?php
session_start(); 

unset($_SESSION['usuario_id']);
session_unset();
session_destroy();


header('Location: ../view/index.html');
exit();
?>
