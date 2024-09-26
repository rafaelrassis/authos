-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/09/2024 às 14:28
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
-- Banco de dados: `authosbd`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anotacoes`
--

CREATE TABLE `anotacoes` (
  `id_relatorio` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `conteudo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `descricao` varchar(100) DEFAULT NULL,
  `cip` varchar(10) NOT NULL,
  `cpf` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'ovonildo');

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
('11/111111', 'Juliana', 'juliana@maria.com', 1, '1'),
('12/345678', 'Samanta', 'samanta2@gmail.com', 1, '123');

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
  `cip` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `paciente`
--

INSERT INTO `paciente` (`cpf`, `nome`, `senha`, `data_nascimento`, `email`, `foto`, `cip`) VALUES
('464.975.198-58', 'Cindiane', '2', '0000-00-00', 'cindiane@linda.com', '../uploads/erro.png', '12/345678');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anotacoes`
--
ALTER TABLE `anotacoes`
  ADD PRIMARY KEY (`id_relatorio`);

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
  ADD PRIMARY KEY (`cpf`),
  ADD KEY `fk_cip` (`cip`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anotacoes`
--
ALTER TABLE `anotacoes`
  MODIFY `id_relatorio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `especialidade`
--
ALTER TABLE `especialidade`
  MODIFY `id_especialidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

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
