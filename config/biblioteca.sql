-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 28-Nov-2022 às 13:48
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

DROP TABLE IF EXISTS `alunos`;
CREATE TABLE IF NOT EXISTS `alunos` (
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
  `nome_aluno` varchar(60) COLLATE utf8_bin NOT NULL,
  `telefone` varchar(15) COLLATE utf8_bin NOT NULL,
  `endereco` varchar(100) COLLATE utf8_bin NOT NULL,
  `bairro` varchar(45) COLLATE utf8_bin NOT NULL,
  `numero` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `complemento` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `cidade` varchar(45) COLLATE utf8_bin NOT NULL,
  `cep` varchar(10) COLLATE utf8_bin NOT NULL,
  `uf` varchar(45) COLLATE utf8_bin NOT NULL,
  `referencia` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `dt_nascimento` date NOT NULL,
  `dt_criacao` datetime NOT NULL DEFAULT current_timestamp(),
  `status_aluno` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `alunos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacoes`
--

DROP TABLE IF EXISTS `locacoes`;
CREATE TABLE IF NOT EXISTS `locacoes` (
  `id_locacao` int(11) NOT NULL AUTO_INCREMENT,
  `cod_aluno` int(11) NOT NULL,
  `cod_titulo` int(11) NOT NULL,
  `dt_locacao` datetime NOT NULL DEFAULT current_timestamp(),
  `dt_retorno` datetime DEFAULT current_timestamp(),
  `status_devolucao_locacao` int(11) NOT NULL DEFAULT 1,
  `status_locacao` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_locacao`),
  KEY `cod_aluno_idx` (`cod_aluno`),
  KEY `cod_titulo_idx` (`cod_titulo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `locacoes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `titulos`
--

DROP TABLE IF EXISTS `titulos`;
CREATE TABLE IF NOT EXISTS `titulos` (
  `id_titulo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_titulo` varchar(100) COLLATE utf8_bin NOT NULL,
  `tipo` varchar(45) COLLATE utf8_bin NOT NULL,
  `locacao` int(11) NOT NULL,
  `status_titulo` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_titulo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `titulos`
--

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `locacoes`
--
ALTER TABLE `locacoes`
  ADD CONSTRAINT `cod_aluno` FOREIGN KEY (`cod_aluno`) REFERENCES `alunos` (`id_aluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cod_titulo` FOREIGN KEY (`cod_titulo`) REFERENCES `titulos` (`id_titulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
