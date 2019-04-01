-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/08/2018 às 22:53
-- Versão do servidor: 10.1.34-MariaDB
-- Versão do PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `rest`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `not_permitted`
--

CREATE TABLE `not_permitted` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `not_permitted`
--

INSERT INTO `not_permitted` (`id`, `name`) VALUES
(2, 'luiscunha'),
(5, 'marlonvolz'),
(6, 'est.samara'),
(7, 'est.schult'),
(8, 'est.menon'),
(9, 'newton'),
(10, 'est.thaynara'),
(11, 'est.julie'),
(12, 'harlem'),
(13, 'hagai');

-- --------------------------------------------------------

--
-- Estrutura para tabela `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `alreadyPlayed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `players`
--

INSERT INTO `players` (`id`, `name`, `score`, `alreadyPlayed`) VALUES
(17, 'est.rodolfo', 20, 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `not_permitted`
--
ALTER TABLE `not_permitted`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `not_permitted`
--
ALTER TABLE `not_permitted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
