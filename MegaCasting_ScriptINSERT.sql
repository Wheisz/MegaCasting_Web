use MegaCastingCL

insert into TypeContrat (Libelle)
values
	('CDD'),
	('CDI')

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

insert into Sexe (Libelle)
values
	('Masculin'),
	('Feminin')

insert into CaracteristiquePhysique (Poids,Taille,CouleurYeux,CouleurCheveux)
values 
	(80,190,'marrons','blond'),
	(100,150,'verts','brin')

insert into Artiste (DateNaissance, Sexe_id, CaracteristiquePhysique_id, Utilisateur_id)
values
	('1993-04-21', 1, 1, 1);

insert into Photo (Libelle, IsProfile, Artiste_id)
values
	('theo_photo.jpg', 1, 1);
