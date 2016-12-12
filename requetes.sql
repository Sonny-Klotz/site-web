/*
Liste de requêtes pour la base de données et le site web.
ligne 9 : création de la base de données
ligne 65 : vues
ligne 88: ajout de valeurs dans la table
ligne 126: création des utilisateurs avec droits d'acces
ligne 158: requêtes utilisées dans le site
*/

/* Commandes sql pour créer la base de données */
CREATE TABLE Fournisseur (
modele varchar(30),
prixFournisseur int(3),
PRIMARY KEY (modele)
);

CREATE TABLE Employe (
IDEmploye varchar(16),
nom varchar(30),
prenom varchar(30),
salaire int(3),
refBoutique varchar(30),
mdp varchar(30),
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
estVendu int(1),
refBoutique varchar(30),
PRIMARY KEY (IDArticle),
FOREIGN KEY (modele) REFERENCES Fournisseur (modele),
FOREIGN KEY (refBoutique) REFERENCES Boutique (IDBoutique)
);
ALTER TABLE  `Article` CHANGE  `IDArticle`  `IDArticle` INT( 4 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE  `Article` CHANGE  `estVendu`  `estVendu` INT( 1 ) NULL DEFAULT  '0';

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
CREATE VIEW Stock (refBoutique, modele, total)
AS (
SELECT refBoutique, modele, count(*) - sum(estVendu)
FROM Article
GROUP BY refBoutique, modele
);

CREATE VIEW compta1 (refBoutique, salaires) AS
SELECT refBoutique, sum(salaire)
FROM Employe GROUP BY refBoutique;

CREATE VIEW compta2 (refBoutique, commandes) AS
SELECT CrefBoutique, sum(C.quantite * F.prixFournisseur)
FROM Commander C, Fournisseur F
WHERE C.modele = F.modele
GROUP BY refBoutique;

CREATE VIEW compta3 (refBoutique, ventes) AS
SELECT refBoutique, sum(prixVente)
FROM Article WHERE estVendu = 1
GROUP BY refBoutique;

/* Ajout de valeurs 
Si ajout d'une boutique avec un responsable, faire attention au référencement croisé
AUTO INCREMENT, mettre le nom des colonnes a modif devant la table
*/

INSERT INTO Boutique VALUES
	("Versailles", NULL, "0139257800", "45 avenue des etats-unis, 78000 Versailles"),
	("La Défense", NULL, "0141023030", "Les Quatre Temps - Le Parvis de la Défense, 92800 Puteaux"),
	("Le Club", NULL, "0141023030", "8 rue Charles Michels, 93200 Saint-Denis"),
	("De poche en poche", NULL, "0148133540", "2 Rue Catulienne, 93200 Saint-Denis");
INSERT INTO Employe VALUES
	("sonny.klotz", "Klotz", "Sonny", 7000, "Versailles", "mdp"),
	("malek.zemni", "Zemni", "Malek", 8388607, "De poche en poche", "mdp"),
	("younes.ben-yamna", "Ben Yamna", "Younes", 4500, "Le Club", "mdp"),
	("andy.lequeux", "Lequeux", "Andy", 6700, "La Défense", "mdp");
UPDATE Boutique SET IDResponsable="sonny.klotz" WHERE IDBoutique LIKE "Versailles";
UPDATE Boutique SET IDResponsable="malek.zemni" WHERE IDBoutique LIKE "Decathlon";
UPDATE Boutique SET IDResponsable="andy.lequeux" WHERE IDBoutique LIKE "La Défense";
UPDATE Boutique SET IDResponsable="younes.ben-yamna" WHERE IDBoutique LIKE "Le Club";

INSERT INTO Fournisseur VALUES
	("Le bas de gamme", 50),
	("Le moyen de gamme", 200),
	("Le haut de gamme", 500),
	("Le très haut de gamme", 1000),
	("Le sobre", 200),
	("Le sportif", 180),
	("L'endurant", 300),
	("Le populaire", 250),
	("Le stupéfiant", 400),
	("Le Jamaïcain", 450),
	("Le planneur", 420),
	("Le stimulant", 180),
	("Le blindé", 750),
	("Le classique", 500),
	("L'escapolope", 600),
	("Le steak", 450);

/* Création des utilisateurs et des droits d'accès */
CREATE USER 'utilisateur'@'localhost' identified by '';
CREATE USER 'sonny.klotz'@'localhost' identified by 'mdp';
CREATE USER 'malek.zemni'@'localhost' identified by 'mdp'; 
CREATE USER 'andy.lequeux'@'localhost' identified by 'mdp';
CREATE USER 'younes.ben-yamna'@'localhost' identified by 'mdp';

GRANT SELECT
ON projet.*
TO /* POST  */
'utilisateur'@'localhost';

GRANT INSERT
ON projet.Article
TO /* POST */
WITH GRANT OPTION;

GRANT INSERT
ON projet.Commander
TO /* POST */
WITH GRANT OPTION;

GRANT UPDATE
ON TABLE projet.Article
TO /* POST */
WITH GRANT OPTION;
	
GRANT ALL ON *.* TO 'sonny.klotz'@'localhost' WITH GRANT OPTION;
GRANT ALL ON *.* TO	'malek.zemni'@'localhost' WITH GRANT OPTION;
GRANT ALL ON *.* TO	'andy.lequeux'@'localhost' WITH GRANT OPTION;
GRANT ALL ON *.* TO	'younes.ben-yamna'@'localhost' WITH GRANT OPTION;

/* Requetes utilisées pour le site web */
/* recherche.php et article.php */
SELECT modele FROM Fournisseur;
SELECT modele FROM Stock /* WHERE checkbox sélectionnées */ ;
SELECT refBoutique FROM Stock WHERE modele = /* modeles trouvés */ ; /* boutiques contenant le modele cherché */

/* boutiques.php : contact des boutiques*/
SELECT E.nom, E.prenom, E.IDEmploye, B.IDBoutique, B.adresse, B.telephone
FROM Employe E, Boutique B
WHERE E.IDEmploye = B.IDResponsable;

SELECT * FROM compta1 c1, compta2 c2, compta3 c3
WHERE c1.refBoutique = c2.refBoutique
AND c1.refBoutique = c3.refBoutique;

/* stock.php commande.php vente.php */
SELECT * FROM Stock WHERE total > 0 AND refBoutique LIKE /* boutique de l'employé */ ;
SELECT * FROM Fournisseur; /* pour la commande */
INSERT INTO Commander (refBoutique, modele, dateCommande, quantite) VALUES ( /* POST */ );
/* On insère autant d'articles qu'on a commander*/
INSERT INTO Article (modele, prixVente, refBoutique) VALUES (/* POST */);
UPDATE Article SET estVendu=1
WHERE IDArticle IN(
SELECT MIN(IDArticle)
FROM (SELECT * FROM Article) A
WHERE A.modele= /* POST */
AND A.refBoutique=/* boutique de l'employe*/
AND estVendu=0);

/* rh.php embauche.php licenciement.php */
/* lister le personnel de la boutique */
SELECT nom, prenom, IDEmploye FROM Employe WHERE refBoutique LIKE /* boutique du responsable */;
INSERT INTO Employe VALUES (/* POST */);
CREATE USER /* identifiant */@"localhost" identified by /* mot de passe */;
/* On lui affecte les droits correspondants aux employés (voir section précédente) */
DELETE FROM Employe WHERE IDEmploye LIKE /* login */ ;
DROP USER /* login */;
