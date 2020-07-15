-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Jul-2020 às 18:24
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_controle_estoque`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.estoque`
--

CREATE TABLE `tb_admin.estoque` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `altura` int(11) NOT NULL,
  `largura` int(11) NOT NULL,
  `comprimento` int(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_admin.estoque`
--

INSERT INTO `tb_admin.estoque` (`id`, `nome`, `descricao`, `altura`, `largura`, `comprimento`, `peso`, `quantidade`) VALUES
(16, 'Óculos inteligente', 'Óculos inteligente Atualizado ', 15, 25, 25, 140, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.estoque_imagens`
--

CREATE TABLE `tb_admin.estoque_imagens` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_admin.estoque_imagens`
--

INSERT INTO `tb_admin.estoque_imagens` (`id`, `produto_id`, `imagem`) VALUES
(13, 16, '5f0ddbc7c6939.jpg'),
(24, 16, '5f0e1076a3a71.jpg'),
(31, 16, '5f0e2411a7a1b.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.fornecedor`
--

CREATE TABLE `tb_admin.fornecedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `produto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_admin.fornecedor`
--

INSERT INTO `tb_admin.fornecedor` (`id`, `nome`, `telefone`, `produto`) VALUES
(1, 'Óculos TEC', '7522225555', '16'),
(2, 'Oculos ZZZ', '23 44447777', '16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.online`
--

CREATE TABLE `tb_admin.online` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ultima_acao` datetime NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.usuarios`
--

CREATE TABLE `tb_admin.usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `user`, `password`, `img`, `nome`, `cargo`) VALUES
(1, 'admin', 'admin', '5efe25b33d50f.jpg', 'Cesar Henrique Ramos', 2),
(5, 'Cesar', 'cesar', '5ec82dae127c4.jpg', 'Cesar Henrique Ramos', 1),
(6, 'Dolores', 'dolores', '5ec82ecf5a633.jpg', 'Dolores', 1),
(7, 'Cesar234', '123', '5ec82f78d3f30.jpg', 'Cesar Henrique Ramos', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.visitas`
--

CREATE TABLE `tb_admin.visitas` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_admin.visitas`
--

INSERT INTO `tb_admin.visitas` (`id`, `ip`, `dia`) VALUES
(1, '::1', '2020-05-21'),
(2, '::1', '2020-05-20'),
(3, '::1', '2020-05-21'),
(4, '::1', '2020-05-25'),
(5, '::1', '2020-05-25'),
(6, '::1', '2020-05-26'),
(7, '::1', '2020-05-26'),
(8, '::1', '2020-05-27'),
(9, '::1', '2020-05-27'),
(10, '::1', '2020-05-27'),
(11, '::1', '2020-05-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.depoimentos`
--

CREATE TABLE `tb_site.depoimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `depoimento` text COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_site.depoimentos`
--

INSERT INTO `tb_site.depoimentos` (`id`, `nome`, `depoimento`, `order_id`) VALUES
(1, 'Cesar Henrique Ramos', 'Ótimo Serviço RamosTecnolog ', 1),
(2, 'Karla Schumohl', 'Tive Uma Ótima Experiencia, com o trabalhos deles.', 2),
(3, 'Cesar Henrique ', 'otimo', 14),
(14, 'João', 'teste', 3),
(15, 'Cesar Henrique ', 'teste', 15),
(16, 'Cesar Henrique ', 'teste', 16),
(17, 'Cesar Henrique Ramos', 'teste', 17),
(18, 'Karla', 'Meu Teste', 18);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.servico`
--

CREATE TABLE `tb_site.servico` (
  `id` int(11) NOT NULL,
  `servico` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_site.servico`
--

INSERT INTO `tb_site.servico` (`id`, `servico`, `descricao`, `order_id`) VALUES
(1, 'Pentester', 'Teste para verificar se á alguma vulnerabilidade no sistema,como teste de intrusão', 3),
(3, 'Saite Comercial', 'Saite completo atualisado', 1),
(4, 'Blog', 'Blog Pessoal', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.slides`
--

CREATE TABLE `tb_site.slides` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slide` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_site.slides`
--

INSERT INTO `tb_site.slides` (`id`, `nome`, `slide`, `order_id`) VALUES
(3, 'Slide 2#', '5ecebfb9e5312.png', 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_admin.estoque`
--
ALTER TABLE `tb_admin.estoque`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_admin.estoque_imagens`
--
ALTER TABLE `tb_admin.estoque_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_admin.fornecedor`
--
ALTER TABLE `tb_admin.fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.depoimentos`
--
ALTER TABLE `tb_site.depoimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.servico`
--
ALTER TABLE `tb_site.servico`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_admin.estoque`
--
ALTER TABLE `tb_admin.estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `tb_admin.estoque_imagens`
--
ALTER TABLE `tb_admin.estoque_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `tb_admin.fornecedor`
--
ALTER TABLE `tb_admin.fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_admin.visitas`
--
ALTER TABLE `tb_admin.visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tb_site.depoimentos`
--
ALTER TABLE `tb_site.depoimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `tb_site.servico`
--
ALTER TABLE `tb_site.servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_site.slides`
--
ALTER TABLE `tb_site.slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
