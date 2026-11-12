-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 12/11/2026 às 00:59
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

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
-- Estrutura para tabela `auditoria`
--

DROP TABLE IF EXISTS `auditoria`;
CREATE TABLE IF NOT EXISTS `auditoria` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint UNSIGNED DEFAULT NULL,
  `acao` varchar(80) NOT NULL,
  `entidade` varchar(70) NOT NULL,
  `entidade_id` bigint UNSIGNED DEFAULT NULL,
  `detalhes` json DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_auditoria_data` (`criado_em`),
  KEY `fk_auditoria_user` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avisos`
--

DROP TABLE IF EXISTS `avisos`;
CREATE TABLE IF NOT EXISTS `avisos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` varchar(160) NOT NULL,
  `conteudo` text NOT NULL,
  `criado_por` bigint UNSIGNED DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_avisos_data` (`criado_em`),
  KEY `fk_aviso_autor` (`criado_por`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracoes`
--

DROP TABLE IF EXISTS `configuracoes`;
CREATE TABLE IF NOT EXISTS `configuracoes` (
  `chave` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` text COLLATE utf8mb4_unicode_ci,
  `atualizado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`chave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` varchar(160) NOT NULL,
  `tipo` enum('ensaio','apresentacao','reuniao','evento') NOT NULL DEFAULT 'ensaio',
  `inicio` datetime NOT NULL,
  `fim` datetime DEFAULT NULL,
  `local` varchar(180) NOT NULL DEFAULT '',
  `descricao` text,
  `criado_por` bigint UNSIGNED DEFAULT NULL,
  `cancelado` tinyint(1) NOT NULL DEFAULT '0',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_eventos_inicio` (`inicio`,`cancelado`),
  KEY `fk_evento_autor` (`criado_por`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `figurinos`
--

DROP TABLE IF EXISTS `figurinos`;
CREATE TABLE IF NOT EXISTS `figurinos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(160) NOT NULL,
  `usuario_id` bigint UNSIGNED NOT NULL,
  `devolvido` tinyint(1) NOT NULL DEFAULT '0',
  `emprestado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `devolvido_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_figurinos_usuario` (`usuario_id`,`devolvido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `inscricoes_eventos`
--

DROP TABLE IF EXISTS `inscricoes_eventos`;
CREATE TABLE IF NOT EXISTS `inscricoes_eventos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `evento_id` bigint UNSIGNED NOT NULL,
  `usuario_id` bigint UNSIGNED NOT NULL,
  `status` enum('confirmado','pendente','cancelado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_inscricao_evento_usuario` (`evento_id`,`usuario_id`),
  KEY `idx_inscricoes_usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensalidades`
--

DROP TABLE IF EXISTS `mensalidades`;
CREATE TABLE IF NOT EXISTS `mensalidades` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint UNSIGNED NOT NULL,
  `mes` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(12,2) NOT NULL DEFAULT '0.00',
  `pago` tinyint(1) NOT NULL DEFAULT '0',
  `data_pagamento` datetime DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_mensalidade_usuario_mes` (`usuario_id`,`mes`),
  KEY `idx_mensalidades_mes` (`mes`,`pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `movimentos_caixa`
--

DROP TABLE IF EXISTS `movimentos_caixa`;
CREATE TABLE IF NOT EXISTS `movimentos_caixa` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` enum('entrada','saida') COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `data_movimento` date NOT NULL,
  `mensalidade_id` bigint UNSIGNED DEFAULT NULL,
  `registrado_por` bigint UNSIGNED DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_caixa_data` (`data_movimento`,`tipo`),
  KEY `fk_caixa_mensalidade` (`mensalidade_id`),
  KEY `fk_caixa_autor` (`registrado_por`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

DROP TABLE IF EXISTS `notificacoes`;
CREATE TABLE IF NOT EXISTS `notificacoes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint UNSIGNED NOT NULL,
  `titulo` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensagem` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lida_em` datetime DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_notificacoes_usuario` (`usuario_id`,`lida_em`,`criado_em`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `presencas`
--

DROP TABLE IF EXISTS `presencas`;
CREATE TABLE IF NOT EXISTS `presencas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `evento_id` bigint UNSIGNED NOT NULL,
  `usuario_id` bigint UNSIGNED NOT NULL,
  `situacao` enum('presente','ausente','justificado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ausente',
  `observacao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registrado_por` bigint UNSIGNED DEFAULT NULL,
  `registrado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_presenca_evento_usuario` (`evento_id`,`usuario_id`),
  KEY `idx_presencas_usuario` (`usuario_id`),
  KEY `fk_presenca_registrador` (`registrado_por`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `recuperar_senha`
--

DROP TABLE IF EXISTS `recuperar_senha`;
CREATE TABLE IF NOT EXISTS `recuperar_senha` (
  `email` varchar(255) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  `usado` tinyint NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(160) NOT NULL,
  `cpf` char(11) NOT NULL,
  `email` varchar(190) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `papel` enum('coordenador','integrante') NOT NULL DEFAULT 'integrante',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_usuarios_nome` (`nome`),
  KEY `idx_usuarios_papel` (`papel`,`ativo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `cpf`, `email`, `telefone`, `senha_hash`, `papel`, `ativo`, `criado_em`, `atualizado_em`) VALUES
(1, 'Antonio Carlos Mattes Mongelo', '05500840029', 'antonio.05500@aluno.iffar.edu.br', NULL, '$2y$10$sDfCseyuWkx8XBpJvRGiu.Hbx2sUW0kTkfkeLyB5UvjsjYq0miCEK', 'coordenador', 1, '2026-11-12 00:36:40', '2026-11-12 00:36:40'),
(2, 'luce terezinha mattes mongelo', '80610420020', 'antoniomattes72@gmail.com', '55996860344', '$2y$10$vRR4WMxYJwQNWrtVRvKYPedNLjcu1y9oOMHhtQj/W8n71IZpg7URW', 'integrante', 1, '2026-11-12 00:59:24', '2026-11-12 00:59:24');

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `fk_auditoria_user` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Restrições para tabelas `avisos`
--
ALTER TABLE `avisos`
  ADD CONSTRAINT `fk_aviso_autor` FOREIGN KEY (`criado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Restrições para tabelas `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk_evento_autor` FOREIGN KEY (`criado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Restrições para tabelas `figurinos`
--
ALTER TABLE `figurinos`
  ADD CONSTRAINT `fk_figurino_user` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `inscricoes_eventos`
--
ALTER TABLE `inscricoes_eventos`
  ADD CONSTRAINT `fk_inscricao_evento` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_inscricao_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `mensalidades`
--
ALTER TABLE `mensalidades`
  ADD CONSTRAINT `fk_mensalidade_user` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `movimentos_caixa`
--
ALTER TABLE `movimentos_caixa`
  ADD CONSTRAINT `fk_caixa_autor` FOREIGN KEY (`registrado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_caixa_mensalidade` FOREIGN KEY (`mensalidade_id`) REFERENCES `mensalidades` (`id`) ON DELETE SET NULL;

--
-- Restrições para tabelas `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `fk_notificacoes_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `presencas`
--
ALTER TABLE `presencas`
  ADD CONSTRAINT `fk_presenca_evento` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_presenca_registrador` FOREIGN KEY (`registrado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_presenca_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
