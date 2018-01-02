-- Criando o banco de dados
CREATE DATABASE horacerta_db;

-- Selecionando o banco de dados
USE horacerta_db;

-- Criando a tabela usuario
CREATE TABLE Usuario
(
  email			  varchar(40)			NOT NULL,
  senha       varchar(40)     NOT NULL,
  cpf         varchar(40)     NOT NULL,
  nome				varchar(40)			NOT NULL,
  sobrenome   varchar(40)     NOT NULL,
  tipo        varchar(1)      NOT NULL,
  CONSTRAINT PK_cpf					  PRIMARY KEY (cpf)
);

-- Criando a tabela remedio
CREATE TABLE Remedio(
  id_remedio  int             NOT NULL    AUTO_INCREMENT,
  nome        varchar(40)     NOT NULL,
  CONSTRAINT PK_id_remedio    PRIMARY KEY(id_remedio)
);

-- Criando a tabela Receita
CREATE TABLE Receita(
  cpf         varchar(40)     NOT NULL,
  id_remedio  int             NOT NULL,
  horario     time            NOT NULL,
  CONSTRAINT PK_receita       PRIMARY KEY(cpf, id_remedio, horario),
  CONSTRAINT FK_cpf           FOREIGN KEY (cpf) REFERENCES Usuario(cpf),
  CONSTRAINT FK_id_remedio    FOREIGN KEY (id_remedio) REFERENCES Remedio(id_remedio)
);

-- Criando a tabela de registros
CREATE TABLE Registro(
  cpf         varchar(40)     NOT NULL,
  id_remedio  int             NOT NULL,
  horario     timestamp       NOT NULL,
  CONSTRAINT PK_registro      PRIMARY KEY(cpf, id_remedio, horario),
  CONSTRAINT FK_id_remedio_   FOREIGN KEY (id_remedio) REFERENCES Remedio(id_remedio),
  CONSTRAINT FK_cpf_          FOREIGN KEY (cpf) REFERENCES Usuario(cpf)
);

-- Inserindo dados na tabela usuario
INSERT INTO Usuario(email, senha, cpf, nome, sobrenome, tipo) VALUES ('juliocezarjpg@gmail.com','76738300','113.440.254-63', 'Julio Cezar', 'Coelho', 'm');
INSERT INTO Usuario(email, senha, cpf, nome, sobrenome, tipo) VALUES ('juliocezarjpg2@gmail.com','76738300','113.440.254-62', 'Julio Cezar', 'Barbosa', 'p');
INSERT INTO Usuario(email, senha, cpf, nome, sobrenome, tipo) VALUES ('jordano@gmail.com','12345','113.440.254-61', 'Jordano', 'Ferreira', 'p');

-- Inserindo dados na tabela remedio
INSERT INTO Remedio(id_remedio, nome) VALUES (1, 'Ibuprofeno');
INSERT INTO Remedio(id_remedio, nome) VALUES (2, 'Tilenol');
INSERT INTO Remedio(id_remedio, nome) VALUES (3, 'Multigrip');
INSERT INTO Remedio(id_remedio, nome) VALUES (4, 'Doflex');

--Inseindo dados na tabela Receita
INSERT INTO Receita(cpf, id_remedio, horario) VALUES ('113.440.254-62', 1, '08:00');
INSERT INTO Receita(cpf, id_remedio, horario) VALUES ('113.440.254-61', 1, '08:00');
INSERT INTO Receita(cpf, id_remedio, horario) VALUES ('113.440.254-61', 2, '10:00');

-- Inserindo dados na tabela registros
INSERT INTO Registro(cpf, id_remedio, horario) VALUES ('113.440.254-61', 1, NOW());
INSERT INTO Registro(cpf, id_remedio, horario) VALUES ('113.440.254-61', 2, NOW());