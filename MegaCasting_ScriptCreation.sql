USE master;
GO

IF EXISTS (SELECT * FROM sys.databases WHERE name = 'MegaCastingCL')
BEGIN
	DROP DATABASE MegaCastingCL;
END
GO

CREATE DATABASE MegaCastingCL;
GO

USE MegaCastingCL;
GO

CREATE TABLE Adresse
(
	Id BIGINT NOT NULL IDENTITY,
	Numero INT NOT NULL,
	Rue NVARCHAR(250) NOT NULL,
	CodePostal INT NOT NULL,
	Ville NVARCHAR(100) NOT NULL,
	CONSTRAINT PK_Adresse PRIMARY KEY (Id),
	CONSTRAINT UK_Adresse UNIQUE (Numero, Rue, CodePostal, Ville)
)
GO

CREATE INDEX IUK_Adresse ON Adresse (Numero, Rue, CodePostal, Ville)
GO

CREATE TABLE Societe
(
	Id BIGINT NOT NULL IDENTITY,
	NumeroSiret BIGINT NOT NULL,
	RaisonSociale NVARCHAR(100) NOT NULL,
	Email NVARCHAR(50) NOT NULL,
	Telephone NVARCHAR(50) NOT NULL,
	IdAdresse BIGINT NOT NULL,
	CONSTRAINT PK_Societe PRIMARY KEY (Id),
	CONSTRAINT FK_Societe_Adresse FOREIGN KEY (IdAdresse) REFERENCES Adresse (Id),
	CONSTRAINT UK_Societe UNIQUE (RaisonSociale)
)
GO

CREATE INDEX IFK_Societe_Adresse ON Societe (IdAdresse)
GO

CREATE INDEX IUK_Societe ON Societe (RaisonSociale)
GO

CREATE TABLE Diffuseur
(
	Id BIGINT NOT NULL,
	CONSTRAINT PK_Diffuseur PRIMARY KEY (Id),
	CONSTRAINT FK_Diffuseur_Societe FOREIGN KEY (Id) REFERENCES Societe (Id)
)
GO

CREATE INDEX IFK_Diffuseur_Societe ON Diffuseur (Id)
GO

CREATE TABLE Annonceur
(
	Id BIGINT NOT NULL,
	CONSTRAINT PK_Annonceur PRIMARY KEY (Id),
	CONSTRAINT FK_Annonceur_Societe FOREIGN KEY (Id) REFERENCES Societe (Id)
)
GO

CREATE INDEX IFK_Annonceur_Societe ON Annonceur (Id)
GO

CREATE TABLE TypeContrat
(
	Id BIGINT NOT NULL IDENTITY,
	Libelle NVARCHAR(100) NOT NULL,
	CONSTRAINT PK_TypeContrat PRIMARY KEY (Id),
	CONSTRAINT UK_TypeContrat UNIQUE (Libelle)
)
GO

CREATE INDEX IUK_TypeContrat ON TypeContrat (Libelle)
GO

CREATE TABLE Domaine
(
	Id BIGINT NOT NULL IDENTITY,
	Libelle NVARCHAR(100) NOT NULL,
	CONSTRAINT PK_Domaine PRIMARY KEY (Id),
	CONSTRAINT UK_Domaine UNIQUE (Libelle)
)
GO

CREATE INDEX IUK_Domaine ON Domaine (Libelle)
GO

CREATE TABLE Metier
(
	Id BIGINT NOT NULL IDENTITY,
	Libelle NVARCHAR(100) NOT NULL,
	IdDomaine BIGINT,
	CONSTRAINT PK_Metier PRIMARY KEY (Id),
	CONSTRAINT FK_Metier_Domaine FOREIGN KEY (IdDomaine) REFERENCES Domaine (Id),
	CONSTRAINT UK_Metier UNIQUE (Libelle)
)
GO

CREATE INDEX IFK_Metier_Domaine ON Metier (Id)
GO

CREATE INDEX IUK_Metier ON Metier (Libelle)
GO

CREATE TABLE Offre
(
	Id BIGINT NOT NULL IDENTITY,
	Intitule NVARCHAR(100) NOT NULL,
	Reference NVARCHAR(100) NOT NULL,
	DatePublication DATETIME2 NOT NULL,
	DureeDiffusion INT NOT NULL,
	DateDebutContrat DATE NOT NULL,
	NbPoste INT NOT NULL,
	LocalisationLattitude NVARCHAR(50) NOT NULL,
	LocalisationLongitude NVARCHAR(50) NOT NULL,
	DescriptionPoste NVARCHAR(max) NOT NULL,
	DescriptionProfil NVARCHAR(max) NOT NULL,
	Telephone NVARCHAR(50) NOT NULL,
	Email NVARCHAR(50) NOT NULL,
	IdDomaine BIGINT,
	IdMetier BIGINT,
	IdTypeContrat BIGINT NOT NULL,
	IdAnnonceur BIGINT NOT NULL,
	CONSTRAINT PK_Offre PRIMARY KEY (Id),
	CONSTRAINT FK_Offre_Domaine FOREIGN KEY (IdDomaine) REFERENCES Domaine (Id),
	CONSTRAINT FK_Offre_Metier FOREIGN KEY (IdMetier) REFERENCES Metier (Id),
	CONSTRAINT FK_Offre_TypeContrat FOREIGN KEY (IdTypeContrat) REFERENCES TypeContrat (Id),
	CONSTRAINT FK_Offre_Annonceur FOREIGN KEY (IdAnnonceur) REFERENCES Annonceur (Id),
	CONSTRAINT UK_Offre UNIQUE (Reference)
)
GO

CREATE INDEX IFK_Offre_Domaine ON Offre (IdDomaine)
GO

CREATE INDEX IFK_Offre_Metier ON Offre (IdMetier)
GO

CREATE INDEX IFK_Offre_TypeContrat ON Offre (IdTypeContrat)
GO

CREATE INDEX IFK_Offre_Annonceur ON Offre (IdAnnonceur)
GO

CREATE INDEX IUK_Offre ON Offre (Reference)
GO

CREATE TABLE Sexe
(
	Id BIGINT NOT NULL IDENTITY,
	Libelle NVARCHAR(100) NOT NULL,
	CONSTRAINT PK_Sexe PRIMARY KEY (Id),
	CONSTRAINT UK_Sexe_Libelle UNIQUE (Libelle)
)
GO

CREATE INDEX IUK_Sexe_Libelle ON Sexe (Libelle)
GO

CREATE TABLE CaracteristiquePhysique
(
	Id BIGINT NOT NULL IDENTITY,
	Taille int NULL,
	Poids int NULL,
	CouleurYeux NVARCHAR(50) NULL,
	CouleurCheveux NVARCHAR(50) NULL,
	CONSTRAINT PK_CaracteristiquePhysique PRIMARY KEY (Id)
)
GO

CREATE TABLE Utilisateur
(
	Id BIGINT NOT NULL IDENTITY,
	Pseudo NVARCHAR(255) NOT NULL,
	MotDePasse NVARCHAR(MAX) NOT NULL,
	Email NVARCHAR(255) NOT NULL,
	CONSTRAINT PK_Utilisateur PRIMARY KEY (Id),
	CONSTRAINT UK_Utilisateur_Pseudo UNIQUE (Pseudo)
)
GO


CREATE TABLE Artiste
(
	Id BIGINT NOT NULL IDENTITY,
	DateNaissance DATETIME2 NOT NULL,
	IdSexe BIGINT,
	IdUtilisateur BIGINT,
	IdCaracteristiquePhysique BIGINT,
	CONSTRAINT PK_Artiste PRIMARY KEY (Id),
	CONSTRAINT FK_Artiste_Sexe FOREIGN KEY (IdSexe) REFERENCES Sexe (Id),
	CONSTRAINT FK_Artiste_Utilisateur FOREIGN KEY (IdUtilisateur) REFERENCES Utilisateur (id),
	CONSTRAINT FK_Artiste_CaracPhysique FOREIGN KEY (IdCaracteristiquePhysique) REFERENCES CaracteristiquePhysique (Id)
)
GO

CREATE INDEX IFK_Artiste_Sexe ON Artiste (IdSexe)
GO
CREATE INDEX IFK_Artiste_Utilisateur ON Artiste (IdUtilisateur)
GO
CREATE INDEX IFK_Artiste_CaracPhysique ON Artiste (IdCaracteristiquePhysique)
GO

CREATE TABLE Artiste_Metier
(
	IdArtiste BIGINT NOT NULL,
	IdMetier BIGINT NOT NULL,
	CONSTRAINT PK_Artiste_Metier PRIMARY KEY (IdArtiste, IdMetier),
	CONSTRAINT FK_Artiste_Metier_IdArtiste FOREIGN KEY (IdArtiste) REFERENCES Artiste (Id),
	CONSTRAINT FK_Artiste_Metier_IdMetier FOREIGN KEY (IdMetier) REFERENCES Metier (id)
)
GO

CREATE INDEX IFK_Artiste_Metier_IdArtiste ON Artiste_Metier (IdArtiste)
GO
CREATE INDEX IFK_Artiste_Metier_IdMetier ON Artiste_Metier (IdMetier)
GO


ALTER TABLE Annonceur
ADD IdUtilisateur BIGINT NULL,
CONSTRAINT FK_Annonceur_Utilisateur FOREIGN KEY (IdUtilisateur) REFERENCES Utilisateur (id)
GO

CREATE INDEX IFK_Annonceur_Utilisateur ON Annonceur (IdUtilisateur)
GO

CREATE TABLE Photo
(
	Id BIGINT NOT NULL IDENTITY,
	Libelle NVARCHAR(255) NOT NULL,
	IsProfile INT,
	IdArtiste BIGINT,
	CONSTRAINT PK_Photo PRIMARY KEY (Id),
	CONSTRAINT FK_Photo_Artiste FOREIGN KEY (IdArtiste) REFERENCES Artiste (Id)
)
GO

CREATE INDEX IFK_Photo_Artiste ON Photo (IdArtiste)
GO