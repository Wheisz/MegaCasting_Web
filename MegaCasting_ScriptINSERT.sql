use MegaCastingCL

insert into TypeContrat (Libelle)
values
	('CDD'),
	('CDI');

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
	('F�minin'),
	('Autre');


insert into Metier (Libelle, Domaine_id)
values
	('Photographe', 5),
	('Animateur', 8),
	('Mannequin Enfant', 4),
	('Coach', 2),
	('Acteur', 1);

insert into Utilisateur (Pseudo, MotDePasse, Email)
values
	('Wheisz', 'yoyo', 'lazeriz@hotmail.fr');

insert into CaracteristiquePhysique (Poids,Taille,CouleurYeux,CouleurCheveux)
values 
	(80,190,'marrons','blond'),
	(100,150,'verts','brin')

insert into Artiste (DateNaissance, Sexe_id, CaracteristiquePhysique_id, Utilisateur_id)
values
	(convert(datetime, '2012-02-22 01:02:03', 121), 1, 1, 1);

insert into Photo (Libelle, IsProfile, Artiste_id)
values
	('theo_photo.jpg', 1, 1);


insert into Adresse (Numero,Rue,CodePostal,Ville)
values
	(1,'quai du point jour',92100,'Boulogne Billancourt');

insert into Societe (NumeroSiret,RaisonSociale,Email,Telephone,Adresse_id)
values
	(14125412563254,'tf1Production','tf1prod@gmail.com',0899377465,1);

insert into Annonceur (Id)
values
	(1)

insert into Offre (Intitule,Reference,DatePublication,DureeDiffusion,DateDebutContrat,NbPoste,LocalisationLattitude,LocalisationLongitude,DescriptionPoste,DescriptionProfil,Telephone,Email,Domaine_id,Metier_id,TypeContrat_id,Annonceur_id)
values 
	('Recherche un animateur pour série Tf1','ref250',convert(datetime, '2015-04-22 01:02:03', 121),1,'24-04-2015',1,'12° 12'' N','14° 10'' S','Animateur pour presenter le jt de 20 heures','Jeune,dynamique et serieux','0214254758','jttf1@gmail.com',8,2,1,1);