<?php
require_once '../model/classClinica.php';
require_once '../model/classConexao.php';
$consulta = new Clinica();

// Sanitizar e capturar dados do formulário
$cep = $consulta->real_escape_string($_POST['cep']);
$logradouro = $conn->real_escape_string($_POST['logradouro']);
$bairro = $conn->real_escape_string($_POST['bairro']);
$cidade = $conn->real_escape_string($_POST['cidade']);
$estado = $conn->real_escape_string($_POST['estado']);

// Inserir dados no banco de dados
$sql = "INSERT INTO clinica (cep, logradouro, bairro, cidade, estado)
        VALUES ('$cep', '$logradouro', '$bairro', '$cidade', '$estado')";

if ($consulta->query($sql) === TRUE) {
    echo "Endereço cadastrado com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $consulta->error;
}

// Fechar conexão
$consulta->close();
?>


<script>
        function buscarEndereco() {
            var cep = document.getElementById('cep').value;
            if (cep.length === 8) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'https://viacep.com.br/ws/' + cep + '/json/', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var endereco = JSON.parse(xhr.responseText);
                        if (!endereco.erro) {
                            document.getElementById('logradouro').value = endereco.logradouro;
                            document.getElementById('bairro').value = endereco.bairro;
                            document.getElementById('cidade').value = endereco.localidade;
                            document.getElementById('estado').value = endereco.uf;
                        } else {
                            alert('CEP não encontrado.');
                        }
                    }
                };
                xhr.send();
            } else {
                alert('CEP inválido.');
            }
        }