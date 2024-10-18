<?php

session_start();
$_SESSION['statusCadastroEspecialista'] = isset($_SESSION['statusCadastroEspecialista']) ? $_SESSION['statusCadastroEspecialista'] : "";

if (isset($_SESSION['statusCadastroEspecialista']) && $_SESSION['statusCadastroEspecialista'] !== "") {
  echo "<div class='alert alert-warning'>{$_SESSION['statusCadastroEspecialista']}</div>";
  unset($_SESSION['statusCadastroEspecialista']);
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Especialista</title>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

  <style>
    .gradient-custom-2 {
      background: #335b66;
      background: -webkit-linear-gradient(to right, #307c91, #335b66);
      background: linear-gradient(to right, #307c91, #335b66);
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
  </style>

  <script>
    $(document).ready(function(){
      $('#cip').mask('00/000000'); 
      $('#cpf').mask('000.000.000-00'); 

      $('#formEspecialista').on('submit', function(e) {
        var cip = $('#cip').val().replace(/\D/g, ''); 
        if (cip.length !== 8) { 
          e.preventDefault(); 
          alert('O CIP deve conter 8 dígitos.');
        }
      });
    });
  </script>
</head>

<body>
  <section class="h-100 gradient-form" style="background-color: #335b66;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">
                  <div class="text-center">
                    <img src="img/logo.png" style="width: 185px;" alt="logo">
                    <h4 class="mt-1 mb-5 pb-1">Cadastro de Especialista</h4>
                    <strong><?php echo $_SESSION['statusCadastroEspecialista']; ?></strong>
                    <br><br>
                  </div>

                  <form action="../controller/criarespecialista.php" method="POST">

                    <div class="form-outline mb-4">
                      <input type="text" id="cip" name="cip" class="form-control" placeholder="00/000000" required/>
                      <label class="form-label" for="cip">Digite o CIP</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome:" required/>
                      <label class="form-label" for="nome">Digite o nome</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="email" id="email" name="email" class="form-control" placeholder="email@gmail.com" required/>
                      <label class="form-label" for="email">Digite o e-mail</label>
                    </div>

                    <div class="form-outline mb-4">
                      <select id="especialidade" name="id_especialidade" class="form-control" required>
                        <option value="" disabled selected>Selecione uma especialidade</option>

                        <?php
                        require_once '../model/conexao.php';
                        require_once '../model/especialista.php';

                        $especialista = new Especialista();
                        $especialidades = $especialista->consultaEspecialidade();

                        foreach ($especialidades as $esp) {
                          echo "<option value='{$esp['id_especialidade']}'>{$esp['nome_especialidade']}</option>";
                        }
                        ?>
                      </select>
                      <label class="form-label" for="especialidade">Escolha a especialidade</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="senha" name="senha" class="form-control" placeholder="********" required/>
                      <label class="form-label" for="senha">Digite a senha</label>
                    </div>

                    <div>
                      <button type="submit" class="btn btn-outline-dark">Criar</button>
                    </div>
                  </form>

                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                  <h4 class="mb-4">Authos</h4>
                  <p class="small mb-0">Construindo pontes para um futuro brilhante, juntos abraçamos o potencial único de cada criança.</p>
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
$_SESSION['statusCadastroEspecialista'] = "";
?>
