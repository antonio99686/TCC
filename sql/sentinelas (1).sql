-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Maio-2024 às 20:36
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
-- Estrutura da tabela `pagamentos`
--

DROP TABLE IF EXISTS `pagamentos`;
CREATE TABLE IF NOT EXISTS `pagamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `data_pagamento` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pagamentos` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `pagamentos`
--

INSERT INTO `pagamentos` (`id`, `id_usuario`, `valor`, `data_pagamento`) VALUES
(1, 1, '100.00', '2024-05-16'),
(2, 1, '5.00', '2024-05-13'),
(3, 1, '5.00', '2024-05-13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `roupas`
--

DROP TABLE IF EXISTS `roupas`;
CREATE TABLE IF NOT EXISTS `roupas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `status_devolucao` tinyint(1) DEFAULT '0',
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `roupas`
--

INSERT INTO `roupas` (`id`, `nome`, `status_devolucao`, `id_usuario`) VALUES
(3, 'Bombacha', 1, 1),
(4, 'Camisa', 1, 1),
(5, 'Cinto (ou guaiaca)', 0, 1),
(6, 'Chapéu', 1, 1),
(7, 'Lenço', 1, 1),
(8, 'Esporas', 0, 1),
(9, 'lenço de mao', 1, 1),
(10, 'fita do chapeu ', 0, 1),
(12, 'vestido ', 1, 25),
(13, 'brinco ', 0, 25),
(14, 'lenço', 1, 25),
(15, 'flor', 0, 25),
(46, 'flor', 1, 26),
(47, 'vestido ', 1, 26);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `statuss` int DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `datas` date DEFAULT NULL,
  `CPF` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `RG` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `categoria` varchar(255) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `telefone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `matricula` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `imagem` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `responsavel` varchar(255) NOT NULL,
  `data_entrada` date NOT NULL,
  `tele_respon` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `idade` varchar(2) NOT NULL,
  `nom_dan` varchar(255) NOT NULL,
  `saldo` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_usuario`),
  KEY `id_usuario` (`id_usuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `statuss`, `nome`, `email`, `datas`, `CPF`, `RG`, `categoria`, `senha`, `telefone`, `matricula`, `imagem`, `genero`, `endereco`, `responsavel`, `data_entrada`, `tele_respon`, `idade`, `nom_dan`, `saldo`) VALUES
(1, 1, 'Antonio Carlos Mattes Mongelo', 'antoniomattes72@gmail.com', '2006-08-10', '05500840029', '2108268794', 'juvenil', '123', '5596860344', '2022324018', 'antonionMong.png', 'M', 'cohab 2', 'Raquel Mattes Mongelo', '2022-10-06', '55999982163', '17', '', '100.00'),
(2, 3, 'Raquel Mattes Mongelo', 'Raquelmattes88@gmail.com', '1975-09-12', '80610420020', '1234567890', 'adulto', '123', '55999982163', '2022324058', 'raquel.jpg', 'F', 'cohab 2', 'proprio', '2034-04-12', '', '48', 'Luce Terezinha Mattes Mongelo', '150.00'),
(3, 2, 'JEAN ANDERSON GODOY DE SOUZA', 'jean@gmail.com', '1974-05-31', '12345678900', '1234567980', 'adulto', '123', '5596441634', '2022325874', 'jean.png', 'M', 'cohab 2', 'proprio', '2022-10-05', '', '50', '', '200.00'),
(14, 1, 'Lucas Lima', 'lucas@example.com', '2002-12-12', '777.777.777-00', '7777777', 'adulto', 'senha777', '777777777', 'M77777', 'imagem14.jpg', 'M', 'Rua N, 777', 'Mariana Lima', '2023-01-01', '1010101010', '20', 'Dançarino', '250.00'),
(25, 1, 'Luce Terezinha Mattes Mongelo', 'lucemattes2@gmail.com', '2009-12-21', '05500866095', '1234567890', 'juvenil', '123', '55999302422', '2024397380', 'luce.jpg', 'F', 'COHAB II Q19 CASA 302', 'Raquel mattes mongelo ', '2021-10-06', '55999982163', '14', 'Luce TerezinhaMattes Mongelo', '3.00'),
(26, 1, 'Larissa da Silva Alvez', 'larissa@gmail.com', '2006-05-25', '05500840030', '1234567890', 'adulto', '123', '55996860344', '2024277369', 'Captura de Tela (6).png', 'F', 'cohab', 'rita da silva alvez', '2021-10-06', '55996860344', '17', '', '5.00');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `roupas`
--
ALTER TABLE `roupas`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
