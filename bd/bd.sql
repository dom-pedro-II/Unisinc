CREATE TABLE Aluno (
    RA int PRIMARY KEY,
    Nome VARCHAR(255),
    senha VARCHAR(255)   
);

INSERT INTO `aluno`(`RA`, `Nome`, `senha`) VALUES ('101411','Aluno_teste','101411');

CREATE TABLE Professor (
    ID INT PRIMARY KEY,
    Nome VARCHAR(255),
    senha VARCHAR(20)
);

INSERT INTO `professor`(`ID`, `Nome`, `senha`) VALUES ('101411','ADM','101411');

CREATE TABLE Materia (
    ID INT PRIMARY KEY,
    NomeMateria VARCHAR(255)
);

INSERT INTO `materia`(`ID`, `NomeMateria`) VALUES ('1','Cirurgia'),
('2','Periodontia'),
('3','Dentística'),
('4','Endodontia'),
('5', 'Odontopediatria'), 
('6','Ortodontia'), 
('7', 'Implante'), 
('8', 'Prótese'), 
('9','Estágio 5/6'), 
('10','Estágio 3/4');

CREATE TABLE Paciente (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(255),
    email VARCHAR(255),
    tel VARCHAR(15),
    tel2 VARCHAR(15),
    MateriaID INT,
    FOREIGN KEY (MateriaID) REFERENCES Materia(ID)
);

CREATE TABLE Fila (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    PacienteID INT,
    FOREIGN KEY (PacienteID) REFERENCES Paciente(ID)
);

CREATE TABLE Aluno_Materia (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    AlunoID INT,
    MateriaID INT,
    FOREIGN KEY (AlunoID) REFERENCES Aluno(RA),
    FOREIGN KEY (MateriaID) REFERENCES Materia(ID)
);

CREATE TABLE Professor_Materia (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    ProfessorID INT,
    MateriaID INT,
    FOREIGN KEY (ProfessorID) REFERENCES Professor(ID),
    FOREIGN KEY (MateriaID) REFERENCES Materia(ID)
);

CREATE TABLE Consulta (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    PacienteID INT,
    Aluno1RA INT,
    Aluno2RA INT,
    DataConsulta DATE,
    HoraConsulta TIME,
    realizada VARCHAR(15),
    atendimento VARCHAR(255),
    FOREIGN KEY (PacienteID) REFERENCES Paciente(ID),
    FOREIGN KEY (Aluno1RA) REFERENCES Aluno(RA),
    FOREIGN KEY (Aluno2RA) REFERENCES Aluno(RA)
);

CREATE TABLE Motivo_Nao_Marcar (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    PacienteID INT,
    Motivo TEXT,
    RA_Aluno INT,
    DataRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (PacienteID) REFERENCES Paciente(ID)
);


--datas de consulta para teste, apagar quando entrar em produção--
INSERT INTO `consulta` (`ID`, `PacienteID`, `Aluno1RA`, `Aluno2RA`, `DataConsulta`, `HoraConsulta`) VALUES
(1, 1, 101411, 93105, '2023-01-01', '09:00:00'),
(2, 1, 101411, 93105, '2023-01-01', '10:00:00'),
(3, 1, 101411, 93105, '2023-01-01', '11:00:00');
