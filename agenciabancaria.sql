-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Nov-2023 às 15:17
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `agenciabancaria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastrocartao`
--

CREATE TABLE `cadastrocartao` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastroclientes`
--

CREATE TABLE `cadastroclientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(140) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `idGerente` varchar(140) NOT NULL,
  `email` varchar(140) NOT NULL,
  `cartao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cadastroclientes`
--

INSERT INTO `cadastroclientes` (`id`, `nome`, `cpf`, `telefone`, `idGerente`, `email`, `cartao`) VALUES
(18, 'a', '000.000.000-00', '(00) 0 0000-0000', 'Heitor Cella Oliveira', 'a@a', '0000 0000 0000 0000'),
(19, 'b', '000.000.000-00', '(00) 0 0000-0000', 'Felipe Roberto Rocha', 'b@b', '-');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logingerente`
--

CREATE TABLE `logingerente` (
  `id` int(11) NOT NULL,
  `email` varchar(140) NOT NULL,
  `senha` varchar(16) NOT NULL,
  `idGerente` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `logingerente`
--

INSERT INTO `logingerente` (`id`, `email`, `senha`, `idGerente`) VALUES
(1, 'heitor@gmail.com', '12345', 'Heitor Cella Oliveira'),
(2, 'fellas@gmail.com', '12345', 'Felipe Roberto Rocha');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cadastrocartao`
--
ALTER TABLE `cadastrocartao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cadastroclientes`
--
ALTER TABLE `cadastroclientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `logingerente`
--
ALTER TABLE `logingerente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastrocartao`
--
ALTER TABLE `cadastrocartao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cadastroclientes`
--
ALTER TABLE `cadastroclientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `logingerente`
--
ALTER TABLE `logingerente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
