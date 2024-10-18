<?php
include('../controller/protector.php');
session_start();
require_once '../model/especialista.php';
include('../controller/protector.php');

$cip = $_SESSION['especialistaconectado'];

$_SESSION['statusAlteracaoEspecialista'] = isset($_SESSION['statusAlteracaoEspecialista']) ? $_SESSION['statusAlteracaoEspecialista'] : "";

$especialista = new Especialista();
$dadosEspecialista = $especialista->consultaEspecialistaPorCIP($cip); 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alteração de Especialista</title>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

  <style>
 
    .gradient-custom-2 {
      background: linear-gradient(to right, #307c91, #335b66);
    }


    @media (min-width: 768px) {
      .gradient-form {
        height: 100%; 
      }
    }

   
    @media (min-width: 769px) {
      .gradient-custom-2 {
        border-top-right-radius: .3rem;
        border-bottom-right-radius: .3rem;
      }
    }

    .form-outline {
      margin-bottom: 1rem; 
    }

    .btn-outline-dark, .btn-voltar {
      width: 100%; 
      padding: 0.5rem; 
      margin-top: 1rem; 
    }

    .centralizado {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%; 
    }


    .alert {
      margin-bottom: 20px; 
      margin-top: 20px; 
      z-index: 1000; 
    }

    .text-center img {
      width: 185px; 
    }

    .card-body h4 {
      margin-top: 1rem; 
      margin-bottom: 2rem; 
    }
  </style>

  <script>
    $(document).ready(function(){
      $('#cip').mask('00/000000');
      $('#cpf').mask('000.000.000-00');
    });
  </script>
</head>

<body>
  <section class="h-100 gradient-form" style="background-color: #335b66;">
    <?php include 'menu.php'; ?>

    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-8"> <!-- Ajustado para diminuir a largura do card -->
          
          <!-- Verifica se há mensagens de alerta e exibe -->
          <?php if (isset($_SESSION['statusAlteracaoEspecialista']) && $_SESSION['statusAlteracaoEspecialista'] !== ""): ?>
            <div class='alert alert-warning text-center'><?php echo $_SESSION['statusAlteracaoEspecialista']; ?></div>
            <?php unset($_SESSION['statusAlteracaoEspecialista']); ?>
          <?php endif; ?>

          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-center">
                  <img src="img/logo.png" style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-4">Alteração de Especialista</h4> <!-- Ajustado para reduzir espaço abaixo do título -->
                </div>

                <!-- Formulário -->
                <form action="../controller/alterarespecialista.php" method="POST">
                  <div class="form-outline">
                    <input type="text" id="cip" name="cip" class="form-control" value="<?php echo htmlspecialchars($dadosEspecialista['cip']); ?>" readonly/>
                    <label class="form-label" for="cip">CIP</label>
                  </div>

                  <div class="form-outline">
                    <input type="text" id="nome" name="nome" class="form-control" value="<?php echo htmlspecialchars($dadosEspecialista['nome']); ?>" required/>
                    <label class="form-label" for="nome">Nome</label>
                  </div>

                  <div class="form-outline">
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($dadosEspecialista['email']); ?>" required/>
                    <label class="form-label" for="email">E-mail</label>
                  </div>

                  <div class="form-outline">
                    <select id="especialidade" name="id_especialidade" class="form-control" required>
                      <option value="" disabled>Selecione uma especialidade</option>
                      <?php
                      $especialidades = $especialista->consultaEspecialidade();
                      foreach ($especialidades as $esp) {
                        $selected = $esp['id_especialidade'] == $dadosEspecialista['id_especialidade'] ? 'selected' : '';
                        echo "<option value='{$esp['id_especialidade']}' $selected>{$esp['nome_especialidade']}</option>";
                      }
                      ?>
                    </select>
                    <label class="form-label" for="especialidade">Especialidade</label>
                  </div>

                  <div class="form-outline">
                    <input type="password" id="senha" name="senha" class="form-control" placeholder="********"/>
                    <label class="form-label" for="senha">Nova senha (opcional)</label>
                  </div>

                  <div>
                    <button type="submit" class="btn btn-outline-dark">Atualizar</button>
                  </div>
                </form>

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
$_SESSION['statusAlteracaoEspecialista'] = "";
?>
