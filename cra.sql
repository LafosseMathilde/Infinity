CREATE TABLE Utilisateur(
    Id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(255) NOT NULL,
    Prenom VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Date DATETIME NOT NULL
);

CREATE TABLE Evenement(
    Id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Télétravail VARCHAR(255) NOT NULL,
    Présentiel VARCHAR(255) NOT NULL,
    Client VARCHAR(255) NOT NULL UNIQUE,
    Date DATETIME NOT NULL
);