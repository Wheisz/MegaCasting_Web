use MegaCasting

insert into TypeContrat (Libelle)
values
	('CDD'),
	('CDI'),
	('INTERIM'),
	('STAGE');

insert into Domaine (Libelle)
values
	('CINEMA'),
	('DANSE'),
	('DIVERS'),
	('ENFANT'),
	('MODE-PHOTO'),
	('MUSIQUE'),
	('THEATRE'),
	('TV-RADIO');

insert into Sexe (Libelle)
values
	('Masculin'),
	('Féminin'),
	('Autre');


insert into Metier (Libelle, Domaine_id)
values
	('Photographe', 5),
	('Animateur', 8),
	('Mannequin Enfant', 4),
	('Coach', 2),
	('Acteur', 1);

insert into Role (Name, Role)
values
	('ROLE_ARTISTE', 'ROLE_ARTISTE'),
	('ROLE_ANNONCEUR', 'ROLE_ANNONCEUR'),
	('ROLE_ADMIN', 'ROLE_ADMIN');

insert into Utilisateur (Username, Password, Email)
values
	('kbouss', 'INO8TKeMpPqbcxu7Ran5tzSQ4Hurwv/7X4KJC1+3B8mJVW193OlWB7/YJJ3q5ZFx/yEvUxsWH/27W39XBEWC8Q==', 'kbouss@hotmail.fr'),
	('tf1Prod', 'TkGxngJ5HOtjnoc6hTiMetAicxDWQwqLprtUHSL0Lm5A1fEpybabiKVjDwfD41jfovD+Rt/M1Rw9LyXX3F7TYg==', 'tf1Prod@gmail.com'),
	('admin', 'nhDr7OyKlXQju+Ge/WKGrPQ9lPBSUFfpK+B1xqx/+8zLZqRNX0+5G1zBQklXUFy86lCpkAofsExlXiorUcKSNQ==', 'admin@megaproduction.fr');

insert into Role_Utilisateur (Role_id, Utilisateur_id)
values
	(1, 1),
	(2, 2),
	(3, 3);

insert into CaracteristiquePhysique (Poids,Taille,CouleurYeux,CouleurCheveux)
values 
	(80,190,'marrons','blond'),
	(100,150,'verts','brin')

insert into Artiste (DateNaissance, Sexe_id, CaracteristiquePhysique_id, Utilisateur_id)
values
	(convert(datetime, '2012-02-22 01:02:03', 121), 1, 1, 1);

insert into Photo (Url, IsProfile, Artiste_id)
values
	('theo_photo.jpg', 1, 1);


insert into Adresse (Numero,Rue,CodePostal,Ville)
values
	(1,'quai du point jour','92100','Boulogne Billancourt');

insert into Societe (NumeroSiret,RaisonSociale,Email,Telephone,Adresse_id, discr)
values
	(14125412563254,'tf1Production','tf1prod@gmail.com','0899377465',1, 'annonceur');

insert into Annonceur (Id, Utilisateur_id)
values
	(1, 2);

insert into Offre (Intitule,Reference,DatePublication,DureeDiffusion,DateDebutContrat,NbPoste,LocalisationLattitude,LocalisationLongitude,DescriptionPoste,DescriptionProfil,Telephone,Email,Domaine_id,Metier_id,TypeContrat_id,Annonceur_id)
values 
	('Recherche un animateur pour série Tf1','ref250',convert(datetime, '2015-04-22 01:02:03', 121),1,'24-04-2015',1,'12° 12'' N','14° 10'' S','Animateur pour presenter le jt de 20 heures','Jeune,dynamique et serieux','0214254758','jttf1@gmail.com',8,2,1,1);

update Offre
set EstValide = 1
where Id = 1;