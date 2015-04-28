USE MASTER
GO


IF EXISTS ( Select * from sys.databases where name='MegaCastingCL' )
	BEGIN
		DROP DATABASE MegaCastingCL
	END
GO

CREATE DATABASE MegaCastingCL
GO


USE MegaCastingCL
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
	Adresse_id BIGINT NOT NULL
	CONSTRAINT PK_Societe PRIMARY KEY (Id),
	CONSTRAINT FK_Societe_Adresse FOREIGN KEY (Adresse_id) REFERENCES Adresse (Id),
	CONSTRAINT UK_Societe UNIQUE (RaisonSociale)
)
GO


CREATE INDEX IFK_Societe_Adresse ON Societe (Adresse_id)
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
	Domaine_id BIGINT,
	CONSTRAINT PK_Metier PRIMARY KEY (Id),
	CONSTRAINT FK_Metier_Domaine FOREIGN KEY (Domaine_id) REFERENCES Domaine (Id),
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
	DatePublication DATETIME NOT NULL,
	DureeDiffusion INT NOT NULL,
	DateDebutContrat DATE NOT NULL,
	NbPoste INT NOT NULL,
	LocalisationLattitude NVARCHAR(50) NOT NULL,
	LocalisationLongitude NVARCHAR(50) NOT NULL,
	DescriptionPoste TEXT NOT NULL,
	DescriptionProfil TEXT NOT NULL,
	Telephone NVARCHAR(50) NOT NULL,
	Email NVARCHAR(50) NOT NULL,
	Domaine_id BIGINT,
	Metier_id BIGINT,
	TypeContrat_id BIGINT NOT NULL,
	Annonceur_id BIGINT NOT NULL,
	CONSTRAINT PK_Offre PRIMARY KEY (Id),
	CONSTRAINT FK_Offre_Domaine FOREIGN KEY (Domaine_id) REFERENCES Domaine (Id),
	CONSTRAINT FK_Offre_Metier FOREIGN KEY (Metier_id) REFERENCES Metier (Id),
	CONSTRAINT FK_Offre_TypeContrat FOREIGN KEY (TypeContrat_id) REFERENCES TypeContrat (Id),
	CONSTRAINT FK_Offre_Annonceur FOREIGN KEY (Annonceur_id) REFERENCES Annonceur (Id),
	CONSTRAINT UK_Offre UNIQUE (Reference)
)
GO


CREATE INDEX IFK_Offre_Domaine ON Offre (Domaine_id)
GO


CREATE INDEX IFK_Offre_Metier ON Offre (Metier_id)
GO


CREATE INDEX IFK_Offre_TypeContrat ON Offre (TypeContrat_id)
GO


CREATE INDEX IFK_Offre_Annonceur ON Offre (Annonceur_id)
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

CREATE TABLE Role
(
	Id BIGINT NOT NULL IDENTITY,
	Name NVARCHAR(255) NOT NULL,
	Role NVARCHAR(255) NOT NULL,
	CONSTRAINT PK_Role PRIMARY KEY (Id)
)
GO

CREATE TABLE Utilisateur
(
	Id BIGINT NOT NULL IDENTITY,
	Username NVARCHAR(255) NOT NULL,
	Password NVARCHAR(255) NOT NULL,
	Salt NVARCHAR(255) NULL,
	Email NVARCHAR(255) NULL,
	CONSTRAINT PK_Utilisateur PRIMARY KEY (Id),
	CONSTRAINT UK_Utilisateur_Pseudo UNIQUE (Username),
)
GO

CREATE TABLE Role_Utilisateur
(
	Role_id BIGINT NOT NULL,
	Utilisateur_id BIGINT NOT NULL,
	CONSTRAINT PK_Role_Utilisateur PRIMARY KEY (Role_id, Utilisateur_id),
	CONSTRAINT FK_Role_Utilisateur_IdRole FOREIGN KEY (Role_id) REFERENCES Role (Id),
	CONSTRAINT FK_Role_Utilisateur_IdUtilisateur FOREIGN KEY (Utilisateur_id) REFERENCES Utilisateur (id)
)
GO


CREATE INDEX IFK_Role_Utilisateur_IdRole ON Role_Utilisateur (Role_id)
GO

CREATE INDEX IFK_Role_Utilisateur_IdUtilisateur ON Role_Utilisateur (Utilisateur_id)
GO

CREATE TABLE Artiste
(
	Id BIGINT NOT NULL IDENTITY,
	DateNaissance DATETIME NOT NULL,
	Sexe_id BIGINT,
	Utilisateur_id BIGINT,
	CaracteristiquePhysique_id BIGINT,
	CONSTRAINT PK_Artiste PRIMARY KEY (Id),
	CONSTRAINT FK_Artiste_Sexe FOREIGN KEY (Sexe_id) REFERENCES Sexe (Id),
	CONSTRAINT FK_Artiste_Utilisateur FOREIGN KEY (Utilisateur_id) REFERENCES Utilisateur (id),
	CONSTRAINT FK_Artiste_CaracPhysique FOREIGN KEY (CaracteristiquePhysique_id) REFERENCES CaracteristiquePhysique (Id)
)
GO


CREATE INDEX IFK_Artiste_Sexe ON Artiste (Sexe_id)
GO

CREATE INDEX IFK_Artiste_Utilisateur ON Artiste (Utilisateur_id)
GO

CREATE INDEX IFK_Artiste_CaracPhysique ON Artiste (CaracteristiquePhysique_id)
GO


CREATE TABLE Artiste_Metier
(
	Artiste_id BIGINT NOT NULL,
	Metier_id BIGINT NOT NULL,
	CONSTRAINT PK_Artiste_Metier PRIMARY KEY (Artiste_id, Metier_id),
	CONSTRAINT FK_Artiste_Metier_IdArtiste FOREIGN KEY (Artiste_id) REFERENCES Artiste (Id),
	CONSTRAINT FK_Artiste_Metier_IdMetier FOREIGN KEY (Metier_id) REFERENCES Metier (id)
)
GO


CREATE INDEX IFK_Artiste_Metier_IdArtiste ON Artiste_Metier (Artiste_id)
GO

CREATE INDEX IFK_Artiste_Metier_IdMetier ON Artiste_Metier (Metier_id)
GO



ALTER TABLE Annonceur
ADD Utilisateur_id BIGINT NULL,
CONSTRAINT FK_Annonceur_Utilisateur FOREIGN KEY (Utilisateur_id) REFERENCES Utilisateur (id)
GO


CREATE INDEX IFK_Annonceur_Utilisateur ON Annonceur (Utilisateur_id)
GO


CREATE TABLE Photo
(
	Id BIGINT NOT NULL IDENTITY,
	Libelle NVARCHAR(255) NOT NULL,
	IsProfile INT,
	Artiste_id BIGINT,
	CONSTRAINT PK_Photo PRIMARY KEY (Id),
	CONSTRAINT FK_Photo_Artiste FOREIGN KEY (Artiste_id) REFERENCES Artiste (Id)
)
GO


CREATE INDEX IFK_Photo_Artiste ON Photo (Artiste_id)
GO
