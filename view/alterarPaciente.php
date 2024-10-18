<?php
include('../controller/protector.php');
require_once '../model/conexao.php';
require_once '../model/paciente.php';
require_once '../model/especialista.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['statusAlteracaoPaciente'] = $_SESSION['statusAlteracaoPaciente'] ?? "";

$cpfPaciente = $_SESSION['conectadopaciente'] ?? '';

if (!empty($_SESSION['statusAlteracaoPaciente'])) {
    echo "<div class='alert alert-warning'>{$_SESSION['statusAlteracaoPaciente']}</div>";
    unset($_SESSION['statusAlteracaoPaciente']);
}






$pacienteModel = new Paciente();
$pacienteInfo = $pacienteModel->obterInformacoesPaciente($cpfPaciente);


$especialistaModel = new Especialista();
$especialistaInfo = $especialistaModel->consultaEspecialistas();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar paciente</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <style>
      body {
    background-color: #335b66;
    font-family: 'Poppins', sans-serif;
    color: #333;
    padding-top: 60px; 
}

        .container {
    background-color: #DADADA;
    width: 80%;
    max-width: 1200px;
    padding: 20px;
    border-radius: 20px;
    margin-top: 10px; 
    position: relative; 
}

        h2, h3 {
            text-align: center; 
        }

        .form-control, .btn {
            border-radius: 10px; 
        }

        .table {
            background-color: white; 
        }

        .table th {
            background-color: #335b66; 
            color: white; 
        }

        .alert {
            margin-bottom: 20px; 
        }

        .delete-note {
            background-color: red; 
            color: white; 
        }

    </style>

    <script>
        $(document).ready(function(){
            $('#cpf').mask('000.000.000-00');
            $('#telefone').mask('(00) 00000-0000'); 
    </script>
</head>
<body>
<?php include 'menuPaciente.php'; ?>
<section class="h-100 gradient-form" style="background-color: #335b66;">
  
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0 form-container">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center">
                                    <img src="img/cabeca.png" style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-5 pb-1">Alterar paciente</h4>
                                </div>

                                <form action="../controller/alterarPaciente.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="cpf" value="<?php echo $pacienteInfo['cpf']; ?>">

                                    <div class="form-outline mb-4">
                                        <input type="text" id="cpf" name="cpf" class="form-control" placeholder="000.000.000-00" value="<?php echo $pacienteInfo['cpf']; ?>" required readonly />
                                        <label class="form-label" for="cpf">Digite o CPF</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome:" value="<?php echo $pacienteInfo['nome']; ?>"  />
                                        <label class="form-label" for="nome">Digite o nome completo</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="date" id="dta" name="data_nascimento" class="form-control" value="<?php echo $pacienteInfo['data_nascimento']; ?>"  />
                                        <label class="form-label" for="dta">Digite a data de nascimento</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="telefone" name="telefone" class="form-control" placeholder="(00) 00000-0000" value="<?php echo $pacienteInfo['telefone']; ?>"  />
                                        <label class="form-label" for="telefone">Digite o telefone</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="email@gmail.com" value="<?php echo $pacienteInfo['email']; ?>"  />
                                        <label class="form-label" for="email">Digite o email do responsável</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="senha" name="senha" class="form-control" placeholder="********"  />
                                        <label class="form-label" for="senha">Nova senha (opcional)</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="file" id="foto" name="foto" class="form-control" />
                                        <label class="form-label" for="foto">Escolha uma nova foto (opcional)</label>
                                    </div>

                                   
                  <div class="form-outline">
                    <select id="cip" name="cip" class="form-control" >
                      <option value="" disabled>Selecione uma especialidade</option>
                      <?php
                    $especialistaInfo = $especialistaModel->consultaEspecialistas();
                      foreach ($especialistaInfo as $esp) {
                        $selected = $esp['cip'] == $pacienteInfo['cip'] ? 'selected' : '';
                        echo "<option value='{$esp['cip']}' $selected>{$esp['nome']}</option>";
                      }
                      ?>
                    </select>
                    <label class="form-label" for="especialidade">Especialidade</label>
                  </div>

                                    <div>
                                        <button type="submit" class="btn btn-outline-dark">Alterar</button>
                                    </div>
                                </form>

                            </div>
                        </div>  
                        <div class="col-lg-6 d-none d-lg-block"> 
    <div class="text-center">
        <img id="preview-image" src="<?php echo htmlspecialchars($pacienteInfo['foto']); ?>" alt="Foto paciente" style="width: 600px; height: 400px;" />
        <br>
        <label class="form-label" for="email">Imagem atual</label>
    </div>
</div>

                        </div>
                    </div>
                </div>
            </div>
        
    </div>
</section>

</body>
</html>

<?php
$_SESSION['statusAlteracaoPaciente'] = "";
?>
