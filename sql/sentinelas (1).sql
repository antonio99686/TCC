-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 15-Mar-2024 às 11:11
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
  `coordanador` int NOT NULL,
  `dancarino` int NOT NULL,
  PRIMARY KEY (`id_categoria`),
  KEY `coordanador` (`coordanador`,`dancarino`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `coordanador`, `dancarino`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `convites`
--

DROP TABLE IF EXISTS `convites`;
CREATE TABLE IF NOT EXISTS `convites` (
  `id_convite` int NOT NULL AUTO_INCREMENT,
  `fk_id_destinatario` int NOT NULL,
  `fk_id_remetente` int NOT NULL,
  `fk_id_evento` int NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_convite`),
  KEY `fk_id_destinatario` (`fk_id_destinatario`),
  KEY `fk_id_remetente` (`fk_id_remetente`),
  KEY `fk_id_evento` (`fk_id_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `convites`
--

INSERT INTO `convites` (`id_convite`, `fk_id_destinatario`, `fk_id_remetente`, `fk_id_evento`, `status`) VALUES
(1, 2, 1, 2, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id_evento` int NOT NULL AUTO_INCREMENT,
  `fk_id_usuario` int DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `cor` varchar(7) DEFAULT NULL,
  `inicio` datetime NOT NULL,
  `termino` datetime DEFAULT NULL,
  PRIMARY KEY (`id_evento`),
  KEY `fk_id_usuario` (`fk_id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id_evento`, `fk_id_usuario`, `titulo`, `descricao`, `cor`, `inicio`, `termino`) VALUES
(1, 1, 'Aniversario', 'Aniversario do Fulano', '#40E0D0', '2019-07-06 13:30:00', '2019-07-06 16:30:00'),
(2, 1, 'Entrevista Tecnica', 'Entrevista com Carlos da TokenLab.', '#FF0000', '2019-07-11 09:30:00', '2019-07-11 10:30:00'),
(3, 2, 'Jogatina', 'Dia de jogatina com amigos.', '#0071c5', '2019-07-12 18:00:00', '2019-07-13 00:00:00');

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
-- Estrutura da tabela `schedule_list`
--

DROP TABLE IF EXISTS `schedule_list`;
CREATE TABLE IF NOT EXISTS `schedule_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `title`, `description`, `start_datetime`, `end_datetime`) VALUES
(1, 'Sample 101', 'This is a sample schedule only.', '2022-01-10 10:30:00', '2022-01-11 18:00:00'),
(2, 'Sample 102', 'Sample Description 102', '2022-01-08 09:30:00', '2022-01-08 11:30:00'),
(4, 'Sample 102', 'Sample Description', '2022-01-12 14:00:00', '2022-01-12 17:00:00');

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
  `id_categoria` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `datas`, `CPF`, `RG`, `senha`, `tipo`, `telefone`, `usuario`, `imagem`, `genero`, `id_categoria`) VALUES
(6, 'Antonio Carlos Mattes Mongelo', 'antonio.2022324018@aluno.iffar.edu.br', '10/08/2006', '05500840029', '2108268794', '123', 'juvenil', '55996860344', '2184', 'Antnio_Mattes.png', 'M', 0),
(10, 'Luce Mattes Mongelo', 'lucemattes2@gmail.com', '2009-12-21', '05500866095', '2108268794', '123', 'mirim', '5599302422', '8657', 'luce mattes.jpg', 'F', 0),
(11, 'Raquel Mattes Mongelo', 'raquelmattes88@gmail.com', '1975-09-12', '80610420020', '1234567890', '123', 'adulto', '55999982163', '8800', 'IMG_20221106_063355_759.jpg', 'F', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(15) NOT NULL,
  `senha` text NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `senha`) VALUES
(1, 'Gabriel', '63ab910cb3a7bc89faae5a46aa337aa22f5f4d30'),
(2, 'Carlos', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(3, 'mongelo', '123456');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `convites`
--
ALTER TABLE `convites`
  ADD CONSTRAINT `convites_ibfk_1` FOREIGN KEY (`fk_id_destinatario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `convites_ibfk_2` FOREIGN KEY (`fk_id_remetente`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `convites_ibfk_3` FOREIGN KEY (`fk_id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Limitadores para a tabela `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`id_usuario`);

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
