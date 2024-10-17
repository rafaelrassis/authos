<?php

include('../controller/protector.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../model/paciente.php');



// Verifica se o CPF e o código do paciente estão na sessão
if (isset($_SESSION['pacienteCpf'])) {
    $cpfPaciente = $_SESSION['pacienteCpf']; // Obtém o CPF da sessão
} else {
    // Caso os dados não estejam disponíveis, redireciona ou exibe uma mensagem de erro
    header('Location: formlogin.php');
    exit();
} 

if (!isset($_SESSION['pacienteCpf'])) {
    var_dump($_SESSION['pacienteCpf']);
    
}

$infPaciente = new Paciente();
$paciente = $infPaciente->obterInformacoesPaciente($_SESSION['pacienteCpf']);

if ($paciente === false) {
    echo "Erro ao obter informações do paciente.";
} else {
    // Aqui você pode processar as informações do paciente
 //   var_dump($paciente);
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
    <title>Arquivos Paciente</title>
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
            background: #C0C0C0; 
            display: flex; 
            border-radius: 20px;
            position: relative;
        }

        .cinza {  
            width: 600px; 
            height: 500px; 
            background-color: #E5E7E9; 
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            position: absolute; 
            left: 0; 
            padding: 20px;
            box-sizing: border-box;
        }

        .imageum {
            position: absolute;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            right: 0;
            width: 400px;
            height: 500px;
            padding: 20px;
            box-sizing: border-box;
        }

        .textoUm {        
            font-style: normal;
            font-weight: 400;
            font-variant: normal;
            font-stretch: normal;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            font-size: 1.8rem;
            white-space: nowrap;
            margin-bottom: 20px;
            margin-top: 8px;
            margin-left: -350px;
        }

        .upload-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .upload-container input[type="file"] {
            display: none; 
        }

        .upload-container label {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 250px; 
            height: 250px; 
            border-radius: 50%; 
            background-color: #e0e0e0; 
            overflow: hidden; 
            cursor: pointer; 
            border: 2px solid #C0C0C0;
        }

        .upload-container label img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover; 
        }

        .table {
            background-color: white; 
            width: 100%; 
            border-radius: 5px; 
            padding: 10px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table td label {
            border: none;
            border-bottom: 1px solid black;
            width: 100%;
            background-color: transparent;
            cursor: default;
        }
    </style>
</head>
<body>
<?php include 'menu.php'; ?>
    <div class="quadrado">
        <div class="cinza">
            <div class="textoUm">Informações:</div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Minhas informações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">CPF:</th>
                        <td><label><?php echo htmlspecialchars($paciente['cpf']); ?></label></td>
                    </tr>
                    <tr>
                        <th scope="row">Nome:</th>
                        <td><label><?php echo htmlspecialchars($paciente['nome']); ?></label></td>
                    </tr>
                     <tr>
                        <th scope="row">Data de nascimento:</th>
                        <td><label><?php echo htmlspecialchars($paciente['data_nascimento']); ?></label></td>
                    </tr>
                    <tr>
                        <th scope="row">E-mail:</th>
                        <td><label><?php echo htmlspecialchars($paciente['email']); ?></label></td>
                    </tr>
                    <tr>
                        <th scope="row">Telefone:</th>
                        <td><label><?php echo htmlspecialchars($paciente['telefone']); ?></label></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="imageum">
            <div class="upload-container">
                <label for="upload-image">
                    <img id="preview-image" src="<?php echo htmlspecialchars($paciente['foto']); ?>" alt="Foto paciente" />
                </label>
                
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview-image');
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>