-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 04-Ago-2022 às 18:22
-- Versão do servidor: 10.5.12-MariaDB-cll-lve
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u562704257_gerenciamento_`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `espaco_cafe`
--

CREATE TABLE `espaco_cafe` (
  `id_espaco_cafe` int(11) NOT NULL,
  `nome_espaco_cafe` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lotacao_max_cafe` int(11) NOT NULL DEFAULT 0,
  `qtn_inscritos` int(11) NOT NULL DEFAULT 0,
  `datecreate` datetime NOT NULL,
  `datemodified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id_pessoa` int(11) NOT NULL,
  `nome_pessoa` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sobre_nome_pessoa` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sala_id` int(11) NOT NULL,
  `cafe_id_um` int(11) NOT NULL,
  `cafe_id_dois` int(11) NOT NULL,
  `datecreate` datetime NOT NULL,
  `datemodified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala_evento`
--

CREATE TABLE `sala_evento` (
  `id_sala` int(11) NOT NULL,
  `nome_sala` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lotacao_sala` int(11) NOT NULL,
  `qnt_inscritos` int(11) NOT NULL,
  `datecreate` datetime NOT NULL,
  `datemodified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sala_evento`
--

INSERT INTO `sala_evento` (`id_sala`, `nome_sala`, `lotacao_sala`, `qnt_inscritos`, `datecreate`, `datemodified`) VALUES
(1, 'Sala 1', 10, 0, '2022-08-04 08:45:33', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `espaco_cafe`
--
ALTER TABLE `espaco_cafe`
  ADD PRIMARY KEY (`id_espaco_cafe`);

--
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id_pessoa`),
  ADD KEY `sala_id` (`sala_id`),
  ADD KEY `cafe_id_um` (`cafe_id_um`),
  ADD KEY `cafe_id_dois` (`cafe_id_dois`);

--
-- Índices para tabela `sala_evento`
--
ALTER TABLE `sala_evento`
  ADD PRIMARY KEY (`id_sala`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `espaco_cafe`
--
ALTER TABLE `espaco_cafe`
  MODIFY `id_espaco_cafe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sala_evento`
--
ALTER TABLE `sala_evento`
  MODIFY `id_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD CONSTRAINT `pessoas_ibfk_1` FOREIGN KEY (`sala_id`) REFERENCES `sala_evento` (`id_sala`),
  ADD CONSTRAINT `pessoas_ibfk_2` FOREIGN KEY (`cafe_id_um`) REFERENCES `espaco_cafe` (`id_espaco_cafe`),
  ADD CONSTRAINT `pessoas_ibfk_3` FOREIGN KEY (`cafe_id_dois`) REFERENCES `espaco_cafe` (`id_espaco_cafe`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
