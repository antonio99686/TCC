-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05-Abr-2024 às 15:21
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sentinelas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `coordenador`
--

DROP TABLE IF EXISTS `coordenador`;
CREATE TABLE IF NOT EXISTS `coordenador` (
  `id_coor` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` char(16) NOT NULL,
  `CPF` char(11) NOT NULL,
  `nascimento` date NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `idade` varchar(2) NOT NULL,
  `funcao` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `RG` char(10) NOT NULL,
  `telefone` char(11) NOT NULL,
  `data_entrada` date NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  PRIMARY KEY (`id_coor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `coordenador`
--

INSERT INTO `coordenador` (`id_coor`, `nome`, `email`, `senha`, `CPF`, `nascimento`, `imagem`, `idade`, `funcao`, `RG`, `telefone`, `data_entrada`, `endereco`, `genero`) VALUES
(4, 'Jean de Souza', 'Jean@gmail.com', '123', '12345678900', '2014-04-01', '', '50', 'uruguaiana', '0000000000', '55999999999', '2014-04-30', 'cohab 2', 'M');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id_pais` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `nom_dan` varchar(255) NOT NULL,
  `senha` varchar(16) NOT NULL,
  `CPF` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `idade` varchar(2) NOT NULL,
  `nacionalidade` varchar(255) NOT NULL,
  `funcao` varchar(255) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`id_pais`, `nome`, `nom_dan`, `senha`, `CPF`, `idade`, `nacionalidade`, `funcao`, `telefone`, `email`, `imagem`) VALUES
(3, 'Raqual Mattes Monegelo', 'Luce Terezinha Mattes Mongelo', '123', '80610420020', '48', 'Uruguaiana', 'Mãe', '55999982163', 'Raquelmattes88@gmail.com', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `datas` date DEFAULT NULL,
  `CPF` varchar(255) DEFAULT NULL,
  `RG` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `responsavel` varchar(255) NOT NULL,
  `data_entrada` date NOT NULL,
  `tele_respon` varchar(255) NOT NULL,
  `idade` varchar(2) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `datas`, `CPF`, `RG`, `senha`, `tipo`, `telefone`, `usuario`, `imagem`, `genero`, `endereco`, `responsavel`, `data_entrada`, `tele_respon`, `idade`) VALUES
(17, 'Antonio Carlos Mattes Mongelo', 'antoniomattes72@gmail.com', '2006-08-10', '05500840029', '2108268794', '123', 'adulto', '5596860344', '2022324018', 'antonionMong.png', 'M', 'cohab 2', 'Raquel Mattes Mongelo', '2022-10-06', '55999982163', '17'),
(18, 'Luce Terezinha Mattes Mongelo', 'lucemattes2@gmail.com', '2009-12-21', '05500866095', '1234567890', '123', 'adulto ', '5599302422', '2022324010', 'luce.png', 'F', 'cohab 2', 'Raqual Mattes Monegelo ', '2022-10-05', '55999982163', '14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
