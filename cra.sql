CREATE TABLE Statut(
    Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Conges BOOL NOT NULL DEFAULT 0,
    Maladie BOOL NOT NULL DEFAULT 0,
    Teletravail BOOL NOT NULL DEFAULT 0,
    Formation BOOL NOT NULL DEFAULT 0,
    RTT BOOL NOT NULL DEFAULT 0,
    SurSite BOOL NOT NULL DEFAULT 0
);

CREATE TABLE Journee(
    Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(255) NOT NULL,
    Prenom VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Date DATE NOT NULL,
    Matin BOOL NOT NULL DEFAULT 0,
    ApresMidi BOOL NOT NULL DEFAULT 0
);

CREATE TABLE Users (
  Id int(11) NOT NULL AUTO_INCREMENT,
  Username varchar(255) NOT NULL,
  Password varchar(255) NOT NULL,
  PRIMARY KEY (Id)
);
