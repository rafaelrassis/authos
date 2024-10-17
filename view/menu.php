<style>
    /* Estilo do botão de Alterar Conta no topo */
    .top-bar {
        position: absolute;
        top: 0;
        width: 100%;
        display: flex;
        justify-content: flex-end;
        padding: 10px 20px;
        background-color: #307c91;
        z-index: 10; /* Garante que o menu fique sobre o conteúdo */
    }

    .top-bar form {
        margin: 0;
    }

    .top-bar button {
        background-color: white;
        color: #307c91;
        border: 2px solid #307c91;
        padding: 8px 10px;
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        font-size: 10px;
        transition: background-color 0.3s, color 0.3s;
    }

    .top-bar button:hover {
        background-color: #307c91;
        color: white;
    }

    /* Estilo para o texto do paciente conectado */
    .patient-connected {
        color: white; /* Altere a cor do texto conforme necessário */
        font-family: 'Poppins', sans-serif;
        font-size: 12px; /* Ajuste o tamanho da fonte se necessário */
        margin-right: auto; /* Faz o texto se mover para a esquerda */
        padding-left: 20px; /* Adiciona um espaço à esquerda do texto */
    }
</style>

<body>
    <div class="top-bar">
    <?php
        // Verifica se a página atual NÃO é telapacienteCod.php ou alterarEspecialista.php
        if (basename($_SERVER['PHP_SELF']) != 'telapacienteCod.php' && basename($_SERVER['PHP_SELF']) != 'alterarEspecialista.php') {
        ?>
            <span class="patient-connected">Paciente Conectado: <?php echo $_SESSION['pacienteCpf'] ?></span>
        <?php
        }
        ?>


<form action="../view/telapsicologo.php" method="GET" class="top-bar-form">
            <button type="submit" class="btn-top">Menu</button>
        </form>

        <form action="../view/alterarEspecialista.php" method="GET" class="top-bar-form">
            <button type="submit" class="btn-top">Alterar Conta Especialista</button>
        </form>

        <form action="telapacienteCod.php" method="GET" class="top-bar-form">
            <button type="submit" class="btn-top">Buscar Novo Paciente</button>
        </form>

        <form action="../controller/logout.php" method="POST" class="top-bar-form">
            <button type="submit" class="btn-top btn-sair">Sair</button>
        </form>
    </div>
</body>
