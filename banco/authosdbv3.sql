-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/11/2024 às 10:30
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `authosdb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anotacoes`
--

CREATE TABLE `anotacoes` (
  `id_relatorio` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `conteudo` varchar(1000) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `cip` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `anotacoes`
--

INSERT INTO `anotacoes` (`id_relatorio`, `titulo`, `data_criacao`, `conteudo`, `cpf`, `cip`) VALUES
(222, 'bravo', '2024-10-17 22:37:20', 'jose é um cara muito bravo', '123.456.789-10', '12/345678'),
(223, 'teste', '2024-10-17 22:37:31', 'teste', '123.456.789-10', '12/345678'),
(224, 'teste do tonho', '2024-10-17 22:38:45', 'teste do tonho', '123.456.789-10', '11/111111'),
(225, '2510', '2024-10-25 18:17:14', '2510', '1', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `id_avaliacao` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `data_hora_inicio` datetime NOT NULL,
  `data_hora_fim` datetime NOT NULL,
  `tempo_estimado` varchar(100) NOT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `cip` varchar(10) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id_avaliacao`, `nome`, `tipo`, `data_hora_inicio`, `data_hora_fim`, `tempo_estimado`, `descricao`, `cip`, `cpf`, `data_cadastro`, `status`) VALUES
(59, 'Pescaria', 'jogo', '2024-10-30 21:17:18', '2024-10-30 21:17:18', '555', NULL, '1', '1', '2024-10-30 21:14:08', 'finalizado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `especialidade`
--

CREATE TABLE `especialidade` (
  `id_especialidade` int(11) NOT NULL,
  `nome_especialidade` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `especialidade`
--

INSERT INTO `especialidade` (`id_especialidade`, `nome_especialidade`) VALUES
(1, 'ovonildo'),
(29, 'teste'),
(32, 'tomate'),
(33, 'batata');

-- --------------------------------------------------------

--
-- Estrutura para tabela `especialista`
--

CREATE TABLE `especialista` (
  `cip` varchar(10) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `id_especialidade` int(11) NOT NULL,
  `senha` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `especialista`
--

INSERT INTO `especialista` (`cip`, `nome`, `email`, `id_especialidade`, `senha`) VALUES
('1', '1', '1@1', 1, '1'),
('11/111111', 'Tonho', 'toto@hotmail.com', 1, '1'),
('12/345678', 'Maria', 'maria@gmail.com', 33, '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `paciente`
--

CREATE TABLE `paciente` (
  `cpf` varchar(14) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(8) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `cip` varchar(10) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `paciente`
--

INSERT INTO `paciente` (`cpf`, `nome`, `senha`, `data_nascimento`, `email`, `foto`, `cip`, `telefone`) VALUES
('1', '1', '1', '2024-10-02', '1@dfsfdfd', '../uploads/8768984.png', '1', '(1'),
('123.456.789-10', 'José', '1', '2000-06-13', 'jose@teste.com', '../uploads/criança - Copia.jpg', '11/111111', '(11) 11111-1111'),
('131.212.312-31', '3213123', '1', '0000-00-00', 'rafael3rass4s555@hotmail.com', '../uploads/8768984.png', '1', '(32) 13123-2131');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anotacoes`
--
ALTER TABLE `anotacoes`
  ADD PRIMARY KEY (`id_relatorio`),
  ADD KEY `fk_anotacao_paciente` (`cpf`),
  ADD KEY `fk_anotacao_especialista` (`cip`);

--
-- Índices de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`id_avaliacao`),
  ADD KEY `fk_avaliacao_cip` (`cip`),
  ADD KEY `fk_avaliacao_cpf` (`cpf`);

--
-- Índices de tabela `especialidade`
--
ALTER TABLE `especialidade`
  ADD PRIMARY KEY (`id_especialidade`);

--
-- Índices de tabela `especialista`
--
ALTER TABLE `especialista`
  ADD PRIMARY KEY (`cip`),
  ADD KEY `fk_id_especialidade` (`id_especialidade`);

--
-- Índices de tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`cpf`) USING BTREE,
  ADD KEY `fk_cip` (`cip`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anotacoes`
--
ALTER TABLE `anotacoes`
  MODIFY `id_relatorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de tabela `especialidade`
--
ALTER TABLE `especialidade`
  MODIFY `id_especialidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `anotacoes`
--
ALTER TABLE `anotacoes`
  ADD CONSTRAINT `fk_anotacao_especialista` FOREIGN KEY (`cip`) REFERENCES `especialista` (`cip`),
  ADD CONSTRAINT `fk_anotacao_paciente` FOREIGN KEY (`cpf`) REFERENCES `paciente` (`cpf`);

--
-- Restrições para tabelas `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `fk_avaliacao_cip` FOREIGN KEY (`cip`) REFERENCES `especialista` (`cip`),
  ADD CONSTRAINT `fk_avaliacao_cpf` FOREIGN KEY (`cpf`) REFERENCES `paciente` (`cpf`);

--
-- Restrições para tabelas `especialista`
--
ALTER TABLE `especialista`
  ADD CONSTRAINT `fk_id_especialidade` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidade` (`id_especialidade`);

--
-- Restrições para tabelas `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_cip` FOREIGN KEY (`cip`) REFERENCES `especialista` (`cip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
