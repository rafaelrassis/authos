<?php
include('../controller/protector.php');
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
        }

        .quadrado {
            width: 80%; 
            max-width: 1000px; 
            height: 600px;
            background: linear-gradient(to right,  #307c91, #335b66); 
            display: flex; 
            padding-left: 0px; 
            border-radius: 20px;
            position: relative;
        }

        .cinza {  
            width: 500px; 
            height: 600px; 
            background-color: #C0C0C0; 
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 20px;
        }

        .imageum {
            position: absolute;
            display: inline-block;
            transform: translate(45%, 1%);
        }

        .textoUm {        
            font-style: normal;
            font-weight: 700;
            font-variant: normal;
            font-stretch: normal;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            font-size: 1.8rem;
            white-space: nowrap;
            margin-top: 2px;
        }

        .link-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 20px;
            padding-left: 15px;
        }

        .link-container a {
            display: flex;
            align-items: center; 
            margin: 20px;
            text-decoration: none;
            color: #000;
            font-family: 'Poppins', sans-serif;
            font-size: 1.2rem;
        }   

        .link-container img {
            width: 100px; 
            height: 60px;
            margin-right: -10px;
        }

    </style>
</head>
<body>
    <div class="quadrado">
        <div class="cinza">
            <div class="textoUm">Área psicólogo</div>
            <div class="link-container">
                <a href="arquivos.php">
                    <img src="img/arq.png" alt="Arquivos paciente"> Arquivos do paciente
                </a>
                <a href="atividades.html">
                    <img src="img/atv.png" alt="Atividades"> Atividades
                </a>
                <a href="anotacoes.html">
                    <img src="img/nota.png" alt="Anotações"> Anotações
                </a>
                <a href="analise.html">
                    <img src="img/anls.png" alt="Analise"> Analise
                </a>
                <form action="../controller/logout.php" method="POST">
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        <img src="img/sair.png" alt="Sair"> Sair
                    </button>
                </form>
            </div>
        </div>
        <div class="imageum"><img src="img/img02.png" alt="imagem um" width="800"></div>
    </div>
</body>
</html>