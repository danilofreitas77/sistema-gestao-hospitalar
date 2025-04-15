-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/04/2025 às 14:34
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
-- Banco de dados: `hospital`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `exames`
--

CREATE TABLE `exames` (
  `id_exame` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `hemoglobina` float NOT NULL,
  `hematocrito` float NOT NULL,
  `leucocitos` float NOT NULL,
  `glicose` float NOT NULL,
  `colesterol` float NOT NULL,
  `data_exame` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `exames`
--

INSERT INTO `exames` (`id_exame`, `id_paciente`, `hemoglobina`, `hematocrito`, `leucocitos`, `glicose`, `colesterol`, `data_exame`) VALUES
(1, 1, 45, 78, 54, 100, 46, '2024-11-29 13:26:00'),
(8, 6, 16, 78, 16000, 145, 46, '2024-12-05 15:54:00'),
(9, 7, 2, 15, 7000, 80, 85, '2024-12-09 11:07:00'),
(10, 8, 10, 14, 7000, 100, 85, '2024-12-09 11:21:00'),
(11, 9, 2, 78, 12000, 75, 46, '2024-12-09 11:22:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nome`) VALUES
(1, 'Danilo Costa Freitas'),
(6, 'Brenno Lee'),
(7, 'Carlos Eduardo'),
(8, 'Emilly Yasmmin'),
(9, 'Maria Luiza');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `exames`
--
ALTER TABLE `exames`
  ADD PRIMARY KEY (`id_exame`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `exames`
--
ALTER TABLE `exames`
  MODIFY `id_exame` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `exames`
--
ALTER TABLE `exames`
  ADD CONSTRAINT `exames_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
