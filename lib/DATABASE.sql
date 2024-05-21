CREATE TABLE Utente (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(64) NOT NULL,
    foto VARCHAR(255),
    nome VARCHAR(100) NOT NULL,
    cognome VARCHAR(100) NOT NULL,
    eta INT NOT NULL,
    classe VARCHAR(50) NOT NULL
);

CREATE TABLE Categoria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE Annuncio (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(50) NOT NULL,
    descrizione VARCHAR(255),
    Categoria_id INT,
    Utente_id INT NOT NULL,
    FOREIGN KEY (Categoria_id) REFERENCES Categoria(id) ON DELETE SET NULL,
    FOREIGN KEY (Utente_id) REFERENCES Utente(id) ON DELETE CASCADE
);

CREATE TABLE Foto (
    id INT PRIMARY KEY AUTO_INCREMENT,
    url VARCHAR(255) NOT NULL,
    Annuncio_id INT NOT NULL,
    FOREIGN KEY (Annuncio_id) REFERENCES Annuncio(id) ON DELETE CASCADE
);

CREATE TABLE Proposta (
    id INT PRIMARY KEY AUTO_INCREMENT,
    prezzo DECIMAL(10, 2) NOT NULL,
    data DATE NOT NULL,
    ora TIME NOT NULL,
    accepted BOOLEAN,
    Annuncio_id INT NOT NULL,
    Utente_id INT NOT NULL,
    FOREIGN KEY (Annuncio_id) REFERENCES Annuncio(id) ON DELETE CASCADE,
    FOREIGN KEY (Utente_id) REFERENCES Utente(id) ON DELETE CASCADE
);
