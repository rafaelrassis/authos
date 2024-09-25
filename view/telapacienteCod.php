<?php
include('../controller/protector.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['statusBuscaCodPaciente'] = isset($_SESSION['statusBuscaCodPaciente']) ? $_SESSION['statusBuscaCodPaciente'] : "";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <title>Procurar paciente</title>
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
            height: 500px;
            background: linear-gradient( to right, #307c91, #335b66 ); 
            display: flex; 
            padding-left: 0px; 
            border-radius: 20px;
            position: relative;
        }

        .cinza {  
            width: 500px; 
            height: 500px; 
            background-color: #C0C0C0; 
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .imageum {
            position: absolute;
            display: inline-block;
            transform: translate(45%, 2%);
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
            margin-top: 30px;
        }

        .textoDois {
            margin-top: 17px;
            font-size: 1.1rem;
        }

        .form {
            margin-top: 40px;
            display: flex;
            align-items: center;
        }
         
        .cod { 
            color: black;
        }

        .botao {
            border: #335b66;
            border-radius: 20px;
            color: white;
            background-color: #335b66;
            font-size: 13px;
            padding: 6px 30px;
            margin-left: 10px; 
        }
    
        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh;
            }
        }
      
        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
   
        .form input {
            font-size: 1rem;
            border-radius: 5px;
            padding: 0.5rem;
        }
    </style>

    <script>
        $(document).ready(function() {

            $('#procurap').mask('000.000.000-00');
        });
    </script>
</head>
<body>
    <div class="quadrado">
        <div class="cinza">
            <div class="textoUm">Área atividade paciente</div>
            <br><br>

            <strong><?php echo $_SESSION['statusBuscaCodPaciente']; ?></strong>

            <div class="textoDois">Procure um paciente</div>
            <form action="../controller/buscapaciente.php" method="POST">
                <div class="form">
                    <input type="text" name="codigo" id="codigo" class="form" placeholder="CPF:" required/>
                    <button type="submit" class="botao">Procurar</button>
                </div>
                <div><br>
                    <a href="criarpaciente.php"><label class="cod" for="procurap">Cadastrar novo paciente</label></a>
                </div>
            </form>
        </div>
        <div class="imageum"><img src="img/img02.png" alt="imagem um" width="800"></div>
    </div>
</body>
</html>
<?php
$_SESSION['statusBuscaCodPaciente'] = "";
?>
