CREATE DATABASE BANCO_DE_LEITE;

USE BANCO_DE_LEITE;


CREATE TABLE BANCO_DE_LEITE.FUNCIONARIO (
	ID_FUNCIONARIO INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	
	NOME VARCHAR(50) NOT NULL,
	
	USUARIO VARCHAR (15) NOT NULL,
	SENHA VARCHAR(15) NOT NULL,
	
	ADMINISTRADOR TINYINT DEFAULT FALSE /*TODO FUNCIONARIO NOVO ADIONADO AO BANCO, POR PADRÃO NÃO É ADMINISTRADOR*/
);

CREATE TABLE BANCO_DE_LEITE.DOADORA (
	ID_DOADORA INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	
	NOME VARCHAR(50) NOT NULL,
	RG CHAR(11) UNIQUE NULL,
	CPF CHAR(11) UNIQUE NULL,
	CARTAO_SUS CHAR(15) NOT NULL,
	DATA_NASC DATE NOT NULL,
	
	CELULAR CHAR(11) NULL,
	
	ESTADO CHAR(2) NULL,
	CIDADE VARCHAR(20) NULL,
	BAIRRO VARCHAR(30) NULL,
	CEP CHAR(8) NULL,
	ENDERECO VARCHAR(50) NOT NULL,
	
	DATA_REGISTRO DATE NOT NULL,
	
	STATUS_DOANDO TINYINT NOT NULL DEFAULT FALSE /*INDICA SE A DOADORA ESTÁ OU NÃO DOANDO NO MOMENTO*/
);

CREATE TABLE BANCO_DE_LEITE.GESTACAO (
	ID_GESTACAO INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	
	DOADORA_ID INTEGER UNSIGNED NOT NULL,
	
	LOC_PRE_NATAL VARCHAR(100) NULL,
	NUM_CONSULTAS INTEGER UNSIGNED NULL,
	
	PESO_GEST_INT FLOAT NULL,
	PESO_GEST_FIN FLOAT NULL,
	
	DATA_PARTO DATE NOT NULL,
	LOC_PARTO VARCHAR(100) NOT NULL,
	
	PRE_NATAL_VDRL TINYINT NULL DEFAULT NULL,
	PRE_NATAL_HBSAG TINYINT NULL DEFAULT NULL,
	
	PRE_NATAL_HB FLOAT NOT NULL,
	PRE_NATAL_HT FLOAT NOT NULL,
	
	TRANSF_SANG_5ANOS TINYINT NULL,
	
	TABAGISMO TINYINT NOT NULL,
	ETILISMO VARCHAR(50) NOT NULL,
	DROGAS VARCHAR(50) NOT NULL,
	
	MEDICAMENTOS_ATUAIS TEXT NULL,
	
	INTERC_PRE_NATAL VARCHAR(100) NULL,
	INTER_TRAT_INT_PRE_NATAL VARCHAR(100) NULL,
	
	OBS_DOADORA TEXT NULL,
	
	DOADORA_APTA TINYINT NOT NULL DEFAULT FALSE,
    
	/*DOADORA_ATIVA TINYINT NOT NULL,*/
	
	FOREIGN KEY (DOADORA_ID) REFERENCES DOADORA (ID_DOADORA)
);


CREATE TABLE BANCO_DE_LEITE.DOACAO (
	ID_DOACAO INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

	/*GESTACAO_ID INTEGER UNSIGNED NOT NULL,*/
	DOADORA_ID INTEGER UNSIGNED NOT NULL,
	
	DATA_DOACAO DATE NOT NULL,
	
	VOL_DOACAO FLOAT NOT NULL,
	
	DATA_TRIAGEM DATE NULL,
	AC_DORNIC_MEDIA FLOAT NULL,
	APROVADO_TRIAGEM TINYINT NULL,

	/*FOREIGN KEY (GESTACAO_ID) REFERENCES GESTACAO (ID_GESTACAO)*/
	FOREIGN KEY (DOADORA_ID) REFERENCES DOADORA (ID_DOADORA)
);


CREATE TABLE BANCO_DE_LEITE.CREMATORITO (
  ID_CREMATOCRITO INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

  DOACAO_ID INTEGER UNSIGNED NOT NULL,

  MEDIA_S_C FLOAT NULL,
  MEDIA_C FLOAT NULL,
  CALORIA FLOAT NULL,

  FOREIGN KEY (DOACAO_ID) REFERENCES DOACAO (ID_DOACAO)
);

CREATE TABLE BANCO_DE_LEITE.LOTE_E_PASTEURIZACAO (
	ID_LOTE_E_PASTEURIZACAO INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

	FUNCIONARIO_ID INTEGER UNSIGNED NOT NULL,
	
	CODIGO_LOTE CHAR(8) UNIQUE NOT NULL,
	DATA_LOTE_E_PASTEURIZACAO DATE NOT NULL,
	PASTEURIZACAO_APROVADA TINYINT NOT NULL,

	FOREIGN KEY (FUNCIONARIO_ID) REFERENCES FUNCIONARIO (ID_FUNCIONARIO)
); 

CREATE TABLE BANCO_DE_LEITE.FRASCO_LH (
	ID_FRASCO_LH INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

	LOTE_ID INTEGER UNSIGNED NOT NULL,

	NUM_FRASCO_LOTE INT NOT NULL,
	/*CODIGO_FRASCO CHAR(10) NOT NULL,*/

	VOL_FRASCO FLOAT NULL,

	ACIDEZ_DORNIC INTEGER UNSIGNED NULL,
	APROVADO_MICROBIOLOGICO TINYINT NULL,

	ENTREGUE TINYINT NULL DEFAULT FALSE,

	FOREIGN KEY (LOTE_ID) REFERENCES LOTE_E_PASTEURIZACAO (ID_LOTE_E_PASTEURIZACAO)
);

CREATE TABLE BANCO_DE_LEITE.DOACAO_e_FRASCO_LH (
	ID_DOACAO_E_FRASCO_LH INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

	DOACAO_ID INTEGER UNSIGNED NOT NULL,
	FRASCO_ID INTEGER UNSIGNED NOT NULL,

	FOREIGN KEY (DOACAO_ID) REFERENCES DOACAO (ID_DOACAO),
	FOREIGN KEY (FRASCO_ID) REFERENCES FRASCO_LH  (ID_FRASCO_LH)
);

CREATE TABLE BANCO_DE_LEITE.CONFORMIDADE (
	ID_CONFORMIDADE INTEGER UNSIGNED NOT NULL PRIMARY KEY,
	DESCRICAO_CONFORMIDADE VARCHAR(50)
);

CREATE TABLE BANCO_DE_LEITE.NAO_CONFORMIDADE (
	ID_NAO_CONFORMIDADE INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

	/*FRASCO_LH_ID INTEGER UNSIGNED NOT NULL,*/
	DOACAO_ID INTEGER UNSIGNED NOT NULL,
	CONFORMIDADE_ID INTEGER UNSIGNED NOT NULL,
	FUNCIONARIO_ID INTEGER UNSIGNED NOT NULL,

	DATA_NAO_CONFORMIDADE DATE NOT NULL,

	/*FOREIGN KEY (FRASCO_LH_ID) REFERENCES FRASCO_LH (ID_FRASCO_LH),*/
	FOREIGN KEY (DOACAO_ID) REFERENCES DOACAO (ID_DOACAO),
	FOREIGN KEY (CONFORMIDADE_ID) REFERENCES CONFORMIDADE (ID_CONFORMIDADE),
	FOREIGN KEY (FUNCIONARIO_ID) REFERENCES FUNCIONARIO (ID_FUNCIONARIO)
);


CREATE TABLE BANCO_DE_LEITE.RECEPTOR (
  ID_RECEPTOR INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

  NOME_RECEPTOR VARCHAR(50)
);

CREATE TABLE BANCO_DE_LEITE.REGISTRO_ENTREGA (
	ID_REGISTRO INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

	FRASCO_ID INTEGER UNSIGNED NOT NULL,
	RECEPTOR_ID INTEGER UNSIGNED NOT NULL,
	FUNCIONARIO_ID INTEGER UNSIGNED NOT NULL,

	DATA_REGISTRO DATE NOT NULL,

	FOREIGN KEY (FRASCO_ID) REFERENCES FRASCO_LH (ID_FRASCO_LH),
	FOREIGN KEY (RECEPTOR_ID) REFERENCES RECEPTOR (ID_RECEPTOR),
	FOREIGN KEY ( FUNCIONARIO_ID) REFERENCES FUNCIONARIO(ID_FUNCIONARIO)
);
