-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 26-Mar-2024 às 12:56
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
-- Estrutura da tabela `acessorios_fem`
--

DROP TABLE IF EXISTS `acessorios_fem`;
CREATE TABLE IF NOT EXISTS `acessorios_fem` (
  `id_femenino` int NOT NULL,
  `vestido` varchar(255) NOT NULL,
  `flor` varchar(255) NOT NULL,
  `brinco` varchar(255) NOT NULL,
  `lenço de mão` varchar(255) NOT NULL,
  `genero_fem` int NOT NULL,
  PRIMARY KEY (`id_femenino`),
  KEY `genero_fem` (`genero_fem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `acessorios_fem`
--

INSERT INTO `acessorios_fem` (`id_femenino`, `vestido`, `flor`, `brinco`, `lenço de mão`, `genero_fem`) VALUES
(0, 'ok', 'ok', 'ok', 'ok\r\n', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessorios_masc`
--

DROP TABLE IF EXISTS `acessorios_masc`;
CREATE TABLE IF NOT EXISTS `acessorios_masc` (
  `id_masculino` int NOT NULL AUTO_INCREMENT,
  `bombacha` varchar(255) DEFAULT NULL,
  `camisa` varchar(255) DEFAULT NULL,
  `colete` varchar(255) DEFAULT NULL,
  `guaiaca` varchar(255) DEFAULT NULL,
  `esporas` varchar(255) DEFAULT NULL,
  `chapéu` varchar(255) DEFAULT NULL,
  `lenço` varchar(255) DEFAULT NULL,
  `genero_mas` int NOT NULL,
  PRIMARY KEY (`id_masculino`),
  KEY `genero_mas` (`genero_mas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `coordenador` int NOT NULL,
  `dancarino` int NOT NULL,
  `pais` int NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `coordenador`, `dancarino`, `pais`) VALUES
(0, 1, 2, 3);

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
  `coordenador` int NOT NULL,
  PRIMARY KEY (`id_coor`),
  KEY `coordenador` (`coordenador`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `id_masculino` int NOT NULL,
  `id_femenino` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_genero` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_genero`),
  UNIQUE KEY `femenino` (`id_femenino`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  KEY `masculino` (`id_masculino`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `nome` int NOT NULL,
  `nom_dan` int NOT NULL,
  `senha` varchar(16) NOT NULL,
  `cpf` char(11) NOT NULL,
  `id_pais` int NOT NULL AUTO_INCREMENT,
  `pais` int NOT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `datas` varchar(255) DEFAULT NULL,
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
  `dancarino` int NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `datas`, `CPF`, `RG`, `senha`, `tipo`, `telefone`, `usuario`, `imagem`, `genero`, `endereco`, `responsavel`, `data_entrada`, `tele_respon`, `dancarino`) VALUES
(6, 'Antonio Carlos Mattes Mongelo', 'antonio.2022324018@aluno.iffar.edu.br', '10/08/2006', '05500840029', '2108268794', '123', 'juvenil', '55996860344', '2184', 'Antnio_Mattes.png', 'M', '', '', '0000-00-00', '', 0),
(7, 'Luce Mattes Mongelo', 'lucemattes2@gmail.com', '21/12/2009', '05500866095', '1234567890', '123', 'mirim', '5599302422', '2058', 'luce mattes.png', 'F', '', '', '0000-00-00', '', 0),
(8, 'Larissa da Silva Alvez', 'larissa@gmail.com', '25/05/2006', '80610420020', '1234567890', '123', 'juvenil', '55996860344', '9729', 'IMG_20221015_203904_511.png', 'F', '', '', '0000-00-00', '', 0),
(9, 'Raquel Mattes Mongelo', 'raquelmattes88@gmail.com', '1975-09-12', '80610420000', '2108268794', '123', 'adulto', '55999982163', '6195', 'download.jfif', 'F', '', '', '0000-00-00', '', 0);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `genero`
--
ALTER TABLE `genero`
  ADD CONSTRAINT `genero_ibfk_1` FOREIGN KEY (`id_femenino`) REFERENCES `acessorios_fem` (`id_femenino`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `genero_ibfk_2` FOREIGN KEY (`id_masculino`) REFERENCES `acessorios_masc` (`id_masculino`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `genero_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
