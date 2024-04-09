-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09-Abr-2024 às 17:19
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
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `statuss` int DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `datas` date DEFAULT NULL,
  `CPF` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
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
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `statuss`, `nome`, `email`, `datas`, `CPF`, `RG`, `categoria`, `senha`, `telefone`, `matricula`, `imagem`, `genero`, `endereco`, `responsavel`, `data_entrada`, `tele_respon`, `idade`, `nom_dan`) VALUES
(1, 1, 'Antonio Carlos Mattes Mongelo', 'antoniomattes72@gmail.com', '2006-08-10', '05500840029', '2108268794', 'juvenil', '123', '5596860344', '2022324018', 'antonionMong.png', 'M', 'cohab 2', 'Raquel Mattes Mongelo', '2022-10-06', '55999982163', '17', ''),
(2, 3, 'Raquel Mattes Mongelo', 'Raquelmattes88@gmail.com', '1975-09-12', '80610420020', '1234567890', 'adulto', '123', '55999982163', '2022324058', 'raquel.jpg', 'F', 'cohab 2', 'proprio', '2034-04-12', '', '48', 'Luce Terezinha Mattes Mongelo'),
(3, 2, 'Jean de Souza', 'jean@gmail.com', '1974-05-31', '12345678900', '1234567980', 'adulto', '123', '5596441634', '2022325874', 'jean.png', 'M', 'cohab 2', 'proprio', '2022-10-05', '', '50', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
