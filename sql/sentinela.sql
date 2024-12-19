-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 19-Dez-2024 às 17:08
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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `mensalidades`
--

INSERT INTO `mensalidades` (`id`, `usuario_id`, `mes`, `pago`, `comprovante`) VALUES
(60, 75, '2024-11', 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperar_senha`
--

DROP TABLE IF EXISTS `recuperar_senha`;
CREATE TABLE IF NOT EXISTS `recuperar_senha` (
  `email` varchar(255) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  `usado` tinyint NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `recuperar_senha`
--

INSERT INTO `recuperar_senha` (`email`, `data_criacao`, `token`, `usado`) VALUES
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-07 00:00:00', '273789115ca1ae8becf82e727781cfe16e7ac978fa52fc398688844a3eedf1bd21c219859bf360aaf9b0cc6cc50eb6e2cc4d', 0),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-07 00:00:00', '76daac7abc7744b9f4a4732cb5ba4f34b04d9db00b129d4170202a5842a0c341bedc651f335fc3607fe9335de46e7ccc6839', 0),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-07 12:34:50', 'eead5e465b5d13e6be66c8a4a5789ecfb31ec0f6d316e92b1e05f7043314aefd2ec2e0f52216a89534975fee8d16bb6261c6', 0),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-07 12:35:34', '0e2cc067b34a60b50f25553b4b535677c01f22197061d9be11bf20cdafa37478aa49ad338e363dc10256ff1fd475a5f59650', 0),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-07 12:35:51', '602d87f6c5b2c31a2698027d98e29060788bb7a72113470a0e1218d3325d2fb0e90ad387351492f2fc8902e81b4ca20ad84e', 0),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-07 12:36:41', 'fee60088a4154d43716dfcab680e78a0a81a42b485c3801905386273ec752855a7d78e627f128ced29fe2d4d11baec03a576', 0),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-07 12:40:56', 'a3e37b79389f14baae3d2da7d258272be9c1593274014e8238569c8234e323a6ac9523937bcddd802050ce85c5bd14f88da2', 0),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-07 12:41:15', '6e332e19a76a9ba30108c46c4aee9c397fff86dbeb689e175b9a2c49adcd9aba1a254bc1137ba7e3123be8adfff2db296c9a', 0),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-07 12:44:49', '0f3795216e8099a2e495a42065d7fe37364a3f6f7d51d89fea022390128736cc645ce75dda87c448fc2378d8112f36ee8ced', 1),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-07 12:49:29', '9c8b383d938873b00afbfd79634c7bd3198712be761be07f962ac642e9276085dd7c794bcaecd76d025e365df48c6216717c', 0),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-07 12:56:21', 'fe1dd5e3414fd4825b1c52d467eb24392aa222a59b42e197cd0a59111994cdeb3d465a4220932e6a8c6e934cce1a622f0863', 0),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-07 13:12:29', '256d274bf3548c454ab7f6af2abed5dc4f633b4c49d9c4123f1d231f4791523a14598f26e865bc97cb4a4d5fab0efd20476e', 1),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-10 11:20:06', '657af950284d1557d3b77357e5a2b65e1b2b49361a51e520fa2d4deef5dc38033c3d149c675f20c1a1841cbda34c645157eb', 0),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-31 15:53:53', 'e3dec29d3e8b377553e872c13fb24001692db191c0260c2b355f4ee947cd2cfa9ccc942ce31376c03185be4576988eecf209', 1),
('antonio.2022324018@aluno.iffar.edu.br', '2024-10-31 15:59:46', 'd34dfa81bba8d1473bbf004f0a0ad6c5ef0919074a693bc4401d76f49abcf14c7e3c8a3485f03ac3ebe15357d5389b76d918', 1),
('antonio.2022324018@aluno.iffar.edu.br', '2024-11-07 16:17:24', '6bd9b875fa1dbfa677a660eb60cb317d3082322f9eec29b3a88cebd0a8280c70c9f826de4c1b3b2a4221a1047daa95887291', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=278 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `roupas`
--

INSERT INTO `roupas` (`id`, `nome`, `status_devolucao`, `id_usuario`) VALUES
(170, 'Bombacha', 0, 73),
(171, 'Espora', 0, 73),
(172, 'Lenço', 0, 73),
(173, 'Chapéu', 0, 73),
(174, 'Camisa', 0, 73),
(175, 'Lenço de mão', 0, 73),
(176, 'Faixa', 0, 73),
(177, 'Colete', 0, 73),
(182, 'Flor', 0, 75),
(183, 'Lenço', 0, 75),
(184, 'Vestido', 0, 75),
(185, 'Brinco', 0, 75),
(262, 'Bombacha', 0, 86),
(263, 'Espora', 0, 86),
(264, 'Lenço', 1, 86),
(265, 'Chapéu', 1, 86),
(266, 'Camisa', 1, 86),
(267, 'Lenço de mão', 0, 86),
(268, 'Faixa', 0, 86),
(269, 'Colete', 0, 86);

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
  PRIMARY KEY (`id_usuario`),
  KEY `id_usuario` (`id_usuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `statuss`, `nome`, `email`, `datas`, `CPF`, `RG`, `categoria`, `senha`, `telefone`, `imagem`, `genero`, `endereco`, `responsavel`, `data_entrada`, `tele_respon`, `idade`, `nom_dan`, `identidade_frente`, `identidade_verso`) VALUES
(73, 2, 'Jean Anderson Godoy de Souza', 'jeananderson@gmail.com', '1974-05-31', '123.456.789-09', '1234567890', 'adulto', '$2y$10$eRxQeOVpY/4IVccCAo04qOMigmDYr0tQDSRFGgd2ijsOrgJq9V2Ha', '55991237560', '73.png', 'M', 'Quadra Dezenove, 302', 'proprio', '2022-10-06', '', '50', '', '', ''),
(75, 1, 'Larissa da Silva Alves', 'larissa@gmail.com', '2006-05-25', '043.242.640-07', '1234567890', 'adulto', '$2y$10$1MQohXS/2APGct6.BrMvZuSv9Q1XOiNrZ/Kue5Xqu4sRo3/DV9w4K', '55996507010', '75.jpg', 'F', 'Quadra Dezenove, 302', 'proprio', '2022-10-06', '', '18', '', '', ''),
(86, 1, 'Antonio Carlos Mattes Mongelo', 'antonio.2022324018@aluno.iffar.edu.br', '2006-08-10', '055.008.400-29', '1234567890', 'adulto', '$2y$10$oeLd2WWpvyQd2J0cdqeFle1SNUZeYCcuQSnunpRivC043N4WkvAuq', '55996860344', '86.jpg', 'M', 'Quadra Dezenove, 302', 'proprio', '2022-10-06', '', '18', '', '', '');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `mensalidades`
--
ALTER TABLE `mensalidades`
  ADD CONSTRAINT `mensalidades_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `roupas`
--
ALTER TABLE `roupas`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
