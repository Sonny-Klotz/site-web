/*
Liste de requêtes pour la base de données et le site web.
ligne 9 : création de la base de données
ligne 59 : vues
ligne : ajout de valeurs dans la table
ligne : requêtes utilisées dans le site
*/

/* Commandes sql pour créer la base de données */
CREATE TABLE Fournisseur (
modele varchar(30),
prixFournisseur int(3),
PRIMARY KEY (modele)
);

CREATE TABLE Employe (
IDEmploye varchar(50),
nom varchar(30),
prenom varchar(30),
salaire int(3),
refBoutique varchar(30),
PRIMARY KEY (IDEmploye)
/* FOREIGN KEY (refBoutique) REFERENCES Boutique (IDBoutique) // référencement croisé */
);

CREATE TABLE Boutique (
IDBoutique varchar(30),
IDResponsable varchar(50),
telephone varchar(10),
adresse varchar(100);
PRIMARY KEY (IDBoutique),
FOREIGN KEY (IDResponsable) REFERENCES Employe (IDEmploye)
);

CREATE TABLE Article (
IDArticle int(4),
modele varchar(30),
prixVente int(4),
dateVente date,
refBoutique varchar(30),
PRIMARY KEY (IDArticle),
FOREIGN KEY (modele) REFERENCES Fournisseur (modele),
FOREIGN KEY (refBoutique) REFERENCES Boutique (IDBoutique)
);

CREATE TABLE Commander (
IDCommande int(3),
refBoutique varchar(30),
modele varchar(30),
dateCommande date,
quantite int(3),
PRIMARY KEY (IDCommande),
FOREIGN KEY (refBoutique) REFERENCES Boutique (IDBoutique),
FOREIGN KEY (modele) REFERENCES Fournisseur (modele)
);

/* Pour faire un référencement croisé */
ALTER TABLE Employe ADD FOREIGN KEY (refBoutique) REFERENCES Boutique (IDBoutique);

/* Vues */

/* Ajout de valeurs 
Si ajout d'une boutique avec un responsable, faire attention au référencement croisé
*/

INSERT INTO Boutique VALUES ("versailles", NULL, "0102030405", "45 avenue des etats-unis 78000 VERSAILLES");
INSERT INTO Employe VALUES ("sonny.klotz@ens.uvsq.fr", "Klotz", "Sonny", 3000, "versailles");
UPDATE Boutique SET IDResponsable="sonny.klotz@ens.uvsq.fr" WHERE IDBoutique LIKE "versailles";
INSERT INTO Employe VALUES ("leonhard.euler@hotmail.com", "Euler", "Leonhard", 2300, "versailles");

/* Requetes utilisées pour le site web */
SELECT * FROM Employe;

/* Les responsables de chaque boutique */
SELECT B.IDResponsable, B.IDBoutique, E.nom, E.prenom
FROM Boutique B, Employe E
WHERE B.IDResponsable = E.IDEmploye;

/* Infos pour contacter chaque boutique */
SELECT E.nom, E.prenom, E.IDEmploye, B.IDBoutique, B.adresse, B.telephone
FROM Employe E, Boutique B
WHERE E.IDEmploye = B.IDResponsable;

/* Lister les employés d'une boutique*/
SELECT nom, prenom, IDEmploye
FROM Employe
WHERE refBoutique LIKE nomBoutique; /* on recupere la boutique du responsable dans la session*/
