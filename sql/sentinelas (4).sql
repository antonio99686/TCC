-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 26-Jul-2024 às 23:32
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.2.0

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
-- Estrutura da tabela `mensalidades`
--

DROP TABLE IF EXISTS `mensalidades`;
CREATE TABLE IF NOT EXISTS `mensalidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int DEFAULT NULL,
  `mes` varchar(7) DEFAULT NULL,
  `pago` tinyint(1) DEFAULT '0',
  `comprovante` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `mensalidades`
--

INSERT INTO `mensalidades` (`id`, `usuario_id`, `mes`, `pago`, `comprovante`) VALUES
(55, 38, 'July', 1, '66a42e98c42f6.jpg'),
(58, 25, 'July', 1, '669f936d98848.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `roupas`
--

INSERT INTO `roupas` (`id`, `nome`, `status_devolucao`, `id_usuario`) VALUES
(80, 'Bombacha', 0, 38),
(81, 'espora', 0, 38),
(82, 'flor', 1, 25),
(83, 'vestido ', 1, 25),
(84, 'lenço', 0, 38),
(85, 'vestido ', 1, 28),
(86, 'chapeu', 0, 38),
(87, 'camisa', 0, 38),
(88, 'lenço de mão ', 0, 38),
(89, 'faixa', 0, 38),
(90, 'colete', 0, 38),
(130, 'Bombacha', 0, 67),
(131, 'Espora', 0, 67),
(132, 'Lenço', 0, 67),
(133, 'Chapéu', 0, 67),
(134, 'Camisa', 0, 67),
(135, 'Lenço de mão', 0, 67),
(136, 'Faixa', 0, 67),
(137, 'Colete', 0, 67),
(138, 'Bombacha', 0, 68),
(139, 'Espora', 0, 68),
(140, 'Lenço', 0, 68),
(141, 'Chapéu', 0, 68),
(142, 'Camisa', 0, 68),
(143, 'Lenço de mão', 0, 68),
(144, 'Faixa', 0, 68),
(145, 'Colete', 0, 68);

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
  `CPF` char(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
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
  `identidade_frente` varchar(255) NOT NULL,
  `identidade_verso` varchar(255) NOT NULL,
  `primeiro_login` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  KEY `id_usuario` (`id_usuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `statuss`, `nome`, `email`, `datas`, `CPF`, `RG`, `categoria`, `senha`, `telefone`, `matricula`, `imagem`, `genero`, `endereco`, `responsavel`, `data_entrada`, `tele_respon`, `idade`, `nom_dan`, `identidade_frente`, `identidade_verso`, `primeiro_login`) VALUES
(2, 3, 'Raquel Mattes Mongelo', 'Raquelmattes88@gmail.com', '1975-09-12', '806.104.200-20', '1234567890', 'adulto', '123', '55999982163', '2024324058', 'raquel.jpg', 'F', 'cohab 2', 'proprio', '2034-04-12', '', '48', 'Luce Terezinha Mattes Mongelo', '', '', 0),
(3, 2, 'Jean Anderson Godoy de Souza', 'jean@gmail.com', '1974-05-31', '123.456.789-00', '1234567980', 'adulto', '123', '5596441634', '2024325874', '3.png', 'M', 'cohab 2', 'proprio', '2022-10-05', '', '50', '', '', '', 0),
(25, 1, 'Luce Terezinha Mattes Mongelo', 'lucemattes2@gmail.com', '2009-12-21', '055.008.660-95', '1234567890', 'juvenil', '123', '55999302422', '2024397380', 'luce.jpg', 'F', 'COHAB II Q19 CASA 302', 'Raquel mattes mongelo ', '2021-10-06', '55999982163', '14', 'Luce TerezinhaMattes Mongelo', '', '', 0),
(27, 1, 'Vitória da Silva Flores ', 'vitoriadasilvaflores2014@gmail.com', '2006-09-15', '048.797.760-25', '1112212053', 'adulto', 'Vitoria15', '55991898282', '2024885754', 'vih.jpg', 'F', 'santo inácio rua antônio mascia 936', ' andréia regiane santos da silva', '2023-06-26', '51 98151-30', '17', '', '', '', 0),
(28, 1, 'Larissa da Silva Alves', 'alveszlari@gmail.com', '2006-05-25', '043.242.640-07', '00000000000', 'adulto', 'Jesus101sa', '55996797629', '2024195451', 'lari.jpg', 'F', 'Emílio Brand Q7 n°133', 'Rita de Cascia da Silva Alves ', '2021-10-06', '55 99605518', '17', '', '', '', 0),
(29, 1, 'Lucas da Silva Alves  ', 'lucazalvessilva012@gmail.com', '2006-05-25', '043.242.590-03', '00000000000', 'adulto', '25052006', '55 99004987', '2024587151', 'lucas.jpg', 'M', ' cohab 2, quadra sete casa 133', 'Rita de Cascia da Silva Alves ', '2021-10-06', '55 99605518', '17', '', '', '', 0),
(38, 1, 'Antonio Carlos Mattes Mongelo', 'antonio.2022324018@aluno.iffar.edu.br', '2006-08-10', '055.008.400-29', '2108268794', 'adulto', '123', '55996860344', '2024843701', '38.jpg', 'M', 'Emílio Brand Q19 n°302', 'Raquel mattes mongelo ', '2021-10-06', '55999982163', '17', '', 'frente.jpg', 'verso.jpg', 0),
(67, 1, 'ALUCARD', 'ALUCARD666@gmail.com', '8585-05-08', '000.000.000-00', '78899656666', 'adulto', '123', '55991898282', '2024606748', '67.jpeg', 'M', 'cohab', ' andréia regiane santos da silva', '4569-05-08', '55999982163', '45', 'alucarddd', '', '', 0),
(68, 1, 'vitor murilo colcete de lima ', 'murilocolcete@gmail.com', '2004-06-03', '041.665.640-48', '00000000000', 'adulto', 'gremista26', '55991237560', '2024893269', '68.jpg', 'M', 'Rua tarumã 20 profilurb ', 'Isa Marina colcete de lima ', '2021-10-06', '55999558803', '20', '', '', '', 0);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `mensalidades`
--
ALTER TABLE `mensalidades`
  ADD CONSTRAINT `mensalidades_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limitadores para a tabela `roupas`
--
ALTER TABLE `roupas`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
