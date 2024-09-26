<?php
include('../controller/protector.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['statusCadastroPaciente'] = isset($_SESSION['statusCadastroPaciente']) ? $_SESSION['statusCadastroPaciente'] : "";


if (isset($_SESSION['statusCadastroPaciente']) && $_SESSION['statusCadastroPaciente'] !== "") {
    echo "<div class='alert alert-warning'>{$_SESSION['statusCadastroPaciente']}</div>";
    unset($_SESSION['statusCadastroPaciente']);
}
?>  

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro paciente</title>
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
            $('#cpf').mask('000.000.000-00');

            $('#dta').mask('00/00/0000');

            $('form').on('submit', function(event){
                var cpf = $('#cpf').val().replace(/\D/g, '');
                if (cpf.length !== 11) {
                    alert('CPF deve ter 11 dígitos.');
                    event.preventDefault(); 
                    return;
                }

                var dataNascimento = $('#dta').val();
                if (!/^\d{2}\/\d{2}\/\d{4}$/.test(dataNascimento)) {
                    alert('A data de nascimento deve estar no formato DD/MM/YYYY.');
                    event.preventDefault();
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
                                    <img src="img/cabeca.png" style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-5 pb-1">Authos</h4>
                                    <strong><?php echo isset($_SESSION['statusCadastroPaciente']) ? $_SESSION['statusCadastroPaciente'] : ""; ?></strong>
                                    <br><br>
                                </div>

                                <form action="../controller/criarpaciente.php" method="post" enctype="multipart/form-data">
                                    <div class="form-outline mb-4">
                                        <input type="text" id="cpf" name="cpf" class="form-control" placeholder="000.000.000-00" required />
                                        <label class="form-label" for="cpf">Digite o CPF</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome:"  required/>
                                        <label class="form-label" for="nome">Digite o nome completo</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="dta" name="dta" class="form-control" placeholder="DD/MM/AAAA" required/>
                                        <label class="form-label" for="dta">Digite a data de nascimento</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="email@gmail.com" required />
                                        <label class="form-label" for="email">Digite o email do responsável</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="senha" name="senha" class="form-control" placeholder="********" required />
                                        <label class="form-label" for="senha">Digite a senha</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="file" id="foto" name="foto" class="form-control"  required/>
                                        <label class="form-label" for="foto">Escolha uma foto</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <select id="cip_id" name="cip" class="form-control">
                                            <option value="" disabled selected>Selecione um especialista</option>
                                            <?php
                                            require_once '../model/conexao.php';
                                            require_once '../model/especialista.php';

                                            $especialista = new Especialista();
                                            $especialistas = $especialista->consultaEspecialistas();

                                            foreach ($especialistas as $esp) {
                                                echo "<option value='{$esp['cip']}'>{$esp['nome']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label class="form-label" for="cip_id">Escolha o especialista</label>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-outline-dark">Cadastrar</button>
                                        <a href="telapacienteCod.php" class="btn btn-outline-secondary">Voltar</a> <!-- Altere 'pagina_anterior.php' para a URL desejada -->
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
$_SESSION['statusCadastroPaciente'] = "";
?>
