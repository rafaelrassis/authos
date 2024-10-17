-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/10/2024 às 21:53
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
(176, '1', '2024-10-14 22:14:44', '1', NULL, '1'),
(177, 'qqq', '2024-10-14 22:15:27', 'qqq', NULL, '11/111112'),
(178, 'teste', '2024-10-14 22:16:18', 'aaa', NULL, '11/111112'),
(179, 'aaaa', '2024-10-14 22:19:17', 'aaaaaa', '111.111.111-12', '11/111112'),
(180, 'aaaa', '2024-10-14 22:24:23', 'aaaaa', '432.423.423-42', '11/111112'),
(181, 'gfgfgf', '2024-10-14 22:27:33', 'gfgfgfg', '111.111.111-12', '11/111112'),
(182, ' 111.111.111-12', '2024-10-16 11:32:53', ' 111.111.111-12', '111.111.111-12', '11/111112'),
(183, 's', '2024-10-16 11:35:29', 's', '111.111.111-12', '11/111112'),
(184, 'm', '2024-10-16 11:36:19', 'm', '111.111.111-12', '11/111112'),
(185, 'j', '2024-10-16 11:37:13', 'j', '111.111.111-12', '11/111112'),
(186, ',,,,', '2024-10-16 11:39:45', ',,,,', '111.111.111-12', '11/111112'),
(187, 'teste', '2024-10-16 11:40:38', 'Lorem ipsum dolor sit amet. Qui quia totam eos earum reprehenderit ut quidem galisum qui ipsam sint aut amet atque sed ipsa galisum. Qui autem quae est quibusdam veniam sed pariatur magnam aut labore molestiae. Qui modi laboriosam id impedit officiis in commodi dolores.\r\n\r\nQuo dolores quis qui temporibus sapiente a temporibus tempora. Et ipsum provident non fugiat quibusdam ut sequi harum et consequatur mollitia quo quia consequatur ea sint accusamus id accusantium labore? 33 aperiam itaque non laboriosam commodi a debitis nostrum At ratione cumque sit pariatur galisum. Et doloribus earum At provident quia id enim recusandae sit cupiditate libero rem consequuntur alias eum aspernatur laboriosam!\r\n\r\nEum quod earum non deserunt enim quo quaerat odio et consequuntur ipsa eos autem sint id cupiditate nesciunt. Est neque deserunt qui libero voluptas et laboriosam aliquam nam voluptas praesentium? In aliquam dolor 33 minima modi aut rerum dolor et maxime illo aut pariatur aliquid. Aut reicie', '111.111.111-12', '11/111112'),
(188, 'a', '2024-10-16 15:21:25', 'aa', '111.111.111-11', '1'),
(189, 's', '2024-10-16 15:21:51', 's', '111.111.111-11', '1'),
(190, 'a', '2024-10-16 15:39:50', 'a', '1', '1'),
(191, 'jjjjj', '2024-10-16 15:41:36', 'jj', '1', '1'),
(192, 'n', '2024-10-16 15:43:29', 'n', '1', '1'),
(193, 'nn', '2024-10-16 15:43:32', 'n', '1', '1'),
(194, 'j', '2024-10-16 15:43:43', 'j', '1', '1'),
(195, 'a', '2024-10-16 16:12:36', 'a', '1', '1'),
(196, 'aaaa', '2024-10-16 16:12:40', 'aaaaa', '1', '1'),
(197, 'h', '2024-10-16 16:18:10', 'h', '1', '1'),
(198, 'n', '2024-10-16 16:18:19', 'n', '1', '1'),
(199, 'hh', '2024-10-16 16:18:45', 'hh', '1', '1'),
(200, 's', '2024-10-16 17:25:37', 's', '1', '1'),
(201, 'sss', '2024-10-16 17:26:47', 'sss', '1', '1'),
(202, 'afasfasfasf', '2024-10-16 17:26:51', 'ddd', '1', '1'),
(203, 'fdsfsdfsd', '2024-10-16 17:26:56', 'fsdfsdfsdfsdfsdf', '1', '1'),
(204, 'dddd', '2024-10-16 17:32:33', 'ddd', '1', '1'),
(205, 'a', '2024-10-16 17:40:26', 'a', '1', '1'),
(206, 'h', '2024-10-16 17:41:15', 'h', '1', '1'),
(207, 's', '2024-10-16 18:28:38', 's', '111.111.111-11', '1'),
(208, '1', '2024-10-16 18:28:43', '1', '111.111.111-11', '1'),
(209, '2', '2024-10-16 18:28:46', '2', '111.111.111-11', '1'),
(210, 'rafa', '2024-10-16 18:29:09', 'rafa', '111.111.111-11', '1'),
(211, 'dd', '2024-10-16 18:29:36', 'dd', '111.111.111-11', '1'),
(212, 'b', '2024-10-16 18:29:44', 'b', '111.111.111-11', '1'),
(213, 'a', '2024-10-16 20:45:06', 'a', '123.415.678-99', '12/345678'),
(214, 'g', '2024-10-16 20:45:31', 'g', '123.415.678-99', '12/345678'),
(215, 'j', '2024-10-16 20:45:37', 'j', '123.415.678-99', '12/345678');

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
(1, 'ovonildo'),
(29, 'teste'),
(32, 'batat'),
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
('1', 'testesssratee', 'juliana@maria.com', 33, '1'),
('11/111112', 'teste', 'teste@maria.com', 1, '1'),
('12/345678', 'Samantaddddffff', 'samanta2@gmail.com', 29, 'a');

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
('1', 'rafaajjjaaaaa', '1', '0000-00-00', 'cindiane@linda.com', '', '1', ''),
('111.111.111-11', '1', '1', '0000-00-00', '1@hotmail.com', '../uploads/8768984.png', '1', ''),
('111.111.111-12', 'testeeeeee', 'qwert', '2000-10-07', 'teste1@maria.com', '../uploads/criança.jpg', '11/111112', '(11) 11111-1112'),
('112.121.212-12', '2121221', '1', '0000-00-00', 'rafaelrassis2@hotmail.com', '../uploads/8768984.png', '1', '(12) 12121-2121'),
('123.415.678-99', 'rafa', '1', '2024-10-01', 'rosa1@maria.com', '../uploads/8768984.png', '12/345678', '(11) 11111-1111'),
('432.423.423-42', '343434', 'a', '0000-00-00', 'rafaelrassis@hotmail.com', '../uploads/8768984.png', '1', '(43) 43434-3434'),
('453.454.632-22', '343434343', 'a', '2024-09-30', 'rafaelrass4s555@hotmail.com', '../uploads/8768984.png', '1', '(44) 44444-4444');

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
  MODIFY `id_relatorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT;

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
