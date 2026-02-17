CREATE TABLE categorie_initial LIKE categorie;
INSERT INTO categorie_initial SELECT * FROM categorie;

CREATE TABLE type_besoin_initial LIKE type_besoin;
INSERT INTO type_besoin_initial SELECT * FROM type_besoin;

CREATE TABLE ville_initial LIKE ville;
INSERT INTO ville_initial SELECT * FROM ville;

CREATE TABLE besoin_initial LIKE besoin;
INSERT INTO besoin_initial SELECT * FROM besoin;

CREATE TABLE don_initial LIKE don;
INSERT INTO don_initial SELECT * FROM don;

CREATE TABLE historique_initial LIKE historique;
INSERT INTO historique_initial SELECT * FROM historique;
