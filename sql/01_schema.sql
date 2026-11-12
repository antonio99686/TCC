-- Banco LIMPO: não contém dados pessoais do projeto original.
CREATE DATABASE IF NOT EXISTS sentinela_pro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sentinela_pro;
CREATE TABLE IF NOT EXISTS usuarios (
 id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(160) NOT NULL, cpf CHAR(11) NOT NULL UNIQUE,
 email VARCHAR(190) NULL UNIQUE, telefone VARCHAR(30) NULL,
 senha_hash VARCHAR(255) NOT NULL,
 papel ENUM('coordenador','integrante') NOT NULL DEFAULT 'integrante',
 ativo TINYINT(1) NOT NULL DEFAULT 1,
 criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 INDEX idx_usuarios_nome(nome), INDEX idx_usuarios_papel(papel,ativo)
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS eventos (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 titulo VARCHAR(160) NOT NULL, tipo ENUM('ensaio','apresentacao','reuniao','evento') NOT NULL DEFAULT 'ensaio',
 inicio DATETIME NOT NULL, fim DATETIME NULL, local VARCHAR(180) NOT NULL DEFAULT '',
 descricao TEXT NULL, criado_por BIGINT UNSIGNED NULL,
 cancelado TINYINT(1) NOT NULL DEFAULT 0,
 criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 INDEX idx_eventos_inicio(inicio,cancelado),
 CONSTRAINT fk_evento_autor FOREIGN KEY(criado_por) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS avisos (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, titulo VARCHAR(160) NOT NULL,
 conteudo TEXT NOT NULL, criado_por BIGINT UNSIGNED NULL,
 criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 INDEX idx_avisos_data(criado_em),
 CONSTRAINT fk_aviso_autor FOREIGN KEY(criado_por) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS mensalidades (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, usuario_id BIGINT UNSIGNED NOT NULL,
 mes CHAR(7) NOT NULL, valor DECIMAL(12,2) NOT NULL DEFAULT 0.00,
 pago TINYINT(1) NOT NULL DEFAULT 0, data_pagamento DATETIME NULL,
 criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY uq_mensalidade_usuario_mes(usuario_id,mes),
 INDEX idx_mensalidades_mes(mes,pago),
 CONSTRAINT fk_mensalidade_user FOREIGN KEY(usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS figurinos (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(160) NOT NULL,
 usuario_id BIGINT UNSIGNED NOT NULL, devolvido TINYINT(1) NOT NULL DEFAULT 0,
 emprestado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP, devolvido_em DATETIME NULL,
 INDEX idx_figurinos_usuario(usuario_id,devolvido),
 CONSTRAINT fk_figurino_user FOREIGN KEY(usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS auditoria (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, usuario_id BIGINT UNSIGNED NULL,
 acao VARCHAR(80) NOT NULL, entidade VARCHAR(70) NOT NULL, entidade_id BIGINT UNSIGNED NULL,
 detalhes JSON NULL, criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 INDEX idx_auditoria_data(criado_em),
 CONSTRAINT fk_auditoria_user FOREIGN KEY(usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB;
