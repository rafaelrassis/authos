<?php
session_start();
$_SESSION['statusLogin'] = isset($_SESSION['statusLogin']) ? $_SESSION['statusLogin'] : "";

if (isset($_SESSION['statusLogin']) && $_SESSION['statusLogin'] !== "") {
  echo "<div class='alert alert-warning'>{$_SESSION['statusLogin']}</div>";
  unset($_SESSION['statusLogin']); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entrar</title>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

  <style>
    .gradient-custom-2 {
      background:  #335b66;
      background: -webkit-linear-gradient(to right, #307c91, #335b66 );
      background: linear-gradient(to right,  #307c91, #335b66 );
    }
    @media (min-width: 768px) {
      .gradient-form {
        height: 100vh !important;
      }
    }
    @media (min-width: 769px) {
      .gradient-custom-2 {
        border-top-right-radius: .3rem;
        border-bottom-right-radius: .3rem;
      }
    }
  </style>

  <script>
    $(document).ready(function(){
        $('#cpf').mask('000.000.000-00');
        
        $('#cip').mask('00/000000');
    });
  </script>
</head>
<body>

<section class="h-100 gradient-form" style="background-color:  #335b66;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-center">
                  <img src="img/logo.png" style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Authos</h4>

                 
                </div>

                <form method="POST">
                  <label for="optionSelect">Você está logando como:</label>
                  <select id="optionSelect" name="optionSelect" onchange="this.form.submit()">
                    <option value="">Selecione</option>
                    <option value="1" <?php if(isset($_POST['optionSelect']) && $_POST['optionSelect'] == '1') echo 'selected'; ?>>Paciente</option>
                    <option value="2" <?php if(isset($_POST['optionSelect']) && $_POST['optionSelect'] == '2') echo 'selected'; ?>>Especialista</option>
                  </select>
                </form><br>

                <?php
                if(isset($_POST['optionSelect'])){
                    $selectedOption = $_POST['optionSelect'];

                    if($selectedOption == '1'){
                        echo '<form method="POST" action="../controller/consultaLoginPaciente.php">
                          <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="cpf" name="cpf" class="form-control" placeholder="000.000.000-00" required />
                            <label class="form-label" for="cpf">CPF</label>
                          </div>
                          <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" id="senha" name="senha" class="form-control" placeholder="********" required />
                            <label class="form-label" for="senha">Senha</label>
                          </div>
                          <div class="text-center pt-1 mb-5 pb-1">
                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Entrar</button>
                          </div>
                          <div class="d-flex align-items-center justify-content-center pb-4">
                            <p class="mb-0 me-2">Não tem uma conta?</p> 
                            <a href="../view/criarpaciente.php"><button type="button" class="btn btn-outline-dark">Criar</button></a>
                          </div>
                        </form>';
                    } elseif($selectedOption == '2'){
                        echo '<form method="POST" action="../controller/consultaLoginEspecialista.php">
                          <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="cip" name="cip" class="form-control" placeholder="00/000000" required />
                            <label class="form-label" for="cip">CIP</label>
                          </div>
                          <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" id="senha" name="senha" class="form-control" placeholder="********" required />
                            <label class="form-label" for="senha">Senha</label>
                          </div>
                          <div class="text-center pt-1 mb-5 pb-1">
                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Entrar</button>
                          </div>
                          <div class="d-flex align-items-center justify-content-center pb-4">
                            <p class="mb-0 me-2">Não tem uma conta?</p> 
                            <a href="../view/criarconta.php"><button type="button" class="btn btn-outline-dark">Criar</button></a>
                          </div>
                        </form>';
                    }
                }
                ?>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
              <h4 class="mb-4">Authos</h4>
                <p class="small mb-0">Construindo pontes para um futuro brilhante: Juntos, abraçamos o potencial único de cada criança.</p>
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
$_SESSION['statusLogin'] = "";
?>

