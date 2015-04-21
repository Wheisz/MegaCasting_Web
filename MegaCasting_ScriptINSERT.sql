use MegaCastingCL

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


insert into Metier (Libelle, IdDomaine)
values
	('Photographe', 10),
	('Animateur', 7),
	('Mannequin Enfant', 12),
	('Coach', 9),
	('Acteur', 6);

insert into Utilisateur (Pseudo, MotDePasse, Email)
values
	('Wheisz', 'yoyo', 'lazeriz@hotmail.fr');

insert into Artiste (DateNaissance, IdSexe, IdCaracteristiquePhysique, IdUtilisateur)
values
	('1993-04-21', 1, 1, 1);

insert into Photo (Libelle, IsProfile, IdArtiste)
values
	('theo_photo.jpg', 1, 2);
