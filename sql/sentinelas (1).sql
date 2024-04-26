-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 26-Abr-2024 às 18:56
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `roupas`
--

INSERT INTO `roupas` (`id`, `nome`, `status_devolucao`, `id_usuario`) VALUES
(3, 'Bombacha', 3, 1),
(4, 'Camisa', 1, 1),
(5, 'Cinto (ou guaiaca)', 0, 1),
(6, 'Chapéu', 1, 1),
(7, 'Lenço', 0, 1),
(8, 'Esporas', 0, 1),
(9, 'lenço', 1, 11);

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
  PRIMARY KEY (`id_usuario`),
  KEY `id_usuario` (`id_usuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `statuss`, `nome`, `email`, `datas`, `CPF`, `RG`, `categoria`, `senha`, `telefone`, `matricula`, `imagem`, `genero`, `endereco`, `responsavel`, `data_entrada`, `tele_respon`, `idade`, `nom_dan`) VALUES
(1, 1, 'Antonio Carlos Mattes Mongelo', 'antoniomattes72@gmail.com', '2006-08-10', '05500840029', '2108268794', 'juvenil', '123', '5596860344', '2022324018', 'antonionMong.png', 'M', 'cohab 2', 'Raquel Mattes Mongelo', '2022-10-06', '55999982163', '17', ''),
(2, 3, 'Raquel Mattes Mongelo', 'Raquelmattes88@gmail.com', '1975-09-12', '80610420020', '1234567890', 'adulto', '123', '55999982163', '2022324058', 'raquel.jpg', 'F', 'cohab 2', 'proprio', '2034-04-12', '', '48', 'Luce Terezinha Mattes Mongelo'),
(3, 2, 'JEAN ANDERSON GODOY DE SOUZA', 'jean@gmail.com', '1974-05-31', '12345678900', '1234567980', 'adulto', '123', '5596441634', '2022325874', 'jean.png', 'M', 'cohab 2', 'proprio', '2022-10-05', '', '50', ''),
(6, 1, 'Mariana Oliveira', 'mariana@example.com', '1993-03-03', '888.888.888-00', '8888888', 'juvenil', 'senha888', '888888888', 'M88888', 'imagem6.jpg', 'F', 'Rua F, 888', 'Carlos Oliveira', '2022-05-01', '222222222', '29', 'Dançarina'),
(7, 1, 'Fernando Santos', 'fernando@example.com', '1994-04-04', '999.999.999-00', '9999999', 'mirim', 'senha999', '999999999', 'M99999', 'imagem7.jpg', 'M', 'Rua G, 999', 'Patrícia Santos', '2022-06-01', '333333333', '28', 'Dançarino'),
(8, 1, 'Isabela Lima', 'isabela@example.com', '1996-06-06', '111.111.111-00', '1111111', 'adulto', 'senha111', '111111111', 'M11111', 'imagem8.jpg', 'F', 'Rua H, 111', 'Rodrigo Lima', '2022-07-01', '444444444', '26', 'Dançarina'),
(9, 1, 'Rafaela Fernandes', 'rafaela@example.com', '1997-07-07', '222.222.222-00', '2222222', 'juvenil', 'senha222', '222222222', 'M22222', 'imagem9.jpg', 'F', 'Rua I, 222', 'Paulo Fernandes', '2022-08-01', '555555555', '25', 'Dançarina'),
(10, 1, 'Gabriel Almeida', 'gabriel@example.com', '1998-08-08', '333.333.333-00', '3333333', 'adulto', 'senha333', '333333333', 'M33333', 'imagem10.jpg', 'M', 'Rua J, 333', 'Mariana Almeida', '2022-09-01', '666666666', '24', 'Dançarino'),
(11, 1, 'Larissa Silva', 'larissa@example.com', '1999-09-09', '444.444.444-00', '4444444', 'juvenil', '444', '444444444', 'M44444', 'kratos.jpg', 'F', 'Rua K, 444', 'Fernando Silva', '2022-10-01', '777777777', '23', 'Dançarina'),
(12, 1, 'Thiago Oliveira', 'thiago@example.com', '2000-10-10', '555.555.555-00', '5555555', 'juvenil', 'senha555', '555555555', 'M55555', 'imagem12.jpg', 'M', 'Rua L, 555', 'Isabela Oliveira', '2022-11-01', '888888888', '22', 'Dançarino'),
(13, 1, 'Camila Santos', 'camila@example.com', '2001-11-11', '666.666.666-00', '6666666', 'mirim', 'senha666', '666666666', 'M66666', 'imagem13.jpg', 'F', 'Rua M, 666', 'Pedro Santos', '2022-12-01', '999999999', '21', 'Dançarina'),
(14, 1, 'Lucas Lima', 'lucas@example.com', '2002-12-12', '777.777.777-00', '7777777', 'adulto', 'senha777', '777777777', 'M77777', 'imagem14.jpg', 'M', 'Rua N, 777', 'Mariana Lima', '2023-01-01', '1010101010', '20', 'Dançarino'),
(15, 1, 'Juliana Fernandes', 'juliana@example.com', '2003-01-01', '888.888.888-00', '8888888', 'mirim', 'senha888', '888888888', 'M88888', 'imagem15.jpg', 'F', 'Rua O, 888', 'Rafael Fernandes', '2023-02-01', '1111111111', '19', 'Dançarina');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `roupas`
--
ALTER TABLE `roupas`
  ADD CONSTRAINT `roupas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
