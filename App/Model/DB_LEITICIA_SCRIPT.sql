CREATE DATABASE leiticia DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

use leiticia;

CREATE TABLE leiticia.slide_show(
  id_slide_show INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(100) NULL,
  imagem VARCHAR(15) NOT NULL,
  link VARCHAR(200) NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE leiticia.postagem(
  id_postagem INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(100) NOT NULL,
  descricao VARCHAR(200) NOT NULL,
  imagem VARCHAR(15) NOT NULL,
  arquivo VARCHAR(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE leiticia.funcionario(
  id_funcionario INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  usuario VARCHAR(15) NOT NULL UNIQUE,
  senha VARCHAR(250) NOT NULL,
  administrador TINYINT DEFAULT FALSE NOT NULL,
  ativo TINYINT DEFAULT FALSE NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE leiticia.doadora(
  id_doadora INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  rg VARCHAR(11) NOT NULL,
  cpf CHAR(11) UNIQUE NOT NULL,
  cartao_sus CHAR(15) NOT NULL,
  data_nasc DATE NOT NULL,
  celular CHAR(11) NOT NULL,
  estado CHAR(2) NOT NULL,
  cidade VARCHAR(50) NOT NULL,
  bairro VARCHAR(50) NOT NULL,
  cep CHAR(8) NOT NULL,
  endereco VARCHAR(100) NOT NULL,
  data_registro DATE NOT NULL,
  status_doando CHAR(1) NOT NULL DEFAULT 'N',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE leiticia.gestacao(
  id_gestacao INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  doadora_id INTEGER UNSIGNED NOT NULL,
  loc_pre_natal VARCHAR(100) NOT NULL,
  num_consultas INTEGER UNSIGNED NOT NULL,
  peso_gest_inicio FLOAT NOT NULL,
  peso_gest_final FLOAT NOT NULL,
  data_parto DATE NOT NULL,
  loc_parto VARCHAR(100) NOT NULL,
  pre_natal_vdrl CHAR(1) NOT NULL,
  pre_natal_hbsag CHAR(1) NOT NULL,
  pre_natal_hb FLOAT NOT NULL,
  pre_natal_ht FLOAT NOT NULL,
  transf_sang_5_anos CHAR(1) NOT NULL,
  tabagismo CHAR(1) NOT NULL,
  etilismo VARCHAR(200) NOT NULL,
  drogas VARCHAR(200) NOT NULL,
  medicamentos_atuais TEXT NULL,
  interc_pre_natal VARCHAR(100) NOT NULL,
  interc_trat_intern_pre_natal VARCHAR(100) NOT NULL,
  obs_gestacao TEXT NULL,
  aprovada CHAR(1) NOT NULL,
  FOREIGN KEY (doadora_id) REFERENCES doadora (id_doadora)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE leiticia.doacao(
  id_doacao INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  doadora_id INTEGER UNSIGNED NOT NULL,
  data_doacao DATE NOT NULL,
  volume FLOAT NOT NULL,
  ac_dornic_media FLOAT NULL,
  media_s_c FLOAT NULL,
  media_c FLOAT NULL,
  caloria FLOAT NULL,
  aprovado CHAR(1) NOT NULL,
  FOREIGN KEY (doadora_id) REFERENCES doadora (id_doadora)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE leiticia.conformidade(
  id_conformidade INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  descricao VARCHAR(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE leiticia.nao_conformidade(
  id_nao_conformidade INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  doacao_id INTEGER UNSIGNED NOT NULL,
  conformidade_id INTEGER UNSIGNED NOT NULL,
  FOREIGN KEY (doacao_id) REFERENCES doacao (id_doacao),
  FOREIGN KEY (conformidade_id) REFERENCES conformidade (id_conformidade)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE leiticia.lote_pasteurizacao(
  id_lote INTEGER INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  codigo_lote CHAR(8) UNIQUE NOT NULL,
  data_lote DATE NOT NULL,
  pasteurizacao_aprovada CHAR(1) NOT NULL,
  funcionario_id INTEGER UNSIGNED NOT NULL,
  FOREIGN KEY (funcionario_id) REFERENCES funcionario (id_funcionario),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE leiticia.doadora_semana(
  id_doadora_semana INTEGER INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  doadora_id INTEGER UNSIGNED NOT NULL,
  FOREIGN KEY (doadora_id) REFERENCES doadora (id_doadora),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
