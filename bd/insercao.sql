CREATE TABLE Receita(
  cpf         varchar(40)     NOT NULL,
  id_remedio  int             NOT NULL,
  horario     time            NOT NULL,
  CONSTRAINT PK_receita       PRIMARY KEY(cpf, id_remedio, horario),
  CONSTRAINT FK_cpf           FOREIGN KEY (cpf) REFERENCES Usuario(cpf),
  CONSTRAINT FK_id_remedio    FOREIGN KEY (id_remedio) REFERENCES Remedio(id_remedio)
);

INSERT INTO Receita(cpf, id_remedio, horario) VALUES ('113.440.254-61', 1, '17:20');
INSERT INTO Receita(cpf, id_remedio, horario) VALUES ('113.440.254-67', 2, '17:20');
INSERT INTO Receita(cpf, id_remedio, horario) VALUES ('113.440.254-61', 3, '17:20');
