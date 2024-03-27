-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/03/2024 às 14:50
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
-- Banco de dados: `faculdade-rh-sys`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(60) NOT NULL,
  `SOBRENOME` varchar(60) NOT NULL,
  `DATADENASCIMENTO` date NOT NULL,
  `CARGO` varchar(255) NOT NULL,
  `SETORID` int(11) NOT NULL,
  `CPF` int(11) NOT NULL,
  `SALARIO` decimal(10,0) NOT NULL,
  `ISATIVO` tinyint(1) NOT NULL,
  `DATADECRIACAO` datetime NOT NULL,
  `DATADEALTERACAO` datetime DEFAULT NULL,
  `SEXO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(100) NOT NULL,
  `MARCA` varchar(100) NOT NULL,
  `ESTOQUE` int(11) NOT NULL,
  `ATIVO` tinyint(1) NOT NULL,
  `DATADECRIACAO` datetime NOT NULL,
  `DATADEALTERACAO` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `relogio-ponto`
--

CREATE TABLE `relogio-ponto` (
  `ID` int(11) NOT NULL,
  `HORARIO` time NOT NULL,
  `DATA` date NOT NULL,
  `FUNCIONARIOID` int(11) NOT NULL,
  `ISATIVO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(255) NOT NULL,
  `NOMEDEUSUARIO` varchar(255) NOT NULL,
  `SENHA` varchar(255) NOT NULL,
  `ISRH` tinyint(1) NOT NULL,
  `ISESTOQUE` tinyint(1) NOT NULL,
  `ISADMIN` tinyint(1) NOT NULL,
  `ISROOT` tinyint(1) NOT NULL,
  `ATIVO` tinyint(1) NOT NULL,
  `DATADECRIACAO` datetime NOT NULL,
  `DATADEALTERACAO` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `relogio-ponto`
--
ALTER TABLE `relogio-ponto`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `relogio-ponto`
--
ALTER TABLE `relogio-ponto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
