const buttons = document.querySelectorAll('.button');
const startButton = document.getElementById('startButton');
let sequence = [];
let playerInput = [];
let level = 0;
let timer = 0; // Contador de segundos
let timerInterval; // Intervalo do timer
const storedDateKey = 'storedDate'; // Chave para armazenar a data
const storedTimeKey = 'storedTime'; // Chave para armazenar o tempo

// Sons para cada botão
const buttonSounds = [
    new Audio('sounds/button-red.m4a'),   // Som para o botão vermelho
    new Audio('sounds/button-green.m4a'), // Som para o botão verde
    new Audio('sounds/button-blue.m4a'),  // Som para o botão azul
    new Audio('sounds/button-yellow.m4a')  // Som para o botão amarelo
];

const initialInterval = 1000; // Intervalo inicial em milissegundos
let currentInterval = initialInterval; // Intervalo atual

// Verifica se é um novo dia e reinicia o tempo se necessário
function checkAndResetTime() {
    const now = new Date();
    const storedDate = localStorage.getItem(storedDateKey);
    
    if (!storedDate || new Date(storedDate).getDate() !== now.getDate()) {
        localStorage.setItem(storedDateKey, now.toISOString());
        localStorage.setItem(storedTimeKey, 0);
    } else {
        timer = parseInt(localStorage.getItem(storedTimeKey)) || 0;
    }
}

startButton.addEventListener('click', iniciarJogo);

function iniciarJogo() {
    sequence = [];
    playerInput = [];
    level = 0;
    clearInterval(timerInterval);
    currentInterval = initialInterval; // Reseta o intervalo para o valor inicial
    console.log("Iniciando jogo...");

    const startTime = new Date();
    console.log(`Jogo iniciado em: ${startTime.toISOString()}`);

    proximaSequencia();

    timerInterval = setInterval(() => {
        timer++;
        localStorage.setItem(storedTimeKey, timer);
        console.log(`Tempo total: ${timer} segundos`);
    }, 1000);
}

function proximaSequencia() {
    playerInput = [];
    level++;
    console.log(`Nível ${level}`);
    const indiceAleatorio = Math.floor(Math.random() * 4);
    sequence.push(indiceAleatorio);
    
    // Aumenta a velocidade a cada 5 níveis
    if (level % 5 === 0 && currentInterval > 500) { // Aumenta a dificuldade
        currentInterval -= 100; // Reduz o intervalo em 100ms
    }
    
    tocarSequencia();
}

function tocarSequencia() {
    let i = 0;
    const intervalo = setInterval(() => {
        if (i >= sequence.length) {
            clearInterval(intervalo);
            return;
        }
        const botao = buttons[sequence[i]];
        piscarBotao(botao);
        playSound(buttonSounds[sequence[i]]); // Toca som do botão correspondente
        i++;
    }, currentInterval); // Usa o intervalo atual
}

function playSound(sound) {
    const soundClone = sound.cloneNode(); // Clona o áudio
    soundClone.play(); // Toca o som clonado
}

function piscarBotao(botao) {
    botao.classList.add('blink');
    setTimeout(() => {
        botao.classList.remove('blink');
    }, 300);
}

buttons.forEach((botao, indice) => {
    botao.addEventListener('click', () => lidarComInputJogador(indice));
});

function lidarComInputJogador(indice) {
    playerInput.push(indice);
    piscarBotao(buttons[indice]);
    playSound(buttonSounds[indice]); // Toca som do botão correspondente
    checarInput(playerInput.length - 1);
}

function checarInput(nivelAtual) {
    if (playerInput[nivelAtual] !== sequence[nivelAtual]) {
        mostrarModal();
        return;
    }
    if (playerInput.length === sequence.length) {
        setTimeout(proximaSequencia, 1000);
    }
}

function mostrarModal() {
    clearInterval(timerInterval);
    console.log(`Você perdeu! Sua pontuação: ${level}`);
    console.log(`Tempo total: ${timer} segundos`);
    document.getElementById('score').innerText = level;
    document.getElementById('modal').style.display = 'flex';
}

document.getElementById('restartButton').addEventListener('click', () => {
    document.getElementById('modal').style.display = 'none';
    iniciarJogo();
});

checkAndResetTime();
    