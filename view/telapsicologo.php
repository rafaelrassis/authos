<?php
session_start(); // Inicia a sessão
include('../controller/protector.php');

// Verifica se o CPF e o código do paciente estão na sessão
if (isset($_SESSION['pacienteCpf']) && isset($_SESSION['pacienteCod'])) {
    $cpfPaciente = $_SESSION['pacienteCpf']; // Obtém o CPF da sessão
    $codPaciente = $_SESSION['pacienteCod']; // Obtém o código da sessão
} else {
    // Caso os dados não estejam disponíveis, redireciona ou exibe uma mensagem de erro
    header('Location: formlogin.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <title>Área psicólogo</title>
    <style>
        body {
            background-color: #335b66;
            font-family: 'Arial Narrow', sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .quadrado {
            width: 80%;
            max-width: 1000px;
            height: 600px;
            background: linear-gradient(to right, #307c91, #335b66);
            display: flex;
            padding: 0;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
        }

        .cinza {  
            width: 50%;
            height: 100%;
            background-color: #C0C0C0;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .imageum {
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .imageum img {
            max-width: 100%;
            max-height: 100%;
        }

        .textoUm {        
            font-style: normal;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            font-size: 1.8rem;
            margin-top: 2px;
        }

        .link-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 20px;
            padding-left: 15px;
            width: 100%;
        }

        .link-container a {
            display: flex;
            align-items: center;
            margin: 10px 0;
            text-decoration: none;
            color: #000;
            font-family: 'Poppins', sans-serif;
            font-size: 1.2rem;
        }

        .link-container img {
            width: 60px;
            height: 40px;
            margin-right: 10px;
        }

        .btn-buscar {
            background-color: #307c91;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            margin-top: 20px;
            width: 100%;
            text-align: center;
        }

        button.btn-sair {
            display: flex;
            align-items: center;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            font-size: 1.2rem;
        }

        button.btn-sair img {
            margin-right: 10px;
        }

       
    </style>
</head>
<body>
   
<?php include 'menu.php'; ?>

    <div class="quadrado">
        <div class="cinza">
            <div class="textoUm">Área psicólogo</div>
            <label>CIP especialista conectado: <?php echo htmlspecialchars($_SESSION['especialistaconectado']); ?></label>
            <br>
            <label>CPF Paciente: <?php echo htmlspecialchars($_SESSION['pacienteCpf']); ?></label>

            <div class="link-container">
                <a href="arquivos.php">
                    <img src="img/arq.png" alt="Arquivos paciente"> Arquivos do paciente
                </a>
                <a href="avaliacao.php">
                    <img src="img/atv.png" alt="Atividades"> Atividades
                </a>
                <a href="anotacoes.php">
                    <img src="img/nota.png" alt="Anotações"> Anotações
                </a>
                <a href="analise.php">
                    <img src="img/anls.png" alt="Analise"> Analise
                </a>
            </div>
        </div>
        <div class="imageum">
            <img src="img/img02.png" alt="Imagem">
        </div>
    </div>
</body>
</html>
