let pontuacao = 0;
let duracaoDoJogo = 60; // Tempo fixo de 60 segundos
let cronometro;
let contadorPeixes = 0;
let contadorLixo = 0;
let elementosNaTela = 0; // Para contar peixes e lixos simultaneamente
const areaDeJogo = document.getElementById('areaDeJogo');
let velocidadeLixo = 1.5; // Velocidade inicial dos lixos

// Variável para armazenar a quantidade de lixo escolhida
let quantidadeLixoEscolhidos;
let totalLixoColetado = 0; // Para rastrear o total de lixo coletado
let totalPeixesColetados = 0; // Para rastrear o total de peixes coletados
let inicioDoJogo; // Variável para armazenar o dia e hora de início
let cronometroTempoJogo; // Armazena o tempo desde o início do jogo
let tempoTotalJogo = parseInt(localStorage.getItem('tempoTotalJogo')) || 0; // Carrega o tempo do localStorage

// Resetar tempo total ao iniciar um novo dia
let inicioDoDia = new Date();
inicioDoDia.setHours(0, 0, 0, 0); // Define o início do dia atual
let agora = new Date();
let tempoDesdeInicio = Math.floor((agora - inicioDoDia) / 1000);

if (tempoDesdeInicio < 0) {
    tempoTotalJogo = 0; // Zera o contador se for antes da meia-noite
}

function atualizarDimensoes() {
    return {
        largura: areaDeJogo.offsetWidth,
        altura: areaDeJogo.offsetHeight
    };
}

document.getElementById('botaoIniciar').onclick = iniciarJogo;
document.getElementById('botaoDesistir').style.display = 'none'; // Ocultar o botão de desistência inicialmente

function iniciarJogo() {
    pontuacao = 0;
    contadorPeixes = 0;
    contadorLixo = 0;
    velocidadeLixo = 1.5; // Reiniciar a velocidade do lixo
    totalLixoColetado = 0; // Reiniciar total de lixo coletado
    totalPeixesColetados = 0; // Reiniciar total de peixes coletados
    duracaoDoJogo = 60; // Reiniciar o tempo do jogo

    // Registrar o dia e a hora do início do jogo
    inicioDoJogo = new Date();
    cronometroTempoJogo = setInterval(contarTempoDeJogo, 1000); // Inicia o cronômetro de tempo total
    console.log("Jogo iniciado em:", inicioDoJogo);

    // Armazenar a quantidade de lixo escolhida
    quantidadeLixoEscolhidos = parseInt(document.getElementById('lixoEscolhidos').value);

    document.getElementById('pontuacao').innerText = `Pontuação: ${pontuacao}`;
    document.getElementById('tempoRestante').innerText = `Tempo: ${duracaoDoJogo}`;

    document.getElementById('telaInicial').style.display = 'none';
    areaDeJogo.style.display = 'block';
    document.getElementById('pontuacao').style.display = 'block';
    document.getElementById('tempoRestante').style.display = 'block';
    document.getElementById('botaoDesistir').style.display = 'block';

    // Criar os elementos iniciais
    for (let i = 0; i < 2; i++) {
        criarLixo();
    }
    for (let i = 0; i < 3; i++) {
        criarPeixe();
    }

    cronometro = setInterval(atualizarJogo, 1000);
    setTimeout(encerrarJogo, duracaoDoJogo * 1000);
}

// Função para contar o tempo total na área de jogo
function contarTempoDeJogo() {
    tempoTotalJogo++;
    localStorage.setItem('tempoTotalJogo', tempoTotalJogo); // Salva o tempo no localStorage
    console.log(`Tempo total no jogo: ${tempoTotalJogo} segundos`);
}

function atualizarJogo() {
    duracaoDoJogo--;
    document.getElementById('tempoRestante').innerText = `Tempo: ${duracaoDoJogo}`;

    // Aumentar a velocidade do lixo a cada 10 segundos
    if (duracaoDoJogo % 10 === 0 && duracaoDoJogo > 0) {
        velocidadeLixo += 0.2; // Aumenta a velocidade
    }

    // Garantir que haja sempre 2 lixos e 3 peixes
    if (contadorLixo < 2) {
        criarLixo();
    }
    if (contadorPeixes < 3) {
        criarPeixe();
    }
}

function criarPeixe() {
    if (contadorPeixes < 5 && elementosNaTela < 8) {
        const peixe = document.createElement('div');
        peixe.className = 'peixe';
        const { largura, altura } = atualizarDimensoes();
        let lado = Math.random() < 0.5 ? 'direita' : 'esquerda';

        if (lado === 'direita') {
            peixe.style.backgroundImage = "url('img/peixeD.png')";
            peixe.style.left = largura + 'px';
        } else {
            peixe.style.backgroundImage = "url('img/peixeE.png')";
            peixe.style.left = '-100px';
        }

        peixe.style.position = 'absolute';
        peixe.style.top = Math.random() * (altura - 100) + 'px';
        let velocidade = Math.random() * 2 + 1;

        function moverPeixe() {
            let posicaoAtual = parseFloat(peixe.style.left);
            
            if (lado === 'direita') {
                if (posicaoAtual < -100) {
                    peixe.remove();
                    contadorPeixes--;
                    elementosNaTela--;
                    return;
                }
                peixe.style.left = (posicaoAtual - velocidade) + 'px';
            } else {
                if (posicaoAtual > largura) {
                    peixe.remove();
                    contadorPeixes--;
                    elementosNaTela--;
                    return;
                }
                peixe.style.left = (posicaoAtual + velocidade) + 'px';
            }
            
            requestAnimationFrame(moverPeixe);
        }

        peixe.onclick = function() {
            pontuacao -= 3;
            totalPeixesColetados++; // Incrementar total de peixes coletados
            document.getElementById('pontuacao').innerText = `Pontuação: ${pontuacao}`;
            peixe.remove();
            contadorPeixes--;
            elementosNaTela--;
            setTimeout(() => {
                criarPeixe(); // Cria um novo peixe após um delay
            }, 1000);
        };

        areaDeJogo.appendChild(peixe);
        contadorPeixes++;
        elementosNaTela++;
        moverPeixe();
    }
}

function criarLixo() {
    if (contadorLixo < 4 && elementosNaTela < 8) {
        const lixoTipos = ['img/lixo1.png', 'img/lixo2.png', 'img/lixo3.png'];
        const lixo = document.createElement('div');
        lixo.className = 'lixo';

        const { largura, altura } = atualizarDimensoes();
        
        lixo.style.backgroundImage = `url('${lixoTipos[Math.floor(Math.random() * lixoTipos.length)]}')`;
        lixo.style.backgroundSize = 'contain';
        lixo.style.backgroundRepeat = 'no-repeat';
        lixo.style.width = '90px';
        lixo.style.height = '90px';
        lixo.style.position = 'absolute';
        lixo.style.top = '0px';

        let espacamentoHorizontal = largura - 90;
        lixo.style.left = Math.random() * espacamentoHorizontal + 'px';

        function cairLixo() {
            let posicaoAtual = parseFloat(lixo.style.top);
            if (posicaoAtual > altura - 90) {
                lixo.remove();
                contadorLixo--;
                elementosNaTela--;
                return;
            }
            lixo.style.top = (posicaoAtual + velocidadeLixo) + 'px';
            requestAnimationFrame(cairLixo);
        }

        lixo.onclick = function() {
            pontuacao += 2;
            totalLixoColetado++; // Incrementar total de lixo coletado
            document.getElementById('pontuacao').innerText = `Pontuação: ${pontuacao}`;
            lixo.remove();
            contadorLixo--;
            elementosNaTela--;
            setTimeout(() => {
                criarLixo(); // Cria um novo lixo após um delay
            }, 1000);
        };

        areaDeJogo.appendChild(lixo);
        contadorLixo++;
        elementosNaTela++;
        cairLixo();
    }
}

function encerrarJogo() {
    clearInterval(cronometro);
    clearInterval(cronometroTempoJogo); // Para o cronômetro ao encerrar o jogo
    
    // Definir a mensagem com base na quantidade de lixo coletado e se pegou muitos peixes
    let mensagem;
    let mensagemExtra = '';

    if (totalLixoColetado === 0) {
        mensagem = "Ooooi, você está aí?";
    } else if (totalLixoColetado >= quantidadeLixoEscolhidos) {
        mensagem = Math.random() < 0.5 ? "Você conseguiu!!" : "Muito bem!!";
    } else {
        mensagem = Math.random() < 0.5 ? "Tente novamente!" : "Quase lá!";
    }

    if (totalPeixesColetados >= totalLixoColetado && totalLixoColetado > 0) {
        mensagemExtra = " Pegou muitos peixes no processo, evite-os da próxima vez.";
    }

    document.getElementById('mensagemResultado').innerText = mensagem + mensagemExtra;
    document.getElementById('quantidadeLixoColetado').innerText = `Lixo Coletado: ${totalLixoColetado}`;
    document.getElementById('resultado').style.display = 'block';
    areaDeJogo.style.display = 'none';
    document.getElementById('pontuacao').style.display = 'none';
    document.getElementById('tempoRestante').style.display = 'none';
    document.getElementById('botaoDesistir').style.display = 'none';
}

document.getElementById('botaoTelaInicial').onclick = function() {
    // Limpar a área de jogo e voltar à tela inicial
    areaDeJogo.innerHTML = '';
    elementosNaTela = 0; // Reiniciar contagem de elementos na tela
    document.getElementById('resultado').style.display = 'none';
    document.getElementById('telaInicial').style.display = 'block';
};

document.getElementById('botaoVoltarJogo').onclick = function() {
    // Limpar a área de jogo e reiniciar
    areaDeJogo.innerHTML = '';
    elementosNaTela = 0; // Reiniciar contagem de elementos na tela
    document.getElementById('resultado').style.display = 'none';
    iniciarJogo(); // Reinicia o jogo com as mesmas configurações
};

// Botão para sair do jogo e parar o cronômetro
document.getElementById('botaoDesistir').onclick = function() {
    clearInterval(cronometro);
    clearInterval(cronometroTempoJogo); // Para o cronômetro ao sair do jogo
    console.log(`Tempo total de jogo até sair: ${tempoTotalJogo} segundos`);

    areaDeJogo.style.display = 'none';
    document.getElementById('resultado').style.display = 'block';
    document.getElementById('botaoDesistir').style.display = 'none'; // Esconder botão de desistência na tela final

    document.getElementById('pontuacao').style.display = 'none';
    document.getElementById('tempoRestante').style.display = 'none';
    
    // Exibe a tela final
    document.getElementById('resultado').style.display = 'block';
    document.getElementById('mensagemResultado').innerText = "Poxa!! Não desista da próxima vez.";
};
