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
adresse varchar(100),
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
ALTER TABLE  `Article` CHANGE  `IDArticle`  `IDArticle` INT( 4 ) NOT NULL AUTO_INCREMENT ;

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
ALTER TABLE  `Commander` CHANGE  `IDCommande`  `IDCommande` INT( 3 ) NOT NULL AUTO_INCREMENT ;

/* Pour faire un référencement croisé */
ALTER TABLE Employe ADD FOREIGN KEY (refBoutique) REFERENCES Boutique (IDBoutique);

/* Vues */
CREATE VIEW TotalCommande (refBoutique, modele, total)
AS (
SELECT refBoutique, modele, SUM(quantite)
FROM Commander
GROUP BY refBoutique
);

CREATE VIEW TotalVente (refBoutique, modele, total)
AS (
(SELECT refBoutique, modele, COUNT(*)
FROM Article
WHERE dateVente IS NOT NULL
GROUP BY refBoutique)
UNION
(SELECT refBoutique, modele, 0
FROM Article
WHERE NOT EXISTS (
	SELECT *
	FROM Article
	WHERE dateVente IS NOT NULL
	)
GROUP BY refBoutique
)
);

CREATE VIEW Stock (refBoutique, modele, total)
AS (
SELECT T1.refBoutique, T1.modele, T1.total - T2.total
FROM TotalCommande T1, TotalVente T2
WHERE T1.refBoutique = T2.refBoutique
);

/* Ajout de valeurs 
Si ajout d'une boutique avec un responsable, faire attention au référencement croisé
AUTO INCREMENT, mettre le nom des colonnes a modif devant la table
*/

INSERT INTO Boutique VALUES ("versailles", NULL, "0102030405", "45 avenue des etats-unis 78000 VERSAILLES");
INSERT INTO Employe VALUES ("sonny.klotz@ens.uvsq.fr", "Klotz", "Sonny", 3000, "versailles");
UPDATE Boutique SET IDResponsable="sonny.klotz@ens.uvsq.fr" WHERE IDBoutique LIKE "versailles";
INSERT INTO Employe VALUES ("leonhard.euler@hotmail.com", "Euler", "Leonhard", 2300, "versailles");
INSERT INTO Fournisseur VALUES ("prototype", 100);
INSERT INTO Commander (refBoutique, modele, dateCommande, quantite) VALUES ("versailles", "prototype", '2016-12-07', 2);
INSERT INTO Article (modele, prixVente, dateVente, refBoutique) VALUES("prototype", 300, NULL, "versailles");
INSERT INTO Article (modele, prixVente, dateVente, refBoutique) VALUES("prototype", 300, '2016-12-07', "versailles");

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
WHERE refBoutique LIKE nomBoutique /* on recupere la boutique du responsable dans la session*/
AND IDEmploye NOT IN /* sauf le responsable qu'on ne peut pas licencier */
(SELECT IDResponsable
FROM Boutique);

/* Afficheer le stock d'une boutique */
SELECT *
FROM Stock
WHERE refBoutique LIKE /* *boutique de l'employe */

/* Formulaires recrutement et licenciement*/
DELETE FROM Employe WHERE IDEmploye LIKE /* POST */;
INSERT INTO Employe VALUES ( /* POST */, /* boutique du responsable */);
/* Formulaires de commande et de vente */
INSERT INTO Commander (refBoutique, modele, dateCommande, quantite) VALUES ( /* boutique de l'employe */ , /* POST */);
INSERT INTO Article (modele, prixVente, dateVente, refBoutique) VALUES( /* POST */ , NULL, /* boutique de l'meploye */);
UPDATE Article
SET dateVente="2016-12-08"
WHERE IDArticle IN(
    SELECT MIN(IDArticle)
    FROM (SELECT * FROM Article) A
    WHERE A.modele="prototype"
    AND A.refBoutique="versailles"
    AND dateVente IS NULL
)
