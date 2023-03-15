CREATE TABLE Utilisateur(
    Id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(255) NOT NULL,
    Prenom VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE Statut(
    Id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Congés VARCHAR(255) NOT NULL,
    Maladie VARCHAR(255) NOT NULL,
    Télétravail VARCHAR(255) NOT NULL,
    Formation VARCHAR(255) NOT NULL,
    RTT VARCHAR(255) NOT NULL,
    SurSite VARCHAR(255) NOT NULL
);

CREATE TABLE DayType(
    Date DATETIME NOT NULL UNIQUE,
    AM VARCHAR(255) NOT NULL,
    PM VARCHAR(255) NOT NULL
);
