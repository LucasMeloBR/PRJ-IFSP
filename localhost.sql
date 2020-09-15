-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 13-Set-2020 às 18:00
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id14132739_prjdb`
--
CREATE DATABASE IF NOT EXISTS `id14132739_prjdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id14132739_prjdb`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `action_plan`
--

CREATE TABLE `action_plan` (
  `id_ac` int(11) NOT NULL,
  `nome_ac` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `what` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `who` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `why` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `how` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `where_ac` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `benefits` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `how_much` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `start_up` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `final_date` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `focal_point` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `owner` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `manager` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url_attachments` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fk_id_indicador` int(11) NOT NULL,
  `fk_id_kpi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `action_plan`
--

INSERT INTO `action_plan` (`id_ac`, `nome_ac`, `status`, `what`, `who`, `why`, `how`, `where_ac`, `benefits`, `how_much`, `start_up`, `final_date`, `focal_point`, `owner`, `manager`, `url_attachments`, `fk_id_indicador`, `fk_id_kpi`) VALUES
(6, '% de incidentes ficou em 95,5 %', 'CONCLUÍDO', 'Desfalque de pessoas na Squad', 'Lucas Melo', 'Pessoas de férias ou desligadas', 'Efetuar contratação de novas pessoas', 'Squad Vingadores', 'Mais agilidade na entrega de correções', '5000', '01/09/2020', '30/09/2020', 'Lucas', 'André', 'Fábio', NULL, 1, 1),
(7, 'teste', 'EM ABERTO', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', '8500', '17/09/2020', '30/09/2020', 'teste', 'teste', 'teste', NULL, 7, 1),
(8, 'teste2', 'EM ABERTO', 'teste2', 'teste2', 'teste2', 'teste2', 'teste2', 'teste2', '800', '17/09/2020', '30/09/2020', 'teste2', 'teste2', 'teste2', NULL, 3, 2),
(9, 'teste3', 'EM ANDAMENTO', 'teste3', 'teste3', 'teste3', 'teste3', 'teste3', 'teste3', '5000', '12/09/2020', '23/09/2020', 'teste3', 'teste3', 'teste3', NULL, 3, 2),
(10, 'teste4', 'CONCLUÍDO', 'teste4', 'teste4', 'teste4', 'teste4', 'Squad Vingadores', 'teste4', '5', '24/09/2020', '30/09/2020', 'teste4', 'teste4', 'teste4', NULL, 4, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `kpi`
--

CREATE TABLE `kpi` (
  `id_kpi` int(11) NOT NULL,
  `nome_kpi` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `kpi`
--

INSERT INTO `kpi` (`id_kpi`, `nome_kpi`) VALUES
(1, 'Balanced Scorecard'),
(2, 'Auditoria & Riscos de TI'),
(3, 'ITIL Process');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_kpi`
--

CREATE TABLE `tipo_kpi` (
  `id_tipo_kpi` int(11) NOT NULL,
  `nome_tipo_kpi` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fk_tipo_kpi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tipo_kpi`
--

INSERT INTO `tipo_kpi` (`id_tipo_kpi`, `nome_tipo_kpi`, `fk_tipo_kpi`) VALUES
(1, 'Incidentes fora do SLA', 1),
(2, 'Indisponibilidade de Sistemas e Aplicações', 1),
(3, 'Auditoria Externa', 2),
(4, '% de Ordem de Mudança com Rollback', 3),
(5, 'PPQA', 2),
(6, 'Auditoria Interna', 2),
(7, 'Response Time SLA', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `salt`, `password`) VALUES
(1, 'Lucas Melo', 'info.lucasmelo@gmail.com', '3941ed357da44f9b', 'c7ff17724f1fe3ba545d9d257cbd16efa87b7135d6fe2ad0b422788d90fe1d3e');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `action_plan`
--
ALTER TABLE `action_plan`
  ADD PRIMARY KEY (`id_ac`),
  ADD KEY `fk_kpi` (`fk_id_kpi`),
  ADD KEY `fk_indicador` (`fk_id_indicador`);

--
-- Índices para tabela `kpi`
--
ALTER TABLE `kpi`
  ADD PRIMARY KEY (`id_kpi`);

--
-- Índices para tabela `tipo_kpi`
--
ALTER TABLE `tipo_kpi`
  ADD PRIMARY KEY (`id_tipo_kpi`),
  ADD KEY `FK` (`fk_tipo_kpi`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `action_plan`
--
ALTER TABLE `action_plan`
  MODIFY `id_ac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `kpi`
--
ALTER TABLE `kpi`
  MODIFY `id_kpi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipo_kpi`
--
ALTER TABLE `tipo_kpi`
  MODIFY `id_tipo_kpi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `action_plan`
--
ALTER TABLE `action_plan`
  ADD CONSTRAINT `fk_indicador` FOREIGN KEY (`fk_id_indicador`) REFERENCES `tipo_kpi` (`id_tipo_kpi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kpi` FOREIGN KEY (`fk_id_kpi`) REFERENCES `kpi` (`id_kpi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tipo_kpi`
--
ALTER TABLE `tipo_kpi`
  ADD CONSTRAINT `FK` FOREIGN KEY (`fk_tipo_kpi`) REFERENCES `kpi` (`id_kpi`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
